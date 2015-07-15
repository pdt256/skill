<?php
namespace pdt256\elo;

class EloCalculator implements EloCalculatorInterface
{
    /** @var KFactorInterface */
    private $kFactorInterface;

    public function __construct(KFactorInterface $kFactor)
    {
        $this->kFactorInterface = $kFactor;
    }

    public function getNewRatings(ParticipantInterface $participantA, ParticipantInterface $participantB)
    {
        list($probabilityA, $probabilityB) = $this->getWinProbability($participantA, $participantB);

        return [
            $this->getIndividualRating($participantA, $probabilityA),
            $this->getIndividualRating($participantB, $probabilityB),
        ];
    }

    private function getIndividualRating(ParticipantInterface $participant, $expectedScore)
    {
        $kFactor = $this->kFactorInterface->getValue($participant);

        $adjustment = (int) floor($kFactor * ($participant->getScore() - $expectedScore));

        $newRating = $participant->getRating() + $adjustment;
        return $newRating;
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
    private function getIndividualProbability($ratingA, $ratingB)
    {
        return (1 / (1 + (pow(10, ($ratingA - $ratingB) / 400))));
    }
}
