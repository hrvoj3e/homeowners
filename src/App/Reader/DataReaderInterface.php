<?php

namespace App\Reader;

interface DataReaderInterface
{
    public function read(string $filePath);
}