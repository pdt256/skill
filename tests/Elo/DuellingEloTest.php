<?php
namespace pdt256\skill\Elo;

use pdt256\skill\Participant;
use pdt256\skill\Team;

class DuellingEloCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNewRatingsDraw()
    {
        $participant1 = new Participant(1500);
        $participant2 = new Participant(1500);

        $team1 = new Team(AbstractEloCalculator::DRAW);
        $team1->addParticipant($participant1);
        $team1->addParticipant($participant2);

        $participant3 = new Participant(1500);
        $participant4 = new Participant(1500);

        $team2 = new Team(AbstractEloCalculator::DRAW);
        $team2->addParticipant($participant3);
        $team2->addParticipant($participant4);

        $calculator = new DuellingEloCalculator;
        list($newRatingsTeam1, $newRatingsTeam2) = $calculator->getNewRatings($team1, $team2);
        list($newRatingParticipant1, $newRatingParticipant2) = $newRatingsTeam1;
        list($newRatingParticipant3, $newRatingParticipant4) = $newRatingsTeam2;

        $this->assertSame(1500, $newRatingParticipant1);
        $this->assertSame(1500, $newRatingParticipant2);
        $this->assertSame(1500, $newRatingParticipant3);
        $this->assertSame(1500, $newRatingParticipant4);
    }
}
