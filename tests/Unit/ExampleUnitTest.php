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

    public function testStringContainsSwareWords()
    {
        $stringService = new StringService();

        $containsSwareWords = $stringService->containsSwareWords(
            'I hate you',
            ['hate', 'idiot']
        );

        //$this->assertTrue($containsSwareWords);
        $this->assertEquals(
            $containsSwareWords,
            true
        );
    }

    public function testStringDoesNotContainSwareWords()
    {
        $stringService = new StringService();

        $containsSwareWords = $stringService->containsSwareWords(
            'Some random string',
            ['hate', 'idiot']
        );

        //$this->assertFalse($containsSwareWords);
        $this->assertEquals(
            $containsSwareWords,
            false
        );
    }
}
