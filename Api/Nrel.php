<?php

class UtilityRate_Api_Nrel extends UtilityRate_Api_Abstract
{
    protected $_apiKey = 'PUT_API_KEY_HERE';
    protected $_baseUrl = 'https://developer.nrel.gov/api/utility_rates/v3';
    protected $_format = 'json';
    protected $_httpRequest;

    public function getRatesFromAddress($address)
    {
        return $this->_getRatesFromParams(array('address' => $address));
    }

    protected function _getRatesFromParams($params)
    {
        $params = array('api_key' => $this->_apiKey) + $params;
        $response = $this->getResponseFromParams($params);
        return json_decode($response);
    }

    public function getRatesFromLatLong($latitude, $longitude)
    {
        return $this->_getRatesFromParams(array('lat' => $latitude, 'lon' => $longitude));
    }
}
