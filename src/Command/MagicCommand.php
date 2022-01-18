<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MagicCommand extends Command
{
    protected static $defaultName = 'app:magic';
    protected static $defaultDescription = 'Funkcja czyniąca magię';

    protected function configure(): void
    {
        $this
            ->addArgument('trick_name', InputArgument::REQUIRED, 'Trick name')
            ->addArgument('numbers', InputArgument::REQUIRED | InputArgument::IS_ARRAY, 'Numbers')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $trickName = $input->getArgument('trick_name');
        $numbers = $input->getArgument('numbers');

        if ($trickName === 'TADAM') {
            $io->success('TADAM! Zrobiłem sztuczkę');
            return Command::SUCCESS;
        }

        if ($trickName === 'BORING_TRICK') {
            $output = '';

            foreach($numbers as $key => $number) {

                if ($key >= 26) continue;

                for($i = 0; $i < $number; $i++) {
                    $output .= chr($key + 65);
                }

            }

            $io->success($output);
            return Command::SUCCESS;
        }


        $io->error('Nie znam takiej sztuczki :(');
        return Command::INVALID;
    }
}
