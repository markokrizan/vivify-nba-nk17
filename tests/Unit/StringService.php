<?php

namespace Tests\Unit;

class StringService {

    public function containsSwareWords(string $word, array $swareWords): bool
    {
        foreach($swareWords as $swareWord) {
            if (str_contains($word, $swareWord)) {
                return true;
            }
        }

        return false;
    }
}
