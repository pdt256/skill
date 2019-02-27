// Package skill provides rating algorithms to calculate the relative strength
// of two player games.
package skill

import (
	"math"
)

type RatingCalculator interface {
	GetNewRatings(
		ratingA int,
		ratingB int,
		scoreA float64,
		scoreB float64) (nextRatingA int, nextRatingB int)
}

type DuelingCalculator interface {
	GetNewRatings(
		ratingsA []int,
		ratingsB []int,
		scoreA float64,
		scoreB float64) (nextRatingsA []int, nextRatingsB []int)
}

type HistoricalRatingCalculator interface {
	GetNewRatings(
		ratingA int,
		ratingB int,
		totalGamesA int,
		totalGamesB int,
		scoreA float64,
		scoreB float64) (nextRatingA int, nextRatingB int)
}

// GetWinProbability returns the win probability for each provided rating.
// It uses the IECC rating algorithm probability:
// Probability = 1 / (1 + (10 ^ -(Rating Difference / 400)))
func GetWinProbability(ratingA int, ratingB int) (float64, float64) {
	probabilityA := getIndividualProbability(ratingB, ratingA)
	probabilityB := 1.0 - probabilityA
	return probabilityA, probabilityB
}

func getIndividualProbability(ratingA int, ratingB int) float64 {
	ratingDifference := float64(ratingA - ratingB)
	return 1 / (math.Pow(10, ratingDifference/400) + 1)
}
