package main

import (
	"fmt"
	"os"

	"github.com/namsral/flag"
	"github.com/pdt256/skill"
)

func main() {
	flag.CommandLine = flag.NewFlagSet(os.Args[0], flag.PanicOnError)

	ratingA := flag.Int(
		"ratingA",
		1500,
		"player A rating",
	)

	ratingB := flag.Int(
		"ratingB",
		1500,
		"player B rating",
	)

	totalGamesA := flag.Int(
		"totalGamesA",
		0,
		"total games played by A",
	)

	totalGamesB := flag.Int(
		"totalGamesB",
		0,
		"total games played by B",
	)

	winningPlayer := flag.String(
		"winningPlayer",
		"A",
		"winning player",
	)
	flag.Parse()

	var scoreA, scoreB float64

	if *winningPlayer == "A" {
		scoreA = 1.0
		scoreB = 0.0
	} else {
		scoreA = 0.0
		scoreB = 1.0
	}

	calculator := skill.NewFideEloCalculator()
	newRatingA, newRatingB := calculator.GetNewRatings(
		*ratingA,
		*ratingB,
		*totalGamesA,
		*totalGamesB,
		scoreA,
		scoreB,
	)

	fmt.Printf("%d,%d\n", newRatingA, newRatingB)
}
