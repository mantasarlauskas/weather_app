<?php

namespace App\Command;

use App\Age\AdultChecker;
use App\Age\AgeCalculator;
use App\Age\AgeManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AgeCalculatorCommand extends Command
{
    protected static $defaultName = 'app:age:calculator';

    /**
     * @var AgeManager $ageManager
     */
    private $ageManager;

    public function __construct(AgeManager $ageManager)
    {
        $this->ageManager = $ageManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Age calculator')
            ->addArgument('birthDate', InputArgument::REQUIRED, 'Birth Date')
            ->addOption('adult', null, InputOption::VALUE_NONE, 'Is adult')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $birthDate = $input->getArgument('birthDate');

        if ($birthDate) {
            $io->note(sprintf($this->ageManager->getAgeMessage($birthDate)));
        }

        if ($input->getOption('adult')) {
            $message = $this->ageManager->getAdultMessage();

            if(strpos($message, 'YES') !== false) {
                $io->success($message);
            } elseif(strpos($message, 'NO') !== false) {
                $io->warning($message);
            }
        }
    }
}
