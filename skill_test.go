package skill_test

import (
	"fmt"
	"testing"

	"github.com/stretchr/testify/assert"

	"github.com/pdt256/skill"
)

func TestGetWinProbability(t *testing.T) {
	// Given
	const floatDelta = 0.000001
	var probabilityTests = []struct {
		ratingA              int
		ratingB              int
		expectedProbabilityA float64
		expectedProbabilityB float64
		name                 string
	}{
		{1500, 1500, 0.5, 0.5, "Even Draw"},
		{2000, 1000, 0.996847, 0.003152, "A should win by large margin"},
		{1000, 2000, 0.003152, 0.996847, "B should win by large margin"},
		{1600, 1400, 0.759746, 0.240253, "75% margin"},
		{2131, 1584, 0.958860, 0.041139, "https://www.chess-iecc.com/ratings/algor.html"},
	}

	for _, tt := range probabilityTests {
		t.Run(tt.name, func(t *testing.T) {
			// When
			probabilityA, probabilityB := skill.GetWinProbability(
				tt.ratingA,
				tt.ratingB,
			)

			// Then
			assert.InDelta(t, tt.expectedProbabilityA, probabilityA, floatDelta)
			assert.InDelta(t, tt.expectedProbabilityB, probabilityB, floatDelta)
		})
	}
}

func ExampleGetWinProbability() {
	fmt.Println(skill.GetWinProbability(1500, 1500))
	fmt.Println(skill.GetWinProbability(2000, 1000))
	fmt.Println(skill.GetWinProbability(1600, 1400))
	// Output:
	// 0.5 0.5
	// 0.9968476908167399 0.003152309183260149
	// 0.7597469266479578 0.24025307335204216
}
