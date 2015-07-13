<?php
namespace pdt256\elo;

class EloCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function getNewRatingsData()
    {
        return [
            [1500, 0.5, 1500, 0.5, 1500, 1500], // Draw
            [2131, 1.0, 1584, 0.0, 2132, 1582], // Expert beats average player
        ];
    }

    /**
     * @dataProvider getNewRatingsData
     */
    public function testGetNewRatings($ratingA, $scoreA, $ratingB, $scoreB, $newRatingA, $newRatingB)
    {
        $participantA = new Participant;
        $participantA->setRating($ratingA);
        $participantA->setScore($scoreA);

        $participantB = new Participant;
        $participantB->setRating($ratingB);
        $participantB->setScore($scoreB);

        $eloCalculator = new EloCalculator;
        $ratings = $eloCalculator->getNewRatings($participantA, $participantB);

        $this->assertSame($newRatingA, $ratings[0]);
        $this->assertSame($newRatingB, $ratings[1]);
    }

    public function getProbabilityData()
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
     * @dataProvider getProbabilityData
     */
    public function testGetProbability($ratingA, $ratingB, $expectedProbabilityA, $expectedProbabilityB)
    {
        $participantA = new Participant;
        $participantA->setRating($ratingA);

        $participantB = new Participant;
        $participantB->setRating($ratingB);

        $eloCalculator = new EloCalculator;
        list($probabilityA, $probabilityB) = $eloCalculator->getProbability($participantA, $participantB);

        $this->assertEquals($expectedProbabilityA, $probabilityA, null, FLOAT_DELTA);
        $this->assertEquals($expectedProbabilityB, $probabilityB, null, FLOAT_DELTA);
    }
}
