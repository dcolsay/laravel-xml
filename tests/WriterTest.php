<?php

namespace Dcolsay\XML\Tests;

use Dcolsay\XML\Writer\Writer;
use Spatie\TemporaryDirectory\TemporaryDirectory;

class WriterTest extends TestCase
{
    private TemporaryDirectory $temporaryDirectory;

    private string $pathToCsv;

    public function setUp(): void 
    {
        parent::setUp();

        $this->temporaryDirectory = new TemporaryDirectory(__DIR__ . '/temp');

        $this->pathToCsv = $this->temporaryDirectory->path('test.xml');
    }

    /** @test */
    public function it_can_write_a_regular_xml()
    {
        $path = $this->temporaryDirectory->path('test_regular.xml');
        Writer::create($path)
            ->addNode('demo', 'Good')
            ->addNode('demo', 'Good');

        $this->assertTrue(true);
    }

    /** @test */
    public function it_can_write_pretty()
    {
        $path = $this->temporaryDirectory->path('test_pretty.xml');
        Writer::create($path)
            ->pretty()
            ->addNode('demo', 'Good')
            ->addNode('demo', 'Good');

        $this->assertTrue(true);
    }

    /** @test */
    public function it_can_write_array_node()
    {
        $path = $this->temporaryDirectory->path('test_array_node.xml');
        Writer::create($path)
            ->pretty()
            ->addNode('demo', [
                'Good guy' => [
    
                    'name' => 'Luke Skywalker',
                    'weapon' => 'Lightsaber',
    
                ],
                'Bad guy' => [
                    'name' => 'Sauron',
                    'weapon' => 'Evil Eye',
    
                ],

                'Good Girl' => 'Laula'
            ]);

        $this->assertTrue(true);
    }

    /** @test */
    public function it_can_write_multi_dimension_array()
    {
        $path = $this->temporaryDirectory->path('test_multi_dimension_array.xml');
        Writer::create($path)
            ->pretty()
            ->addNode('demo', [
                'Good guys' => [
                    'Guy' => [
                        ['name' => 'Luke Skywalker', 'weapon' => 'Lightsaber'],
                        ['name' => 'Captain America', 'weapon' => 'Shield'],
                    ],
                ],
                'Bad guys' => [
                    'Guy' => [
                        ['name' => 'Sauron', 'weapon' => 'Evil Eye'],
                        ['name' => 'Darth Vader', 'weapon' => 'Lightsaber'],
                    ],
                ],
            ]);

        $this->assertTrue(true);
    }

    /** @test */
    public function it_can_write_mutiple_node()
    {
        $path = $this->temporaryDirectory->path('test_mutiple_node.xml');
        Writer::create($path)
            ->pretty()
            ->addNode('demo', [
                'Good guy' => [
    
                    'name' => 'Luke Skywalker',
                    'weapon' => 'Lightsaber',
    
                ],
                'Bad guy' => [
                    'name' => 'Sauron',
                    'weapon' => 'Evil Eye',
    
                ],

                'Good Girl' => 'Laula'
            ])
            ->addNode('Bad Girl', 'Jane');

        $this->assertTrue(true);
    }

}
