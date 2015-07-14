<?php
namespace pdt256\elo;

class Participant implements ParticipantInterface
{
    /** @var int */
    private $rating;

    /** @var float */
    private $score;

    /** @var int */
    private $totalGames;

    public function __construct($rating = null, $score = null, $totalGames = null)
    {
        $this->setRating($rating);
        $this->setScore($score);
        $this->setTotalGames($totalGames);
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
        $this->score = (float) $score;
    }

    public function getTotalGames()
    {
        return $this->totalGames;
    }

    public function setTotalGames($totalGames)
    {
        $this->totalGames = (int) $totalGames;
    }
}
