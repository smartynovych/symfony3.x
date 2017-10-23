<?php

namespace Tests\AppBundle\Command;

use MsgParserBundle\Command\ParseCreateCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ParseCreateCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $application->add(new ParseCreateCommand());

        $command = $application->find('msg:parse:create');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('branch' => 'master', 'namespace' => 'Symfony\Component\Routing\Exception'));

        $output = $commandTester->getDisplay();
        $this->assertContains('Operation is completed!', $output);
    }
}
