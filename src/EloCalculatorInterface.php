<?php
namespace pdt256\elo;

interface EloCalculatorInterface
{
    /**
     * @param ParticipantInterface $participantA
     * @param ParticipantInterface $participantB
     * @return int[]
     */
    public function calculate(ParticipantInterface $participantA, ParticipantInterface $participantB);

    /**
     * @param ParticipantInterface $participantA
     * @param ParticipantInterface $participantB
     * @return float
     */
    public function getOdds(ParticipantInterface $participantA, ParticipantInterface $participantB);
}
