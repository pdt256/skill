<?php
namespace pdt256\skill\Elo;

use pdt256\skill\ParticipantInterface;

abstract class AbstractEloCalculator implements EloCalculatorInterface
{
    const WIN = 1;
    const LOSE = 0;
    const DRAW = 0.5;

    abstract protected function getParticipantKFactor(ParticipantInterface $participant);

    public function getNewRatings(ParticipantInterface $participantA, ParticipantInterface $participantB)
    {
        list($probabilityA, $probabilityB) = $this->getWinProbability($participantA, $participantB);

        return [
            $participantA->getRating() + $this->getIndividualAdjustment($participantA, $probabilityA),
            $participantB->getRating() + $this->getIndividualAdjustment($participantB, $probabilityB),
        ];
    }

    /**
     * @param ParticipantInterface $participant
     * @param float $probability
     * @return int
     */
    protected function getIndividualAdjustment(ParticipantInterface $participant, $probability)
    {
        $kFactor = $this->getParticipantKFactor($participant);
        $adjustment = (int) floor($kFactor * ($participant->getScore() - $probability));

        return $adjustment;
    }

    public function getWinProbability(ParticipantInterface $participantA, ParticipantInterface $participantB)
    {
        $probabilityA = $this->getIndividualProbability($participantB->getRating(), $participantA->getRating());
        $probabilityB = 1 - $probabilityA;

        return [$probabilityA, $probabilityB];
    }

    /**
     * @param int $ratingA
     * @param int $ratingB
     * @return float
     */
    protected function getIndividualProbability($ratingA, $ratingB)
    {
        return (1 / (1 + (pow(10, ($ratingA - $ratingB) / 400))));
    }
}
