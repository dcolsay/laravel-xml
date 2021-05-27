<?php

namespace Dcolsay\XML\Writer;

use XMLWriter;

class WriterFactory
{

    public static function createWriterFromMemory()
    {
        $writer = new XMLWriter;

        $writer->openMemory();

        return $writer;
    }

    public static function createWriterFromFile($path)
    {
        $writer = new XMLWriter;
        
        $writer->openUri($path);

        return $writer;

    }
}
