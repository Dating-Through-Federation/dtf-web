<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'user:admin',
    description: 'Add admin credentials to a user.',
)]
class UserAdminCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::OPTIONAL, 'Username address to elevate to Admin privileges')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');
        $repo = $this->entityManager->getRepository(User::class);

        if (!$username) {
            $username = $io->ask('Username Address of user to make admin:', null, function ($username) {
                if (!$username) {
                    throw new \RuntimeException('You must use an username address.');
                }

                return $username;
            });
        }

        $user = $repo->findOneBy(['username' => $username]);
        if (!$user) {
            throw new \RuntimeException('User not found');
        }

        $user->setStatus(User::STATUS_ACTIVE)
            ->setType(User::TYPE_ADMIN);

        $this->entityManager->persist($user);
        $this->entityManager->flush($user);

        $io->success(sprintf('User %s has admin privileges.', $user->getUsername()));

        return Command::SUCCESS;
    }
}
