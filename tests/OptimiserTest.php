<?php

namespace PeterColes\GAO\Tests;

use PeterColes\GAO\Optimiser;
use PHPUnit\Framework\TestCase;
use PeterColes\GAO\Tests\Solutions\Mixed;
use PeterColes\GAO\Exceptions\MissingModelException;

class OptimiserTest extends TestCase
{
    /** @test */
    public function can_load_evaluation_data_after_gao_construction_and_run_optimiser()
    {
        $gao = new Optimiser(['model' => Mixed::class]);
        $gao->loadEvaluationData('anything');
        $gao->run();
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function can_load_evaluation_data_during_gao_construction_and_run_optimiser()
    {
        $gao = new Optimiser(['evaluationData' => 'something', 'model' => Mixed::class]);
        $gao->run();
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function cannot_run_optimiser_without_specifying_model()
    {
        $this->expectException(MissingModelException::class);

        $optimiser = new Optimiser();
        $optimiser->run();
    }

    /** @test */
    public function running_optimiser_yields_results_for_each_generation()
    {
        $optimiser = new Optimiser(['model' => Mixed::class]);
        $optimiser->run();

        $this->assertCount(10, $optimiser->results);
        foreach ($optimiser->results as $result) {
            $this->assertInstanceOf(Mixed::class, $result);
        }
    }
}
