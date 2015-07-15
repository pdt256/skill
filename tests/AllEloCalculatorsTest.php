<?php
namespace pdt256\elo;

define('WIN', 1);
define('LOSE', 0);
define('DRAW', 0.5);

class AllEloCalculatorsTest extends \PHPUnit_Framework_TestCase
{
    public function getNewRatingsData()
    {
        $eloCalculator = new EloCalculator(32);
        $iccEloCalculator = new IccEloCalculator();
        $fideEloCalculator = new FideEloCalculator();

        return [
            // Draw
            [1500, DRAW, 1500, DRAW, 1500, 1500, $eloCalculator],
            [1500, DRAW, 1500, DRAW, 1500, 1500, $iccEloCalculator],
            [1500, DRAW, 1500, DRAW, 1500, 1500, $fideEloCalculator],

            // Expert beats Beginner
            [2500,  WIN, 1000, LOSE, 2500,  999, $eloCalculator],
            [2500,  WIN, 1000, LOSE, 2500, 1000, $iccEloCalculator],
            [1000, LOSE, 2500, WIN,   999, 2500, $iccEloCalculator],
            [2500,  WIN, 1000, LOSE, 2500,  999, $fideEloCalculator],

            // Beginner beats Expert
            [1000,  WIN, 2500, LOSE, 1031, 2468, $eloCalculator],
            [1000,  WIN, 2500, LOSE, 1031, 2484, $iccEloCalculator],
            [2500, LOSE, 1000,  WIN, 2484, 1032, $iccEloCalculator],
            [1000,  WIN, 2500, LOSE, 1039, 2490, $fideEloCalculator],

            // ICC Example
            [2131,  WIN, 1584, LOSE, 2132, 1582, $eloCalculator],
            [2131,  WIN, 1584, LOSE, 2131, 1584, $iccEloCalculator],
            [1584, LOSE, 2131,  WIN, 1582, 2132, $iccEloCalculator],
            [2131,  WIN, 1584, LOSE, 2132, 1582, $fideEloCalculator],
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
