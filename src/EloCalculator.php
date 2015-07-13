<?php
namespace pdt256\elo;

class EloCalculator implements EloCalculatorInterface
{
    private $kFactor = 32;

    public function getNewRatings(ParticipantInterface $participantA, ParticipantInterface $participantB)
    {
        list($probabilityA, $probabilityB) = $this->getProbability($participantA, $participantB);

        return [
            $this->getIndividualRating($participantA, $probabilityA),
            $this->getIndividualRating($participantB, $probabilityB),
        ];
    }

    private function getIndividualRating(ParticipantInterface $participant, $expectedScore)
    {
        $kFactor = $this->kFactor;

        $newRating = $participant->getRating() + ($kFactor * ($participant->getScore() - $expectedScore));

        return (int) floor($newRating);
    }

    public function getProbability(ParticipantInterface $participantA, ParticipantInterface $participantB)
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
    private function getIndividualProbability($ratingA, $ratingB)
    {
        return (1 / (1 + (pow (10, ($ratingA - $ratingB) / 400))));
    }
}
