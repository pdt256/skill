package skill

import (
	"math"
)

type eloCalculator struct {
	kFactor float64
}

var _ RatingCalculator = (*eloCalculator)(nil)

// https://en.wikipedia.org/wiki/Elo_rating_system
func NewEloCalculator(kFactor int) *eloCalculator {
	return &eloCalculator{
		kFactor: float64(kFactor),
	}
}

func (c *eloCalculator) GetNewRatings(
	ratingA int,
	ratingB int,
	scoreA float64,
	scoreB float64) (int, int) {

	probabilityA, probabilityB := GetWinProbability(ratingA, ratingB)

	nextRatingA := ratingA + c.getIndividualAdjustment(probabilityA, scoreA)
	nextRatingB := ratingB + c.getIndividualAdjustment(probabilityB, scoreB)

	return nextRatingA, nextRatingB
}

func (c *eloCalculator) getIndividualAdjustment(probability float64, score float64) int {
	return int(math.Floor(c.kFactor * (score - probability)))
}
