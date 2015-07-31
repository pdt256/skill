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

        $calculator = new DuellingEloCalculator(new EloCalculator(32));
        list($newRatingsTeam1, $newRatingsTeam2) = $calculator->getNewRatings($team1, $team2);
        list($newRatingParticipant1, $newRatingParticipant2) = $newRatingsTeam1;
        list($newRatingParticipant3, $newRatingParticipant4) = $newRatingsTeam2;

        $this->assertSame(1500, $newRatingParticipant1);
        $this->assertSame(1500, $newRatingParticipant2);
        $this->assertSame(1500, $newRatingParticipant3);
        $this->assertSame(1500, $newRatingParticipant4);
    }

    public function getNewRatingsData()
    {
        return [
             [ // Equal teams Draw
                [1500, 1500], [1500, 1500], AbstractEloCalculator::DRAW,
                [1500, 1500], [1500, 1500],
            ],
            [ // Expert team beats beginner team
                [2400, 2500], [1000, 1100], AbstractEloCalculator::WIN,
                [2400, 2500], [999, 1099],
            ],
            [ // Beginner team beats expert team
                [2400, 2500], [1000, 1100], AbstractEloCalculator::LOSE,
                [2368, 2468], [1031, 1131],
            ],
        ];
    }

    /**
     * @dataProvider getNewRatingsData
     */
    public function testGetNewRatings(
        $team1Ratings,
        $team2Ratings,
        $result,
        $expectedNewRatingTeam1,
        $expectedNewRatingTeam2
    ) {
        if ($result === AbstractEloCalculator::WIN) {
            $score1 = AbstractEloCalculator::WIN;
            $score2 = AbstractEloCalculator::LOSE;
        } elseif ($result === AbstractEloCalculator::LOSE) {
            $score1 = AbstractEloCalculator::LOSE;
            $score2 = AbstractEloCalculator::WIN;
        } else {
            $score1 = AbstractEloCalculator::DRAW;
            $score2 = AbstractEloCalculator::DRAW;
        }

        $team1 = $this->getTeamFromParticipantRatings($team1Ratings, $score1);
        $team2 = $this->getTeamFromParticipantRatings($team2Ratings, $score2);

        $calculator = new DuellingEloCalculator(new EloCalculator(32));
        list($newRatingsTeam1, $newRatingsTeam2) = $calculator->getNewRatings($team1, $team2);

        $this->assertSame($expectedNewRatingTeam1, $newRatingsTeam1);
        $this->assertSame($expectedNewRatingTeam2, $newRatingsTeam2);
    }

    /**
     * @param int[] $participantRatings
     * @param float $score
     * @return Team
     */
    private function getTeamFromParticipantRatings(array $participantRatings, $score)
    {
        $team = new Team($score);
        foreach ($participantRatings as $participantRating) {
            $team->addParticipant(new Participant($participantRating));
        }

        return $team;
    }
}
