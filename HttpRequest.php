<?php

class UtilityRate_HttpRequest
{
    protected $_url;
    protected $_timeout = 0;

    public function getUrl()
    {
        return $this->_url;
    }

    public function setUrl($url)
    {
        $this->_url = $url;

        return $this;
    }

    public function setTimeout($timeout)
    {
        $this->_timeout = $timeout;

        return $this;
    }

    public function buildUrlFromParams($baseUrl, $params)
    {
        $this->_url = $baseUrl . '?' . http_build_query($params);

        return $this;
    }

    public function execute()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
