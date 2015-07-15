<?php
namespace pdt256\elo;

abstract class AbstractEloCalculator implements EloCalculatorInterface
{
    public function getNewRatings(ParticipantInterface $participantA, ParticipantInterface $participantB)
    {
        list($probabilityA, $probabilityB) = $this->getWinProbability($participantA, $participantB);

        return [
            $this->getIndividualRating($participantA, $probabilityA),
            $this->getIndividualRating($participantB, $probabilityB),
        ];
    }

    protected function getIndividualRating(ParticipantInterface $participant, $expectedScore)
    {
        $kFactor = $this->getParticipantKFactor($participant);
        $adjustment = (int) floor($kFactor * ($participant->getScore() - $expectedScore));

        $newRating = $participant->getRating() + $adjustment;
        return $newRating;
    }

    abstract protected function getParticipantKFactor(ParticipantInterface $participant);

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
