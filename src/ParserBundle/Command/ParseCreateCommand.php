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
    /**
     * Entity Manager
     */
    private $em;

    /**
     * Symfony branch
     *
     * @var string
     */
    private $branch = 'master';

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('parse:create')

            // the short description shown while running "php bin/console list"
            ->setDescription('Make a new parse Symfony API request.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to parse the Symfony API schema for a given Symfony branch (default master) and root url:
            
    php bin/console parse:create
    php bin/console parse:create b=3.2
    php bin/console parse:create b=3.2 url=http://api.symfony.com/master/Symfony/Component/Translation.html
            ')
            // configure an argument
            ->addArgument('branch', InputArgument::OPTIONAL, 'Symfony API branch')
            ->setDefinition(
                new InputDefinition(array(
                    new InputArgument('branch', InputArgument::OPTIONAL),
                    new InputArgument('url', InputArgument::OPTIONAL),
                ))
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $allowBranchList = array(2.7, 2.8, 3.2, 3.3, 3.4);

        if (in_array(sprintf('%.1f', trim(ltrim($input->getArgument('branch'), 'b='))), $allowBranchList)) {
            $this->branch = sprintf('%.1f', trim(ltrim($input->getArgument('branch'), 'b=')));
        }

        $url = sprintf("http://api.symfony.com/%s/Symfony.html", $this->branch);
        if ($input->getArgument('url')) {
            $url = trim(ltrim($input->getArgument('url'), 'url='));
        }

        $this->em = $this->getContainer()->get('doctrine')->getManager();
        $namespace = new ParserNamespace();
        $namespace->setName('Symfony');
        $namespace->setPath('Symfony.html');
        $namespace->setVersion($this->branch);
        $this->em->persist($namespace);

        $this->parse($url, $namespace);
        $this->em->flush();
        $output->writeln('Operation is completed!');
    }

    private function parse($url, $parent = null)
    {
        echo $url.'
';

        // Looking for Classes
        $html = file_get_contents($url);

        $crawlerClass = new Crawler($html);
        $nodeClass = $crawlerClass->filterXPath('//div[@class="container-fluid underlined"]/div[@class="row"]/div[@class="col-md-6"]/a');

        foreach ($nodeClass as $itemClass) {
            $parserClass = new ParserClass();

            $parserClass->setNamespace($parent);
            $parserClass->setName(trim($itemClass->textContent));
            $parserClass->setDescription(ltrim(trim(str_replace($parserClass->getName(), '', $itemClass->parentNode->parentNode->textContent)), '.'));

            if (strstr($itemClass->parentNode->textContent, 'deprecated')) {
                $parserClass->setDescription(trim(str_replace('deprecated', '', $parserClass->getDescription())));
                $parserClass->setIsDeprecated(true);
            }
            $this->em->persist($parserClass);
        }

        // Looking for Interfaces
        $crawlerInterface = new Crawler($html);
        $nodeInterface = $crawlerInterface->filterXPath('//div[@class="container-fluid underlined"]/div[@class="row"]/div[@class="col-md-6"]/em/a');

        foreach ($nodeInterface as $itemInterface) {
            $parserInterface = new ParserInterface();

            $parserInterface->setNamespace($parent);
            $parserInterface->setName(trim($itemInterface->textContent));
            $parserInterface->setDescription(ltrim(trim(str_replace($parserInterface->getName(), '', $itemInterface->parentNode->parentNode->textContent)), '.'));

            if (strstr($itemInterface->parentNode->textContent, 'deprecated')) {
                $parserInterface->setDescription(trim(str_replace('deprecated', '', $parserInterface->getDescription())));
                $parserInterface->setIsDeprecated(true);
            }
            $this->em->persist($parserInterface);
        }

        $crawlerNamespace = new Crawler($html);
        foreach ($crawlerNamespace->filter('div.namespace-list > a') as $item) {
            $namespace  = new ParserNamespace();
            $namespace ->setName(trim($item->textContent));
            $namespace ->setPath(str_replace('../', '', trim($item->getAttribute('href'))));
            $namespace ->setVersion($this->branch);
            $namespace ->setCreatedAt(new \DateTime());
            $namespace ->setUpdatedAt(new \DateTime());
            $namespace ->setParent($parent);
            $this->em->persist($namespace);

            $url = 'http://api.symfony.com/master/'.$namespace ->getPath();
            $this->parse($url, $namespace);
        }
    }
}
