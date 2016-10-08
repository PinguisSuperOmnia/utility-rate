<?php

class UtilityRate_Writer_Json extends UtilityRate_Writer_Abstract
{
    protected function _prepareOutput($data)
    {
        $this->_output = json_encode($data);
    }
}
