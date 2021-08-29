<?php

namespace Eelcol\LaravelTradetracker\Support\Connectors;

use Carbon\Carbon;
use Eelcol\LaravelTradetracker\Exceptions\TradetrackerBadCredentials;
use Exception;
use SoapClient;

class Tradetracker
{
    protected array $data;

    protected SoapClient $client;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getTransactions($site_id, Carbon $startDate, ?Carbon $endDate = null)
    {
        if (is_null($endDate)) {
            $endDate = clone $startDate;
            $endDate->addDay();
        }

        $options = [
            'registrationDateFrom' => $startDate->format('Y-m-d'),
            'registrationDateTo' => $endDate->format('Y-m-d'),
        ];

        return $this->getClient()->getConversionTransactions($site_id, $options);
    }

    protected function getClient()
    {
        if (!isset($this->client)) {
            $client = new SoapClient(
                'http://ws.tradetracker.com/soap/affiliate?wsdl', [
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP
            ]);

            try {
                $client->authenticate($this->data['id'], $this->data['secret']);
            } catch (Exception $e) {
                throw new TradetrackerBadCredentials();
            }

            $this->client = $client;
        }

        return $this->client;
    }
}