<?php

namespace MsgParserBundle\Command;

use MsgParserBundle\Entity\MsgParserClass;
use MsgParserBundle\Entity\MsgParserInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\OutputInterface;
use MsgParserBundle\Entity\MsgParserNamespace;

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
            
    php bin/console msg:parse:clear
            ')
            // TODO: для разширения функционала команды
/*            ->setDefinition(
                new InputDefinition(array(
                    new InputArgument('branch', InputArgument::OPTIONAL),
                    new InputArgument('namespace', InputArgument::OPTIONAL),
                ))
            )*/
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // TODO: для разширения функционала команды
        /*
        $branch = trim(ltrim($input->getArgument('branch'),'b='));
        $nameSpace = trim(ltrim($input->getArgument('namespace'),'ns='));
        */

        $em = $this->getContainer()->get('doctrine')->getManager();

        $namespace = $em->getRepository(MsgParserNamespace::class)->findAll();
        foreach ($namespace as $item) {
            $em->remove($item);
        }
        $em->flush();

        $output->writeln('You done!');
    }
}
