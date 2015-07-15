<?php
namespace pdt256\elo;

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
}
