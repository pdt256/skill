<?php
namespace pdt256\elo;

interface EloCalculatorInterface
{
    /**
     * @param int $scoreA
     * @param int $scoreB
     * @return EloScoreInterface
     */
    public function calculate($scoreA, $scoreB);
}
