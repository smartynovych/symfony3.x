<?php

namespace ParserBundle\Command;

use ParserBundle\Entity\ParserClass;
use ParserBundle\Entity\ParserInterface;
use ParserBundle\Entity\ParserNamespace;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class ParseCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('msg:parse:create')

            // the short description shown while running "php bin/console list"
            ->setDescription('Make a new parse Symfony API request.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to parse the Symfony API schema for a given Symfony branch (default master) and namespace:
            
    php bin/console msg:parse:create
    php bin/console msg:parse:create b=3.2
    php bin/console msg:parse:create b=3.2 ns="Symfony\Bridge\Monolog"
            ')
            // configure an argument
            ->addArgument('branch', InputArgument::OPTIONAL, 'Symfony API branch')
            ->setDefinition(
                new InputDefinition(array(
                    new InputArgument('branch', InputArgument::OPTIONAL),
                    new InputArgument('namespace', InputArgument::OPTIONAL),
                ))
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $branch = 'master';
        $allowBranchList = array(2.7, 2.8, 3.2, 3.3, 3.4);
        $arrCount = array(
            'namespace' => 0,
            'classes' => 0,
            'interfaces' => 0,
            'deprecated' => 0,
        );

        if (in_array(sprintf('%.1f', trim(ltrim($input->getArgument('branch'), 'b='))), $allowBranchList)) {
            $branch = sprintf('%.1f', trim(ltrim($input->getArgument('branch'), 'b=')));
        }

        $url = sprintf("http://api.symfony.com/%s/", $branch);

        $html = file_get_contents($url);

        $crawler = new Crawler($html);

        $output->writeln('Source url: '.$url);

        $em = $this->getContainer()->get('doctrine')->getManager();

        // Цикл который паребирает Namespace
        foreach ($crawler->filter('div.namespace-container > ul > li > a') as $item) {
            if ($input->getArgument('namespace') and trim($item->textContent) !== trim(ltrim($input->getArgument('namespace'), 'ns='))) {
                continue;
            }

            $namespace = new ParserNamespace();

            $namespace->setName(trim($item->textContent));
            $namespace->setPath(trim($item->getAttribute('href')));
            $namespace->setVersion($branch);
            $namespace->setCreatedAt(new \DateTime());
            $namespace->setUpdatedAt(new \DateTime());

            $em->persist($namespace);

            $arrCount['namespace']++;

            $htmlNamespace = file_get_contents($url.$item->getAttribute('href'));

            // Looking for Classes
            $crawlerClass = new Crawler($htmlNamespace);
            $nodeClass = $crawlerClass->filterXPath('//div[@class="container-fluid underlined"]/div[@class="row"]/div[@class="col-md-6"]/a');

            foreach ($nodeClass as $itemClass) {
                $msgParserClass = new ParserClass();
                $arrCount['classes']++;

                $msgParserClass->setNamespace($namespace);
                $msgParserClass->setName(trim($itemClass->textContent));
                $msgParserClass->setDescription(ltrim(trim(str_replace($msgParserClass->getName(), '', $itemClass->parentNode->parentNode->textContent)), '.'));
                $msgParserClass->setCreatedAt(new \DateTime());
                $msgParserClass->setUpdatedAt(new \DateTime());

                if (strstr($itemClass->parentNode->textContent, 'deprecated')) {
                    $msgParserClass->setDescription(trim(str_replace('deprecated', '', $msgParserClass->getDescription())));
                    $msgParserClass->setIsDeprecated(true);
                    $arrCount['deprecated']++;
                }
                $em->persist($msgParserClass);
            }

            // Looking for Interfaces
            $crawlerInterface = new Crawler($htmlNamespace);
            $nodeInterface = $crawlerInterface->filterXPath('//div[@class="container-fluid underlined"]/div[@class="row"]/div[@class="col-md-6"]/a');

            foreach ($nodeInterface as $itemInterface) {
                $msgParserInterface = new ParserInterface();
                $arrCount['classes']++;

                $msgParserInterface->setNamespace($namespace);
                $msgParserInterface->setName(trim($itemInterface->textContent));
                $msgParserInterface->setDescription(ltrim(trim(str_replace($msgParserInterface->getName(), '', $itemInterface->parentNode->parentNode->textContent)), '.'));
                $msgParserInterface->setCreatedAt(new \DateTime());
                $msgParserInterface->setUpdatedAt(new \DateTime());

                if (strstr($itemInterface->parentNode->textContent, 'deprecated')) {
                    $msgParserInterface->setDescription(trim(str_replace('deprecated', '', $msgParserInterface->getDescription())));
                    $msgParserInterface->setIsDeprecated(true);
                    $arrCount['deprecated']++;
                }
                $em->persist($msgParserInterface);
            }
        }
        $em->flush();
        $output->writeln(sprintf('We got the %d namespace, %d classes and %d interfaces. We find also %d deprecated classes. 

Operation is completed!', $arrCount['namespace'], $arrCount['classes'], $arrCount['interfaces'], $arrCount['deprecated']));
    }
}
