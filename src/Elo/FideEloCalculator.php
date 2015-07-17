<?php
namespace pdt256\skill\Elo;

use pdt256\skill\ParticipantInterface;

class FideEloCalculator extends AbstractEloCalculator
{
    protected function getParticipantKFactor(ParticipantInterface $participant)
    {
        $rating = $participant->getRating();

        if ($participant->getTotalGames() < 30 && $rating < 2300) {
            return 40;
        } elseif ($rating >= 2400) {
            return 10;
        } else {
            return 20;
        }
    }
}
