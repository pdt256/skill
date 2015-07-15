<?php
namespace pdt256\elo;

class EloCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function getNewRatingsData()
    {
        $staticKFactor = new StaticKFactor(32);
        $iccKFactor = new ICCKFactor();
        $fideKFactor = new FIDEKFactor();

        define('WIN', 1);
        define('LOSE', 0);
        define('DRAW', 0.5);

        return [
            [1500, DRAW, 1500, DRAW, 1500, 1500, $staticKFactor], // Draw
            [2500,  WIN, 1000, LOSE, 2500,  999, $staticKFactor], // Expert beats Beginner
            [1000,  WIN, 2500, LOSE, 1031, 2468, $staticKFactor], // Beginner beats Expert

            [1500, DRAW, 1500, DRAW, 1500, 1500, $iccKFactor], // Draw
            [2500,  WIN, 1000, LOSE, 2500,  999, $iccKFactor], // Expert beats Beginner
            [1000,  WIN, 2500, LOSE, 1031, 2484, $iccKFactor], // Beginner beats Expert

            [1500, DRAW, 1500, DRAW, 1500, 1500, $fideKFactor], // Draw
            [2500,  WIN, 1000, LOSE, 2500,  999, $fideKFactor], // Expert beats Beginner
            [1000,  WIN, 2500, LOSE, 1039, 2490, $fideKFactor], // Beginner beats Expert
        ];
    }

    /**
     * @dataProvider getNewRatingsData
     */
    public function testGetNewRatings(
        $ratingA,
        $scoreA,
        $ratingB,
        $scoreB,
        $expectedNewRatingA,
        $expectedNewRatingB,
        KFactorInterface $kFactor
    ) {
        $participantA = new Participant;
        $participantA->setRating($ratingA);
        $participantA->setScore($scoreA);

        $participantB = new Participant;
        $participantB->setRating($ratingB);
        $participantB->setScore($scoreB);

        $eloCalculator = new EloCalculator($kFactor);
        list($newRatingA, $newRatingB) = $eloCalculator->getNewRatings($participantA, $participantB);

        $this->assertSame($expectedNewRatingA, $newRatingA);
        $this->assertSame($expectedNewRatingB, $newRatingB);
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

        $eloCalculator = new EloCalculator(new StaticKFactor(32));
        list($probabilityA, $probabilityB) = $eloCalculator->getWinProbability($participantA, $participantB);

        $this->assertEquals($expectedProbabilityA, $probabilityA, null, FLOAT_DELTA);
        $this->assertEquals($expectedProbabilityB, $probabilityB, null, FLOAT_DELTA);
    }
}
