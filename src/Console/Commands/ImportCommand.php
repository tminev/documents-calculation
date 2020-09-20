<?php

namespace Console\Commands;

use Application\Services\FileService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportCommand
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class ImportCommand extends Command
{
    /**
     * @var DefaultName
     */
    protected static $defaultName = 'app:import';

    /**
     * @var FileService
     */
    private $fileService;

    /**
     * ImportCommand constructor.
    * @param FileService $fileService
     *
     */
    public function __construct(FileService $fileService)
    {
        parent::__construct();

        $this->fileService = $fileService;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('app:import')
            ->setDescription('Import and calculate invoices')
            ->addArgument('path', InputArgument::REQUIRED, 'Path of file to import.')
            ->addArgument('exchangeRates', InputArgument::REQUIRED, 'List of exchange rates')
            ->addArgument('requestedCurrency', InputArgument::REQUIRED, 'Desired currency of the result')
            ->addOption('vat', null, InputOption::VALUE_REQUIRED, 'filter by vat identificator');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');
        $exchangeRates = $input->getArgument('exchangeRates');
        $requestedCurrency = $input->getArgument('requestedCurrency');
        $filter = $input->getOption('vat');

        $output->writeln('Importing file: '. $path);
        $data = $this->fileService->getFileContent($path);
        $result = $this->fileService->process($data, $filter, $exchangeRates, $requestedCurrency);

        foreach ($result as $key => $value) {
            $output->writeln('Customer: '. $value[0]['customer'] . "(".$key.") - " . $value['totalАmount'] . "  " .$value[0]['currency']);
        }

        return 0;
    }
}
