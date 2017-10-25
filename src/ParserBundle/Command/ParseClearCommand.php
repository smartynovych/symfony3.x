<?php

namespace ParserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ParserBundle\Entity\ParserNamespace;

class ParseClearCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('parse:clear')

            // the short description shown while running "php bin/console list"
            ->setDescription('Truncate all parsed data from Symfony API request.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to clear all local Symfony API data:
            
    php bin/console parse:clear
            ')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $namespace = $em->getRepository(ParserNamespace::class)->findAll();
        foreach ($namespace as $item) {
            $em->remove($item);
        }
        $em->flush();

        $output->writeln('You did it!');
    }
}
