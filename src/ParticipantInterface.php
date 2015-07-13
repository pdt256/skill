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
     * @param int $score
     */
    public function setScore($score);
}
