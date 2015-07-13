<?php
namespace pdt256\elo;

interface EloScoreInterface
{
    public function getScoreA();
    public function setScoreA($scoreA);

    public function getScoreB();
    public function setScoreB($scoreB);
}
