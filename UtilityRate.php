<?php
require_once '_bootstrap.php';

class UtilityRate
{
    protected $_api;
    protected $_writer;
    protected $_outputFormat = 'text';
    protected $_coords;
    protected $_address;

    public function __construct()
    {
        $this->_api = new UtilityRate_Api_Nrel();
    }

    public function setFormat($outputFormat)
    {
        $this->_outputFormat = $outputFormat;
    }

    public function getFormat()
    {
        return $this->_outputFormat;
    }

    public function getCoords()
    {
        return $this->_coords;
    }

    public function setCoords(array $coords)
    {
        $this->_coords = $coords;
    }

    public function getAddress()
    {
        return $this->_address;
    }

    public function setAddress($address)
    {
        $this->_address = $address;
    }

    public function outputRates($outputFile = null)
    {
        if (count($this->_coords) >= 2) {
            $rates = $this->_api->getRatesFromLatLong($this->_coords[0], $this->_coords[1]);
        } else if (strlen($this->_address) > 0) {
            $rates = $this->_api->getRatesFromAddress($this->_address);
        } else {
            return;
        }

        $data = $this->_parseRates($rates);
        $writerFactory = new UtilityRate_Writer_Factory();
        $writer = $writerFactory::getWriter($this->_outputFormat);

        if (is_null($outputFile)) {
            $writer->output($data);
        } else {
            $writer->output($data, $outputFile);
        }

    }

    protected function _parseRates($rates)
    {
        $properties = array(
            'Utility Name' => 'utility_name',
            'Residential Rate' => 'residential',
            'Commercial Rate' => 'commercial',
            'Industrial Rate' => 'industrial',
        );

        if (property_exists($rates, 'outputs')) {
            $result = array();
            $outputs = $rates->outputs;
            foreach ($properties as $property => $oldPropertyName) {
                if (property_exists($outputs, $oldPropertyName)) {
                    $result[$property] = $outputs->$oldPropertyName;
                } else {
                    $result[$property] = '';
                }
            }

            return $result;
        } else {
            return false;
        }
    }
}
