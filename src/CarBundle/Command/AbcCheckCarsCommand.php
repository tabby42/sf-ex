<?php

namespace CarBundle\Command;

use CarBundle\Service\DataChecker;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AbcCheckCarsCommand extends Command
{

    /**
     * @var DataChecker
     */
    protected $carChecker;

    /**
     * @var EntityManager
     */
    protected $manager;

    /**
     * AbcCheckCarsCommand constructor.
     * @param DataChecker $carChecker
     * @param EntityManager $manager
     */
    public function __construct(DataChecker $carChecker, EntityManager $manager)
    {
        $this->carChecker = $carChecker;
        $this->manager = $manager;
        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setName('abc:check-cars')
            ->setDescription('...')
            ->addArgument('format', InputArgument::OPTIONAL, 'Progress Format')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$argument = $input->getArgument('argument');

        // if ($input->getOption('option')) {
            // ...
        // }

        // $output->writeln('Command result.');

        //$manager = $this->getContainer()->get('doctrine.orm.entity_manager');
        //$datachecker = $this->getContainer()->get('car.data_checker');
        $carRepository = $this->manager->getRepository('CarBundle:Car');
        $cars = $carRepository->findAll();

        $argument = $input->getArgument('format');

        $bar = new ProgressBar($output, count($cars));
        $bar->setFormat($argument);
        $bar->start();

        foreach ($cars as $car) {
            // $output->writeln($car->getId());
            $this->carChecker->checkCar($car);
            sleep(1);
            $bar->advance();
        }

        $bar->finish();
        $output->writeln('');
    }

}
