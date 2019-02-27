package skill_test

import (
	"fmt"
	"testing"

	"github.com/stretchr/testify/assert"

	"github.com/pdt256/skill"
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

func ExampleDuelingCalculator_GetNewRatings() {
	elo := skill.NewEloCalculator(32)
	duel := skill.NewDuelingCalculator(elo)
	fmt.Println(duel.GetNewRatings([]int{1500, 1500}, []int{1500, 1500}, 0.5, 0.5))
	fmt.Println(duel.GetNewRatings([]int{1600, 1600}, []int{1400, 1400}, 1.0, 0.0))
	fmt.Println(duel.GetNewRatings([]int{1600, 1600}, []int{1400, 1400}, 0.0, 1.0))
	fmt.Println(duel.GetNewRatings(
		[]int{2400, 2200, 2000, 1800, 1600, 1400},
		[]int{2400, 2200, 2000, 1800, 1600, 1400},
		1.0,
		0.0,
	))
	fmt.Println(duel.GetNewRatings(
		[]int{2400, 2200, 2000, 1800, 1600, 1400},
		[]int{1700, 1500, 1300, 1100, 900, 700},
		1.0,
		0.0,
	))
	fmt.Println(duel.GetNewRatings(
		[]int{2400, 2200, 2000, 1800, 1600, 1400},
		[]int{2200, 1500},
		1.0,
		0.0,
	))
	// Output:
	// [1500 1500] [1500 1500]
	// [1607 1607] [1392 1392]
	// [1575 1575] [1424 1424]
	// [2404 2208 2013 1818 1623 1427] [2372 2176 1981 1786 1591 1395]
	// [2400 2200 2000 1802 1606 1410] [1688 1493 1296 1098 898 699]
	// [2403 2208 2012 1816 1621 1425] [2176 1493]
}
