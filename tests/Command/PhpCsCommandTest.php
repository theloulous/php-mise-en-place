<?php


namespace Test\Command;


use App\Command\PhpCsCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class PhpCsCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $application = new Application();
        $application->add(new PhpCsCommand());
        $command = $application->find('php-cs-fixer');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
           'command' => $command->getName(),
        ]);
        $output = $commandTester->getDisplay();
        self::assertStringContainsString('App\Command\PhpCsCommand: start', $output);
        self::assertStringContainsString('App\Command\PhpCsCommand: stop', $output);
    }
}