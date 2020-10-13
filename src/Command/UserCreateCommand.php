<?php

namespace App\Command;

use App\Services\UserService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
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
     * User service instance
     * @var UserService
     */
    protected $user_service;

    /**
     * UserCreateCommand constructor.
     * @param string|null $name
     * @param UserService $user_service
     */
    public function __construct(string $name = null, UserService $user_service)
    {
        parent::__construct($name);

        $this->user_service = $user_service;
    }

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
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $io->ask('Please, enter email for new user');
        $phone = $io->ask('Please, enter phone for new user');
        $password = $io->askHidden('Please, enter password for new user');

        $user = $this->user_service->create($email, $phone, $password);

        $io->success('User successfully created!');

        return Command::SUCCESS;
    }
}
