<?php
namespace pdt256\skill;

interface TeamInterface
{
    /**
     * @return ParticipantInterface[]
     */
    public function getParticipants();

    public function addParticipant(ParticipantInterface $participant);

    /**
     * @return float
     */
    public function getScore();

    /**
     * @param float $score
     */
    public function setScore($score);
}
