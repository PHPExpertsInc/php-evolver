<?php

namespace PeterColes\GAO\Tests;

use PeterColes\GAO\Optimiser;
use PeterColes\GAO\Population;
use PHPUnit\Framework\TestCase;
use PeterColes\GAO\Tests\Solutions\Integers;
use PeterColes\GAO\Exceptions\EvaluationDataException;

class OptimiserTest extends TestCase
{
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
        mt_srand(0); // seed random number generator for consistent test results

        $population = new Population(Integers::class, 10);

        $this->assertCount(10, $population->solutions());
        foreach ($population->solutions() as $solution) {
            $this->assertInstanceOf(Integers::class, $solution);
            $this->assertCount(3, $solution->chromosomes());
        }
        $this->assertEquals([42, -4, -1], $population->solutions()[1]->chromosomes());
    }
}
