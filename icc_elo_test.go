package skill_test

import (
	"fmt"
	"testing"

	"github.com/stretchr/testify/assert"

	"github.com/pdt256/skill"
)

func Test_IccElo_GetNewRatings(t *testing.T) {
	// Given
	iccElo := skill.NewIccEloCalculator()
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
		{2500, 1000, 1.0, 0.0, 2500, 1000, "Expert Beats Beginner"},
		{1600, 1400, 1.0, 0.0, 1607, 1393, "75% Margin Win"},
		{1600, 1400, 0.0, 1.0, 1575, 1425, "75% Margin Loss"},
		{1600, 1400, 0.5, 0.5, 1591, 1409, "75% Margin Draw"},
	}

	for _, tt := range ratingTests {
		t.Run(tt.name, func(t *testing.T) {
			// When
			nextRatingA, nextRatingB := iccElo.GetNewRatings(
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

func ExampleIccEloGetNewRatings() {
	iccElo := skill.NewIccEloCalculator()
	fmt.Println(iccElo.GetNewRatings(1500, 1500, 0.5, 0.5))
	fmt.Println(iccElo.GetNewRatings(1600, 1400, 1.0, 0.0))
	fmt.Println(iccElo.GetNewRatings(1600, 1400, 0.0, 1.0))
	// Output:
	// 1500 1500
	// 1607 1393
	// 1575 1425
}
