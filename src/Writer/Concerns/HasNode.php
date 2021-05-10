<?php

namespace Dcolsay\XML\Writer\Concerns;

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

        return $this;

    }

    public function addTextNode(string $name, string $value)
    {
        $this->writer->startElement($name);
        $this->writer->text($value);
        $this->writer->endElement();
    }
}
