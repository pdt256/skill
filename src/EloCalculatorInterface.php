<?php
namespace pdt256\elo;

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
    public function getProbability(ParticipantInterface $participantA, ParticipantInterface $participantB);
}
