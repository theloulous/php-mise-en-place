<?php

namespace App\Command;

use App\PhpVersion;
use App\PhpCsFixer\Configuration;
use League\Plates\Engine;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

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

        $phpCsFixerConfiguration = $this->decideCsFixerConfiguration($input, $output);

        $templates = new Engine(dirname(__DIR__) .'/PhpCsFixer/template');
        $fileData = $templates->render('.php_cs', ['configuration' => $phpCsFixerConfiguration]);

        file_put_contents('./.php_cs', $fileData);

        $output->writeln(self::class . ': stop');

        return 0;
    }

    /**
     * @throws \App\PhpVersionException
     */
    private function decideCsFixerConfiguration(InputInterface $input, OutputInterface $output) : Configuration
    {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'What is the php version of your project ?',
            PhpVersion::CURRENT_VERSIONS
        );

        $version = $helper->ask($input, $output, $question);

        return new Configuration($version);
    }
}