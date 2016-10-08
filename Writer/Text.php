<?php

class UtilityRate_Writer_Text extends UtilityRate_Writer_Abstract
{
    protected function _prepareOutput($data)
    {
        $output = '';

        foreach ($data as $key => $value) {
            $output .= $key . ": " . $value . "\n";
        }

        $this->_output = $output;
    }
}
