<?php

namespace MsgParserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParseClearCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('msg:parse:clear')

            // the short description shown while running "php bin/console list"
            ->setDescription('Truncate all parsed data from Symfony API request.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to clear all local Symfony API data:
            
    php bin/console msg:clear
            ')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $query = $em->createQuery('DELETE FROM MsgParserBundle\Entity\MsgParserClasses');
        $query->execute();

        $query = $em->createQuery('DELETE FROM MsgParserBundle\Entity\MsgParserNamespace');
        $query->execute();

        $query = $em->createQuery('DELETE FROM MsgParserBundle\Entity\MsgParserInterfaces');
        $query->execute();

        $output->writeln('You done!');
    }
}
