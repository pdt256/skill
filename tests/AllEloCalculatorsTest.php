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
            [1500, 1500, DRAW, 1500, 1500, $eloCalculator],
            [1500, 1500, DRAW, 1500, 1500, $iccEloCalculator],
            [1500, 1500, DRAW, 1500, 1500, $fideEloCalculator],

            // Expert beats Beginner
            [2500, 1000,  WIN, 2500,  999, $eloCalculator],
            [2500, 1000,  WIN, 2500, 1000, $iccEloCalculator],
            [1000, 2500, LOSE,  999, 2500, $iccEloCalculator],
            [2500, 1000,  WIN, 2500,  999, $fideEloCalculator],

            // Beginner beats Expert
            [1000, 2500,  WIN, 1031, 2468, $eloCalculator],
            [1000, 2500,  WIN, 1031, 2484, $iccEloCalculator],
            [2500, 1000, LOSE, 2484, 1032, $iccEloCalculator],
            [1000, 2500,  WIN, 1039, 2490, $fideEloCalculator],

            // ICC Example
            [2131, 1584,  WIN, 2132, 1582, $eloCalculator],
            [2131, 1584,  WIN, 2131, 1584, $iccEloCalculator],
            [1584, 2131, LOSE, 1582, 2132, $iccEloCalculator],
            [2131, 1584,  WIN, 2132, 1582, $fideEloCalculator],
        ];
    }

    /**
     * @dataProvider getNewRatingsData
     */
    public function testGetNewRatings(
        $ratingA,
        $ratingB,
        $result,
        $expectedNewRatingA,
        $expectedNewRatingB,
        EloCalculatorInterface $eloCalculator
    ) {
        if ($result === WIN) {
            $scoreA = WIN;
            $scoreB = LOSE;
        } elseif ($result === LOSE) {
            $scoreA = LOSE;
            $scoreB = WIN;
        } else {
            $scoreA = DRAW;
            $scoreB = DRAW;
        }

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
