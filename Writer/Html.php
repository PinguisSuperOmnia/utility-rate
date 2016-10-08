<?php

class UtilityRate_Writer_Html extends UtilityRate_Writer_Abstract
{
    public function _prepareOutput($data)
    {
        $result = '<table>';
        $result .= '<tr>';
        foreach (array_keys($data) as $key) {
            $result .= '<th>' . htmlentities($key) . '</th>';
        }
        $result .= '</tr>';

        $result .= '<tr>';
        foreach ($data as $value) {
            $result .= '<td>' . htmlentities($value) . '</td>';
        }
        $result .= '</tr>';

        $result .= '</table>';

        $this->_output = $result;
    }
}
