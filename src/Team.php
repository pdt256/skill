<?php
namespace pdt256\skill;

class Team implements TeamInterface
{
    /** @var ParticipantInterface[] */
    private $participants;

    /** @var float */
    private $score;

    public function __construct($score = null)
    {
        $this->setScore($score);
    }

    public function getParticipants()
    {
        return $this->participants;
    }

    public function addParticipant(ParticipantInterface $participant)
    {
        $this->participants[] = $participant;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($score)
    {
        $this->score = (float) $score;
    }
}
