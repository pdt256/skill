package main

import (
	"fmt"
	"os"

	"github.com/namsral/flag"
	"github.com/pdt256/skill"
)

func main() {
	flag.CommandLine = flag.NewFlagSet(os.Args[0], flag.ExitOnError)

	isElo := flag.Bool("elo", false, "elo rating system (default)")
	isIcc := flag.Bool("icc", false, "icc rating system")
	isFide := flag.Bool("fide", false, "fide rating system")
	kValue := flag.Int("kValue", 32, "k value")
	ratingA := flag.Int("ratingA", 1500, "player A rating")
	ratingB := flag.Int("ratingB", 1500, "player B rating")
	totalGamesA := flag.Int("totalGamesA", 0, "total games played by A (fide only)")
	totalGamesB := flag.Int("totalGamesB", 0, "total games played by B (fide only)")
	winningPlayer := flag.String("winningPlayer", "A", "winning player")

	flag.Parse()

	var scoreA, scoreB float64

	if *winningPlayer == "A" {
		scoreA = 1.0
		scoreB = 0.0
	} else {
		scoreA = 0.0
		scoreB = 1.0
	}

	if !*isIcc && !*isFide {
		*isElo = true
	}

	var newRatingA, newRatingB int

	if *isElo {
		calculator := skill.NewEloCalculator(*kValue)
		newRatingA, newRatingB = calculator.GetNewRatings(*ratingA, *ratingB, scoreA, scoreB)
	} else if *isIcc {
		calculator := skill.NewIccEloCalculator()
		newRatingA, newRatingB = calculator.GetNewRatings(*ratingA, *ratingB, scoreA, scoreB)
	} else if *isFide {
		calculator := skill.NewFideEloCalculator()
		newRatingA, newRatingB = calculator.GetNewRatings(
			*ratingA,
			*ratingB,
			*totalGamesA,
			*totalGamesB,
			scoreA,
			scoreB,
		)
	}

	fmt.Printf("%d,%d\n", newRatingA, newRatingB)
}
