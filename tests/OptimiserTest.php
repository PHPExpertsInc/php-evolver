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
}
