<?php
namespace pdt256\elo;

interface ParticipantInterface
{
    public function getRating();

    /**
     * @param int $rating
     */
    public function setRating($rating);

    public function getScore();

    /**
     * @param float $score
     */
    public function setScore($score);
}
