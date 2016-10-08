<?php

abstract class UtilityRate_Writer_Abstract
{
    protected $_output;

    public function output($data, $file = 'php://output')
    {
        $this->_prepareOutput($data);
        $handle = fopen($file, 'w');
        fwrite($handle, $this->_output);
        fclose($handle);
    }

    protected function _prepareOutput($data)
    {
        $this->_output = $data;
    }
}
