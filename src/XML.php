<?php

namespace Dcolsay\XML;

use Dcolsay\XML\Writer\Writer;
use Illuminate\Filesystem\FilesystemManager;

class XML
{
    /**
     * @var Writer
     */
    protected $writer;

    /**
     * @var FilesystemManager
     */
    protected $filesystem;

    public function __construct(
        Writer $writer,
        FilesystemManager $filesystem
    )
    {
        $this->writer = $writer;
        $this->filesystem = $filesystem;
    }

    public function store($export, $filePath = '', $diskName = 'local', $diskOptions = [])
    {
        $temporaryFile = $this->export($export, $filePath);

        return true;

    }

    public function export($export, string $filename)
    {
        (new Exporter($export))->export();
        // $this->writer->export($export, $filename);
    }
}
