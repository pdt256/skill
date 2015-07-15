<?php
namespace pdt256\elo;

class AllEloCalculatorsTest extends \PHPUnit_Framework_TestCase
{
    public function getNewRatingsData()
    {
        $eloCalculator = new EloCalculator(32);
        $iccEloCalculator = new IccEloCalculator();
        $fideEloCalculator = new FideEloCalculator();

        define('WIN', 1);
        define('LOSE', 0);
        define('DRAW', 0.5);

        return [
            [1500, DRAW, 1500, DRAW, 1500, 1500, $eloCalculator], // Draw
            [2500,  WIN, 1000, LOSE, 2500,  999, $eloCalculator], // Expert beats Beginner
            [1000,  WIN, 2500, LOSE, 1031, 2468, $eloCalculator], // Beginner beats Expert

            [1500, DRAW, 1500, DRAW, 1500, 1500, $iccEloCalculator], // Draw
            [2500,  WIN, 1000, LOSE, 2500,  999, $iccEloCalculator], // Expert beats Beginner
            [1000,  WIN, 2500, LOSE, 1031, 2484, $iccEloCalculator], // Beginner beats Expert

            [1500, DRAW, 1500, DRAW, 1500, 1500, $fideEloCalculator], // Draw
            [2500,  WIN, 1000, LOSE, 2500,  999, $fideEloCalculator], // Expert beats Beginner
            [1000,  WIN, 2500, LOSE, 1039, 2490, $fideEloCalculator], // Beginner beats Expert
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
        EloCalculatorInterface $eloCalculator
    ) {
        $participantA = new Participant;
        $participantA->setRating($ratingA);
        $participantA->setScore($scoreA);

        $participantB = new Participant;
        $participantB->setRating($ratingB);
        $participantB->setScore($scoreB);

        list($newRatingA, $newRatingB) = $eloCalculator->getNewRatings($participantA, $participantB);

        $this->assertSame($expectedNewRatingA, $newRatingA);
        $this->assertSame($expectedNewRatingB, $newRatingB);
    }
}
