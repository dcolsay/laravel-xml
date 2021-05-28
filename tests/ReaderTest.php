<?php

namespace Dcolsay\XML\Tests;

use Dcolsay\XML\Reader\Reader;

class ReaderTest extends TestCase
{
    /** @test */
    public function it_can_work_with_an_empty_file()
    {
        $reader = new Reader($this->getStubPath('empty.xml'));
        
        $actualCount = $reader->getRows()->count();

        $this->assertEquals(0, $actualCount);
    }

    /** @test */
    public function it_can_count_rows()
    {
        $reader = new Reader($this->getStubPath('Contracts.xml'));
        
        
        $actualCount = $reader->unique('Contract')->getRows()->count();

        $this->assertEquals(1, $actualCount);
    }

    public function test_unique_method_with_pubmed_xml()
    {
        $reader = new Reader($this->getStubPath('pubmed-example.xml'));
        
        $actualCount = $reader->unique('PubmedArticle')->getRows()->count();

        // $reader->unique('PubmedArticle')->getRows();

       

        $this->assertEquals(3, $actualCount);
    }

    public function test_getContainer()
    {
        $reader = new Reader($this->getStubPath('Contracts.xml'));
        
        
        $actualCount = $reader->unique('Contract')->getRows()->count();

        $container = $reader->getContainer();

        $this->assertEquals(1, $actualCount);
    }
}
