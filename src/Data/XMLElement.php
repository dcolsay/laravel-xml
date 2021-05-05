<?php

namespace Dcolsay\XML\Data;

class XMLElement extends \SimpleXMLElement
{
    // @see https://www.php.net/manual/en/function.dom-import-simplexml.php
    public function dom()
    {
        return dom_import_simplexml($this);
    }

    // @see https://code.tutsplus.com/tutorials/parse-xml-to-an-array-in-php-with-simplexml--cms-35529
    public function toJson()
    {
        return json_encode($this);
    }
    
    public function toArray()
    {
        return json_decode($this->toJson(), TRUE);
    }
}
