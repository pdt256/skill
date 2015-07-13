<?php
namespace pdt256\elo;

class EloCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCalculateDraw()
    {
        $participantA = new Participant;
        $participantA->setRating(1500);
        $participantA->setScore(21);

        $participantB = new Participant;
        $participantA->setRating(1500);
        $participantB->setScore(21);

        $eloCalculator = new EloCalculator;
        $ratings = $eloCalculator->calculate($participantA, $participantB);

        $this->assertSame(1500, $ratings[0]);
        $this->assertSame(1500, $ratings[1]);
    }

    public function getOddsData()
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
     * @dataProvider getOddsData
     */
    public function testGetOdds($ratingA, $ratingB, $expectedScoreA, $expectedScoreB)
    {
        $participantA = new Participant;
        $participantA->setRating($ratingA);

        $participantB = new Participant;
        $participantB->setRating($ratingB);

        $eloCalculator = new EloCalculator;
        $odds = $eloCalculator->getOdds($participantA, $participantB);

        $this->assertEquals($expectedScoreA, $odds[0], null, FLOAT_DELTA);
        $this->assertEquals($expectedScoreB, $odds[1], null, FLOAT_DELTA);
    }
}
