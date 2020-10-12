<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class UserCreateCommand
 * @package App\Command
 */
final class UserCreateCommand extends Command
{
    /**
     * Name for running of command
     * @var string
     */
    protected static $defaultName = 'user:create';

    /**
     * Configure console command
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription('Register new user!');
    }

    /**
     * Execute console command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $io->ask('Please, enter email for new user');
        $password = $io->askHidden('Please, enter password for new user');

        $io->success('User successfully created!');

        return Command::SUCCESS;
    }
}
