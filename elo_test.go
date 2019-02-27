package skill_test

import (
	"fmt"
	"testing"

	"github.com/stretchr/testify/assert"

	"github.com/pdt256/skill"
)

func Test_Elo_GetNewRatings(t *testing.T) {
	// Given
	elo := skill.NewEloCalculator(32)
	var ratingTests = []struct {
		ratingA            int
		ratingB            int
		scoreA             float64
		scoreB             float64
		expectedNewRatingA int
		expectedNewRatingB int
		name               string
	}{
		{1500, 1500, 0.5, 0.5, 1500, 1500, "Even Draw"},
		{2500, 1000, 1.0, 0.0, 2500, 999, "Expert Beats Beginner"},
		{1600, 1400, 1.0, 0.0, 1607, 1392, "75% Margin Win"},
		{1600, 1400, 0.0, 1.0, 1575, 1424, "75% Margin Loss"},
		{1600, 1400, 0.5, 0.5, 1591, 1408, "75% Margin Draw"},

		// https://www.chess-iecc.com/ratings/algor.html
		{2131, 1584, 1.0, 0.0, 2132, 1582, "White Win"},
		{1584, 2131, 0.0, 1.0, 1582, 2132, "White Lose"},
	}

	for _, tt := range ratingTests {
		t.Run(tt.name, func(t *testing.T) {
			// When
			nextRatingA, nextRatingB := elo.GetNewRatings(
				tt.ratingA,
				tt.ratingB,
				tt.scoreA,
				tt.scoreB,
			)

			// Then
			assert.Equal(t, tt.expectedNewRatingA, nextRatingA)
			assert.Equal(t, tt.expectedNewRatingB, nextRatingB)
		})
	}
}

func ExampleGetNewRatings() {
	kFactor := 32
	elo := skill.NewEloCalculator(kFactor)
	fmt.Println(elo.GetNewRatings(1500, 1500, 0.5, 0.5))
	fmt.Println(elo.GetNewRatings(1600, 1400, 1.0, 0.0))
	fmt.Println(elo.GetNewRatings(1600, 1400, 0.0, 1.0))
	// Output:
	// 1500 1500
	// 1607 1392
	// 1575 1424
}
