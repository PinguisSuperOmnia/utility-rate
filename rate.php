#!/usr/bin/env php
<?php
require_once '_bootstrap.php';

class UtilityRate_Shell
{
    public function run()
    {
        $options = getopt('f::a::c::o::', array('format::', 'address::', 'coords::', 'file::'));

        $coords = '';
        $address = '';
        $format = 'text';
        $file = null;
        foreach ($options as $option => $value) {
            switch ($option) {
                case 'c':
                case 'coords':
                    $coords = $value;
                    break;
                case 'a':
                case 'address':
                    $address = $value;
                    break;
                case 'f':
                case 'format':
                    $format = $value;
                    break;
                case 'o':
                case 'file':
                    $file = $value;
                    break;
            }
        }


        if ($coords === '' && $address === '') {
            fprintf(STDERR, "%s", "Must specify either an address or lat/long coordinates.\n\n");
            fprintf(STDERR, "%s", $this->getUsage());
            exit(1);
        } else if (!in_array($format, array('text', 'csv', 'html', 'json'))) {
            fprintf(STDERR, "%s", "Please specify a valid output format.\n\n");
            fprintf(STDERR, "%s", $this->getUsage());
            exit(1);
        }

        $rate = new UtilityRate();
        $rate->setFormat($format);
        if (strlen($coords) >= 3 && strpos($coords, ',') !== false) {
            $rate->setCoords(explode(',', $coords));
        } else if (strlen($address) > 0) {
            $rate->setAddress($address);
        }
        $rate->outputRates($file);
    }

    public function getUsage()
    {
        $usage = 'Usage: ' . $_SERVER['argv'][0] . " [options]\n";

        $usage .= <<<USAGE
-c, --coords=<lat,lon>
-a, --address=<ADDRESS>
-f, --format=<text|csv|html|json>
-o, --file=<file_path>

USAGE;

        return $usage;
    }
}

$shell = new UtilityRate_Shell;
$shell->run();
