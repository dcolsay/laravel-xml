<?php

namespace Dcolsay\XML\Writer\Concerns;

use Illuminate\Support\Str;

trait HasNode
{
    /**
     * Add new Node
     *
     * @param array|string $row
     * @return self
     */
    public function addNode(string $name, $row)
    {
        if(is_string($row))
            $this->addTextNode($name, $row);

        if(is_array($row))
            $this->addArrayNode($name, $row);

        return $this;

    }

    public function addTextNode(string $name, string $value)
    {
        $this->writer->startElement($this->slug($name));
        $this->writer->text($value);
        $this->writer->endElement();
    }

    public function addArrayNode($name, array $values)
    {
        $this->writer->startElement($this->slug($name));

        foreach ($values as $node => $value) {
            $this->addNode($node, $value);
            
            // if(is_string($value))
            //     $this->addTextNode($node, $value);

            // if(is_array($value))
            //     $this->addArrayNode($node, $value);
        }

        $this->writer->endElement();
    }

    public function slug($element, $delimiter = '_')
    {
        return Str::of($element)
            ->replace(" ", $delimiter, $element)
            ->__toString();
    }
}
