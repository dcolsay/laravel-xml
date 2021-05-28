<?php

namespace Dcolsay\XML\Reader;

class Reader extends XMLStreamReader
{
    public static function make($path)
    {
        $reader = new Reader($path);

        return new $reader;

    }
}
