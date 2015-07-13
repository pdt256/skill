<?php
namespace pdt256\elo;

class EloScore implements EloScoreInterface
{
    /** @var int */
    private $scoreA;

    /** @var int */
    private $scoreB;

    public function getScoreA()
    {
        return $this->scoreA;
    }

    public function setScoreA($scoreA)
    {
        $this->scoreA = (int) $scoreA;
    }

    public function getScoreB()
    {
        return $this->scoreB;
    }


    public function setScoreB($scoreB)
    {
        $this->scoreB = (int) $scoreB;
    }
}
