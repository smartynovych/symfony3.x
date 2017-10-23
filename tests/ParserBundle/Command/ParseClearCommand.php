<?php

namespace Tests\AppBundle\Command;

use MsgParserBundle\Command\ParseClearCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ParseClearCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $application->add(new ParseClearCommand());

        $command = $application->find('msg:parse:clear');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array());

        $output = $commandTester->getDisplay();
        $this->assertContains('You did it!', $output);
    }
}
