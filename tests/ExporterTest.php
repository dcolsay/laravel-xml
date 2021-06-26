<?php

namespace Dcolsay\XML\Tests;

use Dcolsay\XML\Exporter;
use Dcolsay\XML\Contracts\FromArray;
use Spatie\TemporaryDirectory\TemporaryDirectory;

class ExporterTest extends TestCase
{
    private TemporaryDirectory $temporaryDirectory;

    public function setUp(): void 
    {
        parent::setUp();

        $this->temporaryDirectory = new TemporaryDirectory(__DIR__ . '/temp');

    }

    // public function test_it_can_export()
    // {
    //     $exportable = new ExportableFromArray;
    //     $file = $this->temporaryDirectory->path('test_export_array.xml');

    //     $exporter = new Exporter($exportable, $file);
    //     // $exporter->export();

    // }
}

class ExportableFromArray implements FromArray
{
    public $root = 'root';

    public function array(): array
    {
        return [
            'Good guy' => [
    
                'name' => 'Luke Skywalker',
                'weapon' => 'Lightsaber',

            ],
            'Bad guy' => [
                'name' => 'Sauron',
                'weapon' => 'Evil Eye',

            ],
        ];
    }
}
