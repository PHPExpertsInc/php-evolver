<?php

namespace PHPExperts\GAO\Tests;

use PHPUnit\Framework\TestCase;
use PHPExperts\GAO\Tests\Solutions\Mixed;
use PHPExperts\GAO\Tests\Solutions\Chars;
use PHPExperts\GAO\Tests\Solutions\Floats;
use PHPExperts\GAO\Tests\Solutions\Integers;

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
        $solution->initialise();

        $this->assertEquals(30, sizeof($solution->chromosomes()));
        $this->assertEquals('zitxyxyjjiztfljkrinuqkhtznghfi', implode('', $solution->chromosomes()));
    }

    /** @test */
    public function can_intialise_genome_as_integers()
    {
        $solution = new Integers();
        $solution->initialise();

        $this->assertEquals(3, sizeof($solution->chromosomes()));
        $this->assertEquals([64, -39, 1], $solution->chromosomes());
    }

    /** @test */
    public function can_intialise_genome_as_floats()
    {
        $solution = new Floats();
        $solution->initialise();

        $this->assertEquals(4, sizeof($solution->chromosomes()));
        $this->assertEquals([54.8814, -40.7155, 0.7152, 0.6885], $solution->chromosomes(), '', 0.0001);
    }

    /** @test */
    public function can_intialise_genome_with_mixed_chromosome_types()
    {
        $solution = new Mixed();
        $solution->initialise();

        $this->assertEquals(3, sizeof($solution->chromosomes()));
        $this->assertEquals(['C', 0.5928, 70], $solution->chromosomes(), '', 0.0001);
    }
}
