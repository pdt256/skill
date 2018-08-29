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

type HistoricalRatingCalculator interface {
	GetNewRatings(
		ratingA int,
		ratingB int,
		totalGamesA int,
		totalGamesB int,
		scoreA float64,
		scoreB float64) (nextRatingA int, nextRatingB int)
}

func GetWinProbability(ratingA int, ratingB int) (float64, float64) {
	probabilityA := getIndividualProbability(ratingB, ratingA)
	probabilityB := 1.0 - probabilityA
	return probabilityA, probabilityB
}

func getIndividualProbability(ratingA int, ratingB int) float64 {
	ratingDifference := float64(ratingA - ratingB)
	return 1 / (math.Pow(10, ratingDifference/400) + 1)
}
