<?php
namespace pdt256\elo;

class EloCalculator implements EloCalculatorInterface
{
    public function calculate($scoreA, $scoreB)
    {
        $eloScore = new EloScore;
        $eloScore->setScoreA(1500);
        $eloScore->setScoreB(1500);

        return $eloScore;
    }
}
