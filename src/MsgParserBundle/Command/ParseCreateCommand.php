<?php

namespace MsgParserBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\DomCrawler\Crawler;

class ParseCreateCommand extends Command
{
    /*
     * Symfony API branch version
     */
    const SYMFONY_BRANCH = 3.3;

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('msg:parse:create')

            // the short description shown while running "php bin/console list"
            ->setDescription('Make a new parse Symfony API request.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to parse the Symfony API schema for a given Symfony branch (default master):
            
    php bin/console msg:parse
    php bin/console msg:parse 3.1
            ')
            // configure an argument
            ->addArgument('branch', InputArgument::OPTIONAL, 'Symfony API branch')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = "http://api.symfony.com/master/index.html";
        $arAllowBranch = array(2.7, 2.8, 3.2, 3.3, 3.4);

        if (in_array(sprintf('%.1f', $input->getArgument('branch')), $arAllowBranch)) {
            $url = sprintf("http://api.symfony.com/%.1f/index.html", $input->getArgument('branch'));
        }

        $html = file_get_contents($url);
        $crawler = new Crawler($html);

        $output->writeln('Source parse: '.$url);
        $output->writeln('NameSpace List: ');

        foreach ($crawler->filter('div.namespace-container > ul > li > a') as $item) {
            $output->writeln('NameSpace Path:    '.$item->getAttribute('href'));
        }
    }
}
