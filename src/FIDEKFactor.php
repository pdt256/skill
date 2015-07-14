<?php
namespace pdt256\elo;

class FIDEKFactor implements KFactorInterface
{
    public function getValue(ParticipantInterface $participant)
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
