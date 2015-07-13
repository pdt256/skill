<?php
namespace pdt256\elo;

class EloCalculator implements EloCalculatorInterface
{
    public function calculate(ParticipantInterface $participantA, ParticipantInterface $participantB)
    {
        return [1500, 1500];
    }

    public function getExpectedScores(ParticipantInterface $participantA, ParticipantInterface $participantB)
    {
        $expectedScoreA = $this->getExpectedScore($participantB->getRating(), $participantA->getRating());
        $expectedScoreB = 1 - $expectedScoreA;

        return [$expectedScoreA, $expectedScoreB];
    }

    /**
     * @param int $ratingA
     * @param int $ratingB
     * @return float
     */
    private function getExpectedScore($ratingA, $ratingB)
    {
        return (1 / (1 + (pow (10, ($ratingA - $ratingB) / 400))));
    }
}
