<?php

namespace PeterColes\GAO\Tests;

use PeterColes\GAO\Optimiser;
use PHPUnit\Framework\TestCase;
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
}
