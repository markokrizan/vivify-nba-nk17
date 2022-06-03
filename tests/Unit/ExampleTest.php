<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{

    public function testCalculatePriceError()
    {
        $calculationService = new PriceCalculationService();

        $this->expectExceptionMessage('Price and discount percentate must be greater than 0');

        $calculationService->calculatePrice(-1, 20);
    }

    public function testCalculatePrice()
    {
        $calculationService = new PriceCalculationService(10, 20);

        $price = $calculationService->calculatePrice(10, 20);

        $this->assertEquals(
            $price,
            8
        );
    }
}
