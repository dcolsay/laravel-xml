<?php

namespace Dcolsay\XML\Writer\Concerns;

use Illuminate\Support\Arr;
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

    protected function addArrayNode($name, array $values)
    {
        if(Arr::isAssoc($values)) {
            $this->addAssocArrayNode($name, $values);
        } else {
            $this->addNormalArrayNode($name, $values);
        }
    }

    protected function addAssocArrayNode($name, $values)
    {
        try {
            $this->writer->startElement($this->slug($name));
        } catch (\Throwable $th) {
            // dd($name, $values);
            throw $th;
        }

        foreach ($values as $node => $value) {

            $this->addNode($node, $value);
        }

        $this->writer->endElement();
    }

    protected function addNormalArrayNode($name, $values)
    {
        foreach ($values as $value) {
            $this->addNode($name, $value);
        }
    }

    public function slug($element, $delimiter = '_')
    {
        return Str::of($element)
            ->replace(" ", $delimiter, $element)
            ->__toString();
    }
}
