<?php
namespace pdt256\skill\Elo;

use pdt256\skill\Participant;

class IccEloCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNewRatingsDraw()
    {
        $white = new Participant;
        $white->setRating(1500);
        $white->setScore(EloCalculator::DRAW);

        $black = new Participant;
        $black->setRating(1500);
        $black->setScore(EloCalculator::DRAW);

        $eloCalculator = new IccEloCalculator;
        list($newRatingWhite, $newRatingBlack) = $eloCalculator->getNewRatings($white, $black);

        $this->assertSame(1500, $newRatingWhite);
        $this->assertSame(1500, $newRatingBlack);
    }

    public function testGetNewRatingsWhiteExpertBeatsBeginner()
    {
        $white = new Participant;
        $white->setRating(2500);
        $white->setScore(EloCalculator::WIN);

        $black = new Participant;
        $black->setRating(1000);
        $black->setScore(EloCalculator::LOSE);

        $eloCalculator = new IccEloCalculator;
        list($newRatingWhite, $newRatingBlack) = $eloCalculator->getNewRatings($white, $black);

        $this->assertSame(2500, $newRatingWhite);
        $this->assertSame(1000, $newRatingBlack);
    }

    public function testGetNewRatingsBlackExpertBeatsBeginner()
    {
        $white = new Participant;
        $white->setRating(1000);
        $white->setScore(EloCalculator::LOSE);

        $black = new Participant;
        $black->setRating(2500);
        $black->setScore(EloCalculator::WIN);

        $eloCalculator = new IccEloCalculator;
        list($newRatingWhite, $newRatingBlack) = $eloCalculator->getNewRatings($white, $black);

        $this->assertSame(999, $newRatingWhite);
        $this->assertSame(2500, $newRatingBlack);
    }
}
