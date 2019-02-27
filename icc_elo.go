package skill

import (
	"math"
)

type iccEloCalculator struct{}

var _ RatingCalculator = (*iccEloCalculator)(nil)

// NewIccEloCalculator returns a RatingCalculator using the ICC chess rating system.
// https://www.chessclub.com/help/ratings
func NewIccEloCalculator() *iccEloCalculator {
	return &iccEloCalculator{}
}

func (c *iccEloCalculator) GetNewRatings(
	ratingA int,
	ratingB int,
	scoreA float64,
	scoreB float64) (int, int) {

	probabilityA, _ := GetWinProbability(ratingA, ratingB)

	whiteAdjustment := c.getIndividualAdjustment(ratingA, probabilityA, scoreA)
	nextRatingA := ratingA + whiteAdjustment

	whiteKFactor := c.getKFactor(ratingA)
	blackKFactor := c.getKFactor(ratingB)

	blackAdjustment := c.getBlackAdjustment(whiteAdjustment, blackKFactor, whiteKFactor)
	nextRatingB := ratingB + blackAdjustment

	return nextRatingA, nextRatingB
}

func (c *iccEloCalculator) getIndividualAdjustment(rating int, probability float64, score float64) int {
	kFactor := c.getKFactor(rating)
	return int(math.Floor(kFactor * (score - probability)))
}

func (c *iccEloCalculator) getBlackAdjustment(whiteAdjustment int, blackKFactor float64, whiteKFactor float64) int {
	return int(math.Floor(-1 * (float64(whiteAdjustment) * blackKFactor / whiteKFactor)))

}

func (c *iccEloCalculator) getKFactor(rating int) float64 {
	if rating > 2400 {
		return 16
	}

	if rating >= 2100 {
		return 24
	}

	return 32
}
