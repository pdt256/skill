<?php
namespace pdt256\skill;

interface ParticipantInterface
{
    /**
     * @return int
     */
    public function getRating();

    /**
     * @param int $rating
     */
    public function setRating($rating);

    /**
     * @return float
     */
    public function getScore();

    /**
     * @param float $score
     */
    public function setScore($score);

    /**
     * @return int
     */
    public function getTotalGames();

    /**
     * @param int $totalGames
     */
    public function setTotalGames($totalGames);
}
