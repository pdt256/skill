package skill_test

import (
	"fmt"
	"testing"

	"github.com/stretchr/testify/assert"

	"github.com/pdt256/skill"
)

func Test_FideElo_GetNewRatings(t *testing.T) {
	// Given
	fide := skill.NewFideEloCalculator()
	var ratingTests = []struct {
		ratingA            int
		ratingB            int
		totalGamesA        int
		totalGamesB        int
		scoreA             float64
		scoreB             float64
		expectedNewRatingA int
		expectedNewRatingB int
		name               string
	}{
		{1500, 1500, 0, 0, 0.5, 0.5, 1500, 1500, "Even Draw"},
		{2500, 1000, 0, 0, 1.0, 0.0, 2500, 999, "Expert Beats Beginner"},
		{1600, 1400, 0, 0, 1.0, 0.0, 1609, 1390, "75% Margin Win"},
		{1600, 1400, 0, 0, 0.0, 1.0, 1569, 1430, "75% Margin Loss"},
		{1600, 1400, 0, 0, 0.5, 0.5, 1589, 1410, "75% Margin Draw"},
	}

	for _, tt := range ratingTests {
		t.Run(tt.name, func(t *testing.T) {
			// When
			nextRatingA, nextRatingB := fide.GetNewRatings(
				tt.ratingA,
				tt.ratingB,
				tt.totalGamesA,
				tt.totalGamesB,
				tt.scoreA,
				tt.scoreB,
			)

			// Then
			assert.Equal(t, tt.expectedNewRatingA, nextRatingA)
			assert.Equal(t, tt.expectedNewRatingB, nextRatingB)
		})
	}
}

func ExampleFideEloGetNewRatings() {
	fideElo := skill.NewFideEloCalculator()
	fmt.Println(fideElo.GetNewRatings(1500, 1500, 0, 0, 0.5, 0.5))
	fmt.Println(fideElo.GetNewRatings(1600, 1400, 0, 0, 1.0, 0.0))
	fmt.Println(fideElo.GetNewRatings(1600, 1400, 0, 0, 0.0, 1.0))
	fmt.Println(fideElo.GetNewRatings(1600, 1400, 30, 30, 1.0, 0.0))
	// Output:
	// 1500 1500
	// 1609 1390
	// 1569 1430
	// 1604 1395
}
