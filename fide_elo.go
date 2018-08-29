package skill

import (
	"math"
)

type fideEloCalculator struct{}

// https://ratings.fide.com/calculator_rtd.phtml
func NewFideEloCalculator() *fideEloCalculator {
	return &fideEloCalculator{}
}

func (c *fideEloCalculator) GetNewRatings(
	ratingA int,
	ratingB int,
	totalGamesA int,
	totalGamesB int,
	scoreA float64,
	scoreB float64) (int, int) {

	probabilityA, probabilityB := GetWinProbability(ratingA, ratingB)

	nextRatingA := ratingA + c.getIndividualAdjustment(ratingA, totalGamesA, probabilityA, scoreA)
	nextRatingB := ratingB + c.getIndividualAdjustment(ratingB, totalGamesB, probabilityB, scoreB)

	return nextRatingA, nextRatingB
}

func (c *fideEloCalculator) getIndividualAdjustment(rating int, totalGames int, probability float64, score float64) int {
	return int(math.Floor(c.getKFactor(rating, totalGames) * (score - probability)))
}

func (c *fideEloCalculator) getKFactor(rating int, totalGames int) float64 {
	if totalGames < 30 && rating < 2300 {
		return 40
	}

	if rating >= 2400 {
		return 10
	}

	return 20
}
