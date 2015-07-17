<?php
namespace pdt256\skill\Elo;

use pdt256\skill\Participant;

class EloCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNewRatingsDraw()
    {
        $participantA = new Participant;
        $participantA->setRating(1500);
        $participantA->setScore(0.5);

        $participantB = new Participant;
        $participantB->setRating(1500);
        $participantB->setScore(0.5);

        $eloCalculator = new EloCalculator(32);
        list($newRatingA, $newRatingB) = $eloCalculator->getNewRatings($participantA, $participantB);

        $this->assertSame(1500, $newRatingA);
        $this->assertSame(1500, $newRatingB);
    }

    public function testGetNewRatingsExpertBeatsBeginner()
    {
        $participantA = new Participant;
        $participantA->setRating(2500);
        $participantA->setScore(1);

        $participantB = new Participant;
        $participantB->setRating(1000);
        $participantB->setScore(0);

        $eloCalculator = new EloCalculator(32);
        list($newRatingA, $newRatingB) = $eloCalculator->getNewRatings($participantA, $participantB);

        $this->assertSame(2500, $newRatingA);
        $this->assertSame(999, $newRatingB);
    }

    public function getWinProbabilityData()
    {
        return [
            [1500, 1500, 0.5,      0.5     ], // Draw
            [2000, 1000, 0.996847, 0.003152], // A should win by large margin
            [1000, 2000, 0.003152, 0.996847], // B should win by large margin
            [1600, 1400, 0.759746, 0.240253], // 75% margin
            [2131, 1584, 0.958860, 0.041139], // Existing online example
        ];
    }

    /**
     * @dataProvider getWinProbabilityData
     */
    public function testGetWinProbability($ratingA, $ratingB, $expectedProbabilityA, $expectedProbabilityB)
    {
        $participantA = new Participant;
        $participantA->setRating($ratingA);

        $participantB = new Participant;
        $participantB->setRating($ratingB);

        $eloCalculator = new EloCalculator(32);
        list($probabilityA, $probabilityB) = $eloCalculator->getWinProbability($participantA, $participantB);

        $this->assertEquals($expectedProbabilityA, $probabilityA, null, FLOAT_DELTA);
        $this->assertEquals($expectedProbabilityB, $probabilityB, null, FLOAT_DELTA);
    }
}
