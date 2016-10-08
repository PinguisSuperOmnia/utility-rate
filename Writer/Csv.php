<?php

class UtilityRate_Writer_Csv extends UtilityRate_Writer_Abstract
{
    protected function _prepareOutput($data)
    {
        $handle = fopen('php://memory', 'w');

        fputcsv($handle, array_keys($data));
        fputcsv($handle, $data);

        fseek($handle, 0);
        $result = stream_get_contents($handle);
        fclose($handle);

        $this->_output = $result;
    }
}
