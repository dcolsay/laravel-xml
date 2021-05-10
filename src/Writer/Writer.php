<?php

namespace Dcolsay\XML\Writer;

use XMLWriter;
use Illuminate\Support\Str;
use Dcolsay\XML\Writer\Concerns\HasNode;

class Writer extends XMLWriter
{
    use HasNode;
    
    private XMLWriter $writer;

    /** @var string Path to the output file */
    protected $path = '';

    protected $version = '1.0';

    public function __construct(string $path, string $type = 'xml')
    {
        $this->path = $path;

        $this->writer = WriterFactory::createWriterFromFile($path);
    }

    # Creators

    public static function create(string $file, callable $configureWiter = null)
    {
        $writer = new static($file);

        $xmlWriter = $writer->getWriter();

        if($configureWiter) {
            $configureWiter($xmlWriter);
        }

        return $writer;
    }

    # Getters
    public function getPath(): string
    {
        return $this->path;
    }

    public function getWriter(): XMLWriter
    {
        return $this->writer;
    }

    # Setters

    


    public static function make()
    {
        $writer = new Writer;

        $writer->openMemory();
        $writer->pretty();

        return $writer;
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
        $this->writer->setIndent(true);
        
        return $this;
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
        try {
            $this->startElement($this->replace($element));
        } catch (\Throwable $th) {
           dd($element);
        }

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
}
