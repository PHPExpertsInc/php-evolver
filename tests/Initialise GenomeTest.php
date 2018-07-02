<?php

namespace PeterColes\GAO\Tests;

use PHPUnit\Framework\TestCase;
use PeterColes\GAO\Tests\Solutions\Textual;

class InitialiseGenomeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        mt_srand(0); // seed random number generator for consistent test results
    }

    /** @test */
    public function can_intialise_genome_as_string()
    {
        $solution = new Textual();

        $result = $solution->initialise();

        $this->assertEquals(30, sizeof($result));
        $this->assertEquals('zitxyxyjjiztfljkrinuqkhtznghfi', implode('', $result));
    }
}
