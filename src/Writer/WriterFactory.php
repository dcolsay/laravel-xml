<?php

namespace Dcolsay\XML\Writer;

use XMLWriter;

class WriterFactory
{

    public static function createWriter($type)
    {
        // TODO : 
    }

    public static function createWriterFromFile($path)
    {
        $writer = new XMLWriter;
        
        // $writer->openMemory();
        $writer->openUri($path);

        return $writer;

    }
}
