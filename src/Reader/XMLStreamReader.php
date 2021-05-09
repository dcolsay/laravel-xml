<?php

namespace Dcolsay\XML\Reader;

use Prewk\XmlStringStreamer;
use Dcolsay\XML\Data\XMLElement;
use Illuminate\Support\LazyCollection;
use Prewk\XmlStringStreamer\Stream\File;
use Prewk\XmlStringStreamer\Parser\StringWalker;

abstract class XMLStreamReader
{
    protected $buffer = 16384;

    protected $streamer; 

    protected $filePath;
    
    public function __construct($path)
    {
        $this->filePath = $path;
    }

    protected function getParser()
    {
        return new StringWalker($this->options);
    }

    public function getStream()
    {
        // TODO : Vérifier si le $filePath n'est pas null
        return new File($this->filePath, $this->buffer);
    }

    public function parse($callback)
    {
        $streamer = $this->getStreamer();

        return LazyCollection::make(function () use ($streamer, $callback) {
            
            while($node = $streamer->getNode()) {
                $element = new XMLElement($node);

                yield call_user_func($callback, $element, $node);
            }

        });

    }

    protected function getStreamer()
    {
        return new XmlStringStreamer($this->getParser(), $this->getStream());
    }

    public function getRows($options = null)
    {
        return $this->parse(function($element){
            return $element;
        });
    }

    // public function getStream($path, $output)
    // {
    //     $totalSize = filesize($path);

    //     $bar = $output->createProgressBar($totalSize);
    //     $bar->start();

    //     // Construct the file stream
    //     $stream = new File($path, $this->buffer, function($chunk, $readBytes) use ($totalSize, $bar) {
    //         // This closure will be called every time the streamer requests a new chunk of data from the XML file
    //         echo "Progress: $readBytes / $totalSize\n";
    //         $bar->advance();

    //         if($readBytes == $totalSize)
    //             $bar->finish();
    //     });

    //     return $stream;
    // }
}
