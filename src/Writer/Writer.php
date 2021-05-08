<?php

namespace Dcolsay\XML\Writer;

use Illuminate\Support\Str;
use XMLWriter;

class Writer extends XMLWriter
{

    protected $version = '1.0';

    public static function make()
    {
        $writer = new Writer;

        $writer->openMemory();
        $writer->pretty();

        return $writer;
    }

    public function makeFromFile($file)
    {
        # code...
    }

    public function setElement(string $element, $value)
    {
        if(is_array($value))
        {
            $this->addArrayElement($element, $value);
        }

        if(is_string($value))
        {
            $this->setTextElement($element, $value);
        }

        return $this;

    }

    public function pretty()
    {
        $this->setIndent(true);
    }

    public function setArrayElement(string $element, array $values)
    {
        # code...
    }

    public function setTextElement(string $element, string $value)
    {
        $this->addTextElement($element, $value);

        return $this;
    }

    protected function addTextElement(string $element, string $value)
    {
        $this->startElement($element);
        $this->text($value);
        $this->endElement();
    }

    protected function addArrayElement(string $element, array $values)
    {
        $this->startElement($this->replace($element));

        foreach ($values as $key => $value)
        {

            if(is_array($value))
            {
                $this->addArrayElement($this->replace($key),  $value);
            }else{

                $this->addTextElement($this->replace($key), $value);
            }

        }

        $this->endElement();
    }

    public function replace($element, $delimiter = '_')
    {
        return Str::of($element)
            ->replace(" ", $delimiter, $element);
    }

    public function output()
    {
        // Cas avec l'ouverture de la memory
        return $this->outputMemory();


    }

    public function export($export)
    {
        dd($export);
    }

    public function open($export)
    {
        // $this->exportable()
    }
}
