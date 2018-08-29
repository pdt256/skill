<?php
namespace pdt256\skill\Elo;

use pdt256\skill\ParticipantInterface;
use pdt256\skill\TeamInterface;

class DuellingEloCalculator
{
    /** @var EloCalculatorInterface */
    private $eloCalculator;

    public function __construct(EloCalculatorInterface $eloCalculator)
    {
        $this->eloCalculator = $eloCalculator;
    }

    /**
     * @param TeamInterface $team1
     * @param TeamInterface $team2
     * @return int[][]
     */
    public function getNewRatings(TeamInterface $team1, TeamInterface $team2)
    {
        $newTeam1Ratings = $this->getFirstTeamNewRatings($team1, $team2);
        $newTeam2Ratings = $this->getFirstTeamNewRatings($team2, $team1);

        return [
            $newTeam1Ratings,
            $newTeam2Ratings,
        ];
    }

    /**
     * @param TeamInterface $team1
     * @param TeamInterface $team2
     * @return array
     */
    private function getFirstTeamNewRatings(TeamInterface $team1, TeamInterface $team2)
    {
        $firstTeamNewRatings = [];
        foreach ($team1->getParticipants() as $team1Participant) {

            $firstTeamNewRatings[] = $this->getTeam1ParticpantAverageRatingAgainstTeam2(
                $team1Participant,
                $team2
            );
        }

        return $firstTeamNewRatings;
    }

    /**
     * @param ParticipantInterface $team1Participant
     * @param TeamInterface $team2
     * @return float
     */
    private function getTeam1ParticpantAverageRatingAgainstTeam2(
        ParticipantInterface $team1Participant,
        TeamInterface $team2
    ) {
        $team1ParticipantRatings = $this->getTeam1ParticipantRatingsAgainstTeam2($team1Participant, $team2);

        return (array_sum($team1ParticipantRatings) / count($team1ParticipantRatings));
    }

    /**
     * @param ParticipantInterface $team1Participant
     * @param TeamInterface $team2
     * @return array
     */
    private function getTeam1ParticipantRatingsAgainstTeam2(
        ParticipantInterface $team1Participant,
        TeamInterface $team2
    ) {
        $team1ParticipantRatings = [];

        foreach ($team2->getParticipants() as $team2Participant) {
            $team1ParticipantRatings[] = $this->getTeam1ParticipantNewRating($team1Participant, $team2Participant);
        }

        return $team1ParticipantRatings;
    }

    /**
     * @param ParticipantInterface $team1Participant
     * @param ParticipantInterface $team2Participant
     * @return float
     */
    private function getTeam1ParticipantNewRating(
        ParticipantInterface $team1Participant,
        ParticipantInterface $team2Participant
    ) {
        $newRatings = $this->eloCalculator->getNewRatings(
            $team1Participant,
            $team2Participant
        );

        return $newRatings[0];
    }
}
