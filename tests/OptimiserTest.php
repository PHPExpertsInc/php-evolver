<?php

namespace PeterColes\GAO\Tests;

use PeterColes\GAO\Optimiser;
use PeterColes\GAO\Population;
use PHPUnit\Framework\TestCase;
use PeterColes\GAO\Tests\Solutions\Mixed;
use PeterColes\GAO\Tests\Solutions\Integers;
use PeterColes\GAO\Exceptions\EvaluationDataException;

class OptimiserTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        mt_srand(0); // seed random number generator for consistent test results
    }

    /** @test */
    public function cannot_run_optimiser_without_evaluation_data()
    {
        $this->expectException(EvaluationDataException::class);
        $gao = new Optimiser();
        $gao->run();
    }

    /** @test */
    public function can_load_evaluation_data_after_gao_construction_and_run_optimiser()
    {
        $gao = new Optimiser();
        $gao->loadEvaluationData('anything');
        $gao->run();
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function can_load_evaluation_data_during_gao_construction_and_run_optimiser()
    {
        $gao = new Optimiser(['evaluationData' => 'something']);
        $gao->run();
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function can_initialise_new_population()
    {
        $population = new Population(Integers::class, 10);

        $this->assertCount(10, $population->solutions());
        foreach ($population->solutions() as $solution) {
            $this->assertInstanceOf(Integers::class, $solution);
            $this->assertCount(3, $solution->chromosomes());
        }
        $this->assertEquals([42, -4, -1], $population->solutions()[1]->chromosomes());
    }

    /** @test */
    public function can_evaluate_a_population_without_evaluation_data()
    {
        $population = new Population(Mixed::class, 3);
        $population->evaluate(null);
        $best = $population->findBest();

        $this->assertEquals(['C', 0.5928, 70], $best->chromosomes(), '', 0.0001);
        $this->assertEquals(231.0892, $best->fitness(), '', 0.0001);
    }

    /** @test */
    public function can_evaluate_a_population_with_evaluation_data()
    {
        $population = new Population(Integers::class, 3);
        $evalData = [[2, -1, 90], [3, 0, 85], [1, -2, 82]];
        $population->evaluate($evalData);
        $best = $population->findBest();

        $this->assertEquals([64, -39, 1], $best->chromosomes(), '', 0.0001);
        $this->assertEquals(758, $best->fitness(), '', 0.0001);
    }
}
