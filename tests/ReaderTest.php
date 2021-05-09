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
}
