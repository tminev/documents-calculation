<?php

namespace Application\Services;

use Application\Exceptions\NotFoundException;
use Exception;
use Throwable;

/**
 * Class FileService
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class FileService
{
    /**
     * @var array
     */
    public $allowedCurrencies = [];

    /**
     * FileService constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->allowedCurrencies = isset($config['allowedCurrencies']) ? $config['allowedCurrencies'] : [];
    }

    /**
     * Get file content and convert to array
     *
     * @param string $path
     *
     * @return array
     *
     * @throws Exception
     * @throws NotFoundException
     */
    public function getFileContent(string $path): array
    {
        try {
            if (!file_exists($path)) {
                throw new NotFoundException('File not found.');
            }

            $handle = fopen($path, "r");

            if (!$handle) {
                throw new Exception('File open failed.');
            }

            $data = [];

            while (!feof($handle)) {
                $data[] = trim(fgets($handle));
            }

            fclose($handle);

            if (strlen($data[0])<5) {
                throw new Exception('File is empty.');
            }
        } catch (Throwable $th) {
            $message = sprintf(
                'Problem with imported file: %s',
                $th->getMessage()
            );

            throw new Exception($message);
        }

        return $data;
    }

    /**
     * File processing
     *
     * @param  array $data
     * @param  string $filter
     *
     * @return array
     */
    public function process(
        array $data,
        string $filter = null,
        string $exchangeRates,
        string $requestedCurrency
    ): array {
        for ($i=0; $i < count($data); $i++) {
            $data[$i] = explode(',', $data[$i]);
        }

        $result = array_column($data, 1, 1);
        unset($result['Vat number']);

        if (isset($filter)) {
            $result = [$filter=>$filter];
        }

        foreach ($result as $key => $value) {
            $curUserDocuments = [];

            for ($i=1; $i < count($data); $i++) {
                if (count($data[$i]) !== 7) {
                    throw new Exception('Invalid file format at line '. $i);
                }

                if ($key === intval($data[$i][1])) { //sorting data
                    $document = [
                        'customer' => $data[$i][0],
                        'vatNumber' => $data[$i][1],
                        'documentNumber' => $data[$i][2],
                        'type' => $data[$i][3],
                        'parentDocument' => $data[$i][4],
                        'currency' => $requestedCurrency,
                        'total' => $this->currencyExchange($exchangeRates, $requestedCurrency, $data[$i][5], $data[$i][6]),
                    ];

                    array_push($curUserDocuments, $document);
                }
            }

            $this->parentDocumentExist($curUserDocuments);
            $result[$key] = $curUserDocuments ;
            $result[$key]['totalАmount'] = $this->calculateTotal($curUserDocuments);
        }

        return $result;
    }

   /**
     * Change currency by the current rate
     *
     * @param string $exchangeRates
     * @param string $requestedCurrency
     * @param string $documentCurrency
     * @param int $documentValue
     *
     * @return int
     *
     * @throws Exception
     */
    public function currencyExchange(
        string $exchangeRates,
        string $requestedCurrency,
        string $documentCurrency,
        int $documentValue
    ): int {
        $currencies = explode(',', $exchangeRates);

        for ($i=0; $i < count($currencies); $i++) {
            $currencies[$i] = explode(':', $currencies[$i]);
            $key = $currencies[$i][0];

            if (!in_array($key, $this->allowedCurrencies)) {
                throw new NotFoundException('Currency ' . $key. ' Not Found');
            }

            if (!in_array($requestedCurrency, $this->allowedCurrencies)) {
                throw new NotFoundException('Requested Currency ' . $requestedCurrency. ' Not Found');
            }

            $$key = $currencies[$i][1];
        }

        if ($documentCurrency === $requestedCurrency) {
            $result = $documentValue;
        }

        if ($documentCurrency !== 'EUR' && $requestedCurrency !== 'EUR') {
            $result = $documentValue / $$documentCurrency * $$requestedCurrency;
        }

        if ($documentCurrency === 'EUR') {
            $result = $documentValue * $$requestedCurrency;
        }

        if ($requestedCurrency === 'EUR') {
            $result = $documentValue / $$documentCurrency;
        }

        return $result;
    }

    /**
     * Check the existence of a parent document
     *
     * @param  array $curUserDokuments
     *
     * @return bool
     *
     * @throws NotFoundException
     */
    public function parentDocumentExist($curUserDokuments)
    {
        for ($i=0; $i < count($curUserDokuments); $i++) {
            if (strlen($curUserDokuments[$i]['parentDocument'])) {
                if (!in_array($curUserDokuments[$i]['parentDocument'], array_column($curUserDokuments, 'documentNumber'))) {
                    throw new NotFoundException('Document number ' . $curUserDokuments[$i]['parentDocument']
                     . ' Not Found, attached to document ' . $curUserDokuments[$i]['documentNumber']);
                }
            }
        }

        return true;
    }

    /**
     * Calculate the total amount of all documents
     *
     * @param  array $curUserDocuments
     *
     * @return int
     *
     */
    public function calculateTotal($curUserDocuments): int
    {
        $totalАmount=0;

        for ($i=0; $i < count($curUserDocuments); $i++) {
            if ($curUserDocuments[$i]['type']=== "2") {
                $totalАmount-=$curUserDocuments[$i]['total'];
            } else {
                $totalАmount+=$curUserDocuments[$i]['total'];
            }
        }

        return $totalАmount;
    }
}
