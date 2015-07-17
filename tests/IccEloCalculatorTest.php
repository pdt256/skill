<?php
namespace pdt256\skill;

class IccEloCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNewRatingsDraw()
    {
        $white = new Participant;
        $white->setRating(1500);
        $white->setScore(0.5);

        $black = new Participant;
        $black->setRating(1500);
        $black->setScore(0.5);

        $eloCalculator = new IccEloCalculator;
        list($newRatingWhite, $newRatingBlack) = $eloCalculator->getNewRatings($white, $black);

        $this->assertSame(1500, $newRatingWhite);
        $this->assertSame(1500, $newRatingBlack);
    }

    public function testGetNewRatingsWhiteExpertBeatsBeginner()
    {
        $white = new Participant;
        $white->setRating(2500);
        $white->setScore(1);

        $black = new Participant;
        $black->setRating(1000);
        $black->setScore(0);

        $eloCalculator = new IccEloCalculator;
        list($newRatingWhite, $newRatingBlack) = $eloCalculator->getNewRatings($white, $black);

        $this->assertSame(2500, $newRatingWhite);
        $this->assertSame(1000, $newRatingBlack);
    }

    public function testGetNewRatingsBlackExpertBeatsBeginner()
    {
        $white = new Participant;
        $white->setRating(1000);
        $white->setScore(0);

        $black = new Participant;
        $black->setRating(2500);
        $black->setScore(1);

        $eloCalculator = new IccEloCalculator;
        list($newRatingWhite, $newRatingBlack) = $eloCalculator->getNewRatings($white, $black);

        $this->assertSame(999, $newRatingWhite);
        $this->assertSame(2500, $newRatingBlack);
    }
}
