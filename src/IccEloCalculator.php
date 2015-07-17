<?php
namespace pdt256\skill;

class IccEloCalculator extends AbstractEloCalculator
{
    protected function getParticipantKFactor(ParticipantInterface $participant)
    {
        $rating = $participant->getRating();

        if ($rating > 2400) {
            return 16;
        } elseif ($rating >= 2100) {
            return 24;
        } else {
            return 32;
        }
    }

    public function getNewRatings(ParticipantInterface $white, ParticipantInterface $black)
    {
        list($probabilityWhite, $probabilityBlack) = $this->getWinProbability($white, $black);

        $whiteAdjustment = $this->getIndividualAdjustment($white, $probabilityWhite);
        $newRatingWhite = $white->getRating() + $whiteAdjustment;

        $blackKFactor = $this->getParticipantKFactor($black);
        $whiteKFactor = $this->getParticipantKFactor($white);

        $blackAdjustment = $this->getBlackAdjustment($whiteAdjustment, $blackKFactor, $whiteKFactor);
        $newRatingBlack = $black->getRating() + $blackAdjustment;

        return [
            $newRatingWhite,
            $newRatingBlack,
        ];
    }

    /**
     * @param int $whiteAdjustment
     * @param int $blackKFactor
     * @param int $whiteKFactor
     * @return int
     */
    protected function getBlackAdjustment($whiteAdjustment, $blackKFactor, $whiteKFactor)
    {
        return (int) floor(-1 * ($whiteAdjustment * $blackKFactor / $whiteKFactor));
    }
}
