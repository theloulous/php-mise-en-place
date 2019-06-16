<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PhpCsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('php-cs-fixer')
            ->setDescription('Configure PHPCSFixer.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(self::class . ': start');
        $output->writeln(self::class . ': stop');
    }
}