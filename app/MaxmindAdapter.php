<?php


namespace App;


class MaxmindAdapter implements AdapterInterface
{

    protected $reader;
    protected $record;

    public function __construct(\GeoIp2\Database\Reader $reader)
    {
        $this->reader = $reader;
    }

    public function parse(string $ip)
    {
        try {
            $this->record = $this->reader->city($ip);
        } catch (\GeoIp2\Exception\AddressNotFoundException $exception) {
            $this->record = $this->reader->city(env('DEFAULT_IP_ADDR'));
        }
    }

    public function getCountryCode()
    {
        return $this->record->country->isoCode;
    }

    public function getCityName()
    {
        return $this->record->city->name;
    }
}
