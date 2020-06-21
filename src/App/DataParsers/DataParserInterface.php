<?php

namespace App\DataParsers;

interface DataParserInterface
{
    public function setData(array $data);

    public function parse();
}