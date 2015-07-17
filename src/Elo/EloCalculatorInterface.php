<?php
namespace pdt256\skill\Elo;

use pdt256\skill\ParticipantInterface;

interface EloCalculatorInterface
{
    /**
     * @param ParticipantInterface $participantA
     * @param ParticipantInterface $participantB
     * @return int[]
     */
    public function getNewRatings(ParticipantInterface $participantA, ParticipantInterface $participantB);

    /**
     * @param ParticipantInterface $participantA
     * @param ParticipantInterface $participantB
     * @return float
     */
    public function getWinProbability(ParticipantInterface $participantA, ParticipantInterface $participantB);
}
