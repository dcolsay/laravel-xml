<?php

namespace Dcolsay\XML\Writer;

use XMLWriter;
use Dcolsay\XML\Writer\Concerns\HasNode;

class Writer extends XMLWriter
{
    use HasNode;

    /** @var string Path to the output file */
    protected $path = '';

    protected $version = '1.0';

    protected $root = 'root';

    public function __construct(string $path)
    {
        $this->path = $path;

        $this->createWriterFromFile($path);
    }

    # Creators

    protected function createWriterFromFile($path)
    {
        
        $this->openUri($path);
        $this->startDocument();

        return $this;

    }

    public static function create(string $file)
    {
        return new static($file);
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
        $this->setIndent(true);
        
        return $this;
    }

    public function save($values, $root="", string $filename = "")
    {
    
        $root = blank($root) ? $this->root : $root;

       $this->startElement($root);

       foreach($values as $node => $value)
       {
           $this->addNode($node, $value);
       }

       $this->endElement();
    }

}
