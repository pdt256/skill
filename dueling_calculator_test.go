package skill_test

import (
	"testing"

	"github.com/pdt256/skill"
	"github.com/stretchr/testify/assert"
)

func Test_DuelingCalculator_GetNewRatings(t *testing.T) {
	// Given
	elo := skill.NewEloCalculator(32)
	duel := skill.NewDuelingCalculator(elo)
	var ratingTests = []struct {
		aRatings            []int
		bRatings            []int
		scoreA              float64
		scoreB              float64
		expectedNewARatings []int
		expectedNewBRatings []int
		name                string
	}{
		{[]int{1500, 1500}, []int{1500, 1500}, 0.5, 0.5, []int{1500, 1500}, []int{1500, 1500}, "Even Draw"},
		{[]int{2400, 2500}, []int{1000, 1100}, 1.0, 0.0, []int{2400, 2500}, []int{999, 1099}, "Expert Beats Novice"},
		{[]int{2400, 2500}, []int{1000, 1100}, 0.0, 1.0, []int{2368, 2468}, []int{1031, 1131}, "Novice Beats Expert"},
	}

	for _, tt := range ratingTests {
		t.Run(tt.name, func(t *testing.T) {
			// When
			nextTeamARatings, nextTeamBRatings := duel.GetNewRatings(
				tt.aRatings,
				tt.bRatings,
				tt.scoreA,
				tt.scoreB,
			)

			// Then
			assert.Equal(t, tt.expectedNewARatings, nextTeamARatings)
			assert.Equal(t, tt.expectedNewBRatings, nextTeamBRatings)
		})
	}
}
