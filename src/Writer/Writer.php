<?php

namespace Dcolsay\XML\Writer;

use XMLWriter;
use Dcolsay\XML\Writer\Concerns\HasNode;

class Writer extends XMLWriter
{
    use HasNode;
    
    private XMLWriter $writer;

    /** @var string Path to the output file */
    protected $path = '';

    protected $version = '1.0';

    public function __construct(string $path)
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

    public function pretty()
    {
        $this->writer->setIndent(true);
        
        return $this;
    }

}
