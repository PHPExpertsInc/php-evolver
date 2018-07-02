<?php

namespace PeterColes\GAO\Tests;

use PHPUnit\Framework\TestCase;
use PeterColes\GAO\Tests\Solutions\Mixed;
use PeterColes\GAO\Tests\Solutions\Chars;
use PeterColes\GAO\Tests\Solutions\Floats;
use PeterColes\GAO\Tests\Solutions\Integers;

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
        $solution = new Chars();

        $result = $solution->initialise();

        $this->assertEquals(30, sizeof($result));
        $this->assertEquals('zitxyxyjjiztfljkrinuqkhtznghfi', implode('', $result));
    }

    /** @test */
    public function can_intialise_genome_as_integers()
    {
        $solution = new Integers();

        $result = $solution->initialise();

        $this->assertEquals(3, sizeof($result));
        $this->assertEquals([64, -39, 1], $result);
    }

    /** @test */
    public function can_intialise_genome_as_floats()
    {
        $solution = new Floats();

        $result = $solution->initialise();

        $this->assertEquals(4, sizeof($result));
        $this->assertEquals([54.8814, -40.7155, 0.7152, 0.6885], $result, '', 0.0001);
    }

    /** @test */
    public function can_intialise_genome_with_mixed_chromosome_types()
    {
        $solution = new Mixed();

        $result = $solution->initialise();

        $this->assertEquals(3, sizeof($result));
        $this->assertEquals(['C', 0.5928, 70], $result, '', 0.0001);
    }
}
