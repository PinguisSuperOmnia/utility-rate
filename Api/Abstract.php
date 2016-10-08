<?php

abstract class UtilityRate_Api_Abstract
{
    protected $_baseUrl = '';
    protected $_format = '';
    protected $_httpRequest = '';

    public function __construct()
    {
        $this->_httpRequest = new UtilityRate_HttpRequest;
        $this->_httpRequest->setTimeout(5);
    }

    public function getResponseFromParams($params)
    {
        $this->_httpRequest->buildUrlFromParams($this->_baseUrl . '.' . $this->_format, $params);
        $response = $this->_httpRequest->execute();
        return $response;
    }
}
