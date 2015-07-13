<?php
namespace pdt256\elo;

class EloTest extends \PHPUnit_Framework_TestCase
{
    public function testDraw()
    {
        // Player A (1500) ties Player 2 (1500)
        // Send input score object with scores
        // Return score object with new scores

        $eloCalculator = new EloCalculator;

        $scoreA = 1500;
        $scoreB = 1500;

        $newScores = $eloCalculator->calculate($scoreA, $scoreB);

        $this->assertTrue($newScores instanceof EloScoreInterface);
        $this->assertSame(1500, $newScores->getScoreA());
        $this->assertSame(1500, $newScores->getScoreB());
    }
}
