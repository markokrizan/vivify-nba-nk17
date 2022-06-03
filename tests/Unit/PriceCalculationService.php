<?php

namespace Tests\Unit;

use Exception;

class PriceCalculationService {

    public function calculatePrice(int $amount, int $discountPercentage): int
    {
        if ($amount < 0 || $discountPercentage < 0) {
            throw new Exception('Price and discount percentate must be greater than 0');
        }

        $discount = $amount * ($discountPercentage / 100);

        return $amount - $discount;
    }
}
