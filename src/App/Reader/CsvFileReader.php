<?php

namespace App\Reader;

/**
 * Class CsvFileReader
 *
 * @package App\Reader
 */
class CsvFileReader implements DataReaderInterface
{
    private $data = [];

    /**
     * The only purpose for this now is to take the data from the given file and return a list of string for it
     * Didn't go to deep into this and I've made it as simple as possible
     *
     * @param string $filePath
     *
     * @return $this
     */
    public function read(string $filePath)
    {
        if (($handle = fopen($filePath, "r")) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                $this->data[] = $row[0];
            }

            fclose($handle);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
