<?php
namespace pdt256\skill\Elo;

use pdt256\skill\TeamInterface;

class DuellingEloCalculator
{
    /**
     * @param TeamInterface $team1
     * @param TeamInterface $team2
     * @return int[][]
     */
    public function getNewRatings(TeamInterface $team1, TeamInterface $team2)
    {
        $newTeam1Ratings = [];
        foreach ($team1->getParticipants() as $participant) {
            $newTeam1Ratings[] = $participant->getRating();
        }

        $newTeam2Ratings = [];
        foreach ($team2->getParticipants() as $participant) {
            $newTeam2Ratings[] = $participant->getRating();
        }

        return [
            $newTeam1Ratings,
            $newTeam2Ratings,
        ];
    }
}
