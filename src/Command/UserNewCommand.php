<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'user:new',
    description: 'Create a New User',
)]
class UserNewCommand extends Command
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher,
        private EntityManagerInterface $entityManager,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::OPTIONAL, 'Username of the new user')
            ->addOption('admin', null, InputOption::VALUE_NONE, 'Include to give admin privileges')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');

        if ($username) {
            $io->note(sprintf('Creating user with username %s', $username));
        } else {
            $username = $io->ask('Username Address of new user:', null, function ($username) {
                if (!$username) {
                    throw new \RuntimeException('You must use an username address.');
                }

                return $username;
            });
        }

        $user = new User();
        $profile = new Profile();
        $user->setProfile($profile);
        $user->setUsername($username);

        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                $io->askHidden('Please enter password', function ($password) {
                    if (!$password) {
                        throw new \RuntimeException('You must enter a password');
                    }

                    return $password;
                })
            )
        );

        $adminString = '';
        if ($admin = $input->getOption('admin')) {
            $user->setStatus(User::STATUS_ACTIVE)
                 ->setType(User::TYPE_ADMIN);
            $adminString = ' with admin privileges';
        } else {
            $user->setStatus(User::STATUS_INACTV)
                 ->setType(User::TYPE_USER);
        }

        $profile->setBirthdate(new \DateTime());
        $profile->setLocation('Nowhere');
        $profile->setBio('Account created on CLI.  Please fill in proper details as soon as possible.');

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success(sprintf('User %s created%s.', $user->getUsername(), $adminString));

        return Command::SUCCESS;
    }
}
