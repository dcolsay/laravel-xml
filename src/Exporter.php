<?php

namespace Dcolsay\XML;

use Dcolsay\XML\Writer\Writer;
use Dcolsay\XML\Contracts\FromArray;
use Illuminate\Support\Facades\Storage;

class Exporter
{
    /**
     * @var object
     */
    protected $exportable; 

    protected $writer;

    public function __construct($export)
    {
        $this->exportable = $export;
        $this->writer = Writer::make();
    }

    public function export()
    {
        if($this->exportable instanceof FromArray);
            $this->fromArray($this->exportable->array(), $this->exportable->root);
        //    $this->writer->setElement($this->exportable->root, $this->exportable->fromArray());

        $this->save();

    }

    protected function fromArray(array $elements, string $key)
    {
        collect($elements)->each(fn($element, $key) => $this->writer->setElement($key, $element));
    }

    public function save()
    {
        Storage::append('demo.xml', $this->writer->flush(true));
    }
}
