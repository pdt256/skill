<?php
namespace pdt256\elo;

class Participant implements ParticipantInterface
{
    /** @var int */
    private $rating;

    /** @var int */
    private $score;

    public function __construct($rating = null, $score = null)
    {
        $this->setRating($rating);
        $this->setScore($score);
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = (int) $rating;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($score)
    {
        $this->score = (int) $score;
    }
}
