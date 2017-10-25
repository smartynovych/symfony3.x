<?php

namespace Tests\AppBundle\Command;

use ParserBundle\Command\ParseCreateCommand;
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

        $command = $application->find('parse:create');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('branch' => 'master', 'url' => 'http://api.symfony.com/master/Symfony/Component/Translation.html'));

        $output = $commandTester->getDisplay();
        $this->assertContains('Operation is completed!', $output);
    }
}
