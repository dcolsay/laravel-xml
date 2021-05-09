<?php

namespace Dcolsay\XML;

use Dcolsay\XML\Writer\Writer;
use Dcolsay\XML\Contracts\FromArray;
use Illuminate\Support\Facades\Storage;
use Dcolsay\XML\Contracts\WithMutipleRoots;

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
        // Vérifier l'existance sinon mettre dans fichier de configuration
        $this->writer->startElement($this->exportable->root);


        if($this->exportable instanceof FromArray)
            $this->fromArray($this->exportable->array());

        if($this->exportable instanceof WithMutipleRoots){
            $this->withMutipleRoots($this->exportable->roots());
        }

        $this->save();

    }

    // public function addNode($node, $elements)
    // {
    //     $this->writer->startElement($node)
    //     $this
    // }

    protected function fromArray(array $elements)
    {
        collect($elements)->each(fn($element, $key) => $this->writer->setElement($key, $element));
    }
    
    protected function fromArrayWithKey(array $elements, $key)
    {
        collect($elements)->each(fn($element) => $this->writer->setElement($key, $element));
    }

    protected function withMutipleRoots(array $roots)
    {
        foreach($roots as $root){
            
            if($root instanceof FromArray){
                $this->fromArrayWithKey($root->array(), $root->root);
            }
        }
    }

    public function save()
    {
        $this->writer->endElement();
        Storage::append('demo.xml', $this->writer->flush(true));
    }
}
