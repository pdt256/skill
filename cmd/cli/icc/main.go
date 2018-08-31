package main

import (
	"fmt"
	"os"

	"github.com/namsral/flag"
	"github.com/pdt256/skill"
)

func main() {
	flag.CommandLine = flag.NewFlagSet(os.Args[0], flag.ExitOnError)

	ratingA := flag.Int("ratingA", 1500, "player A rating")
	ratingB := flag.Int("ratingB", 1500, "player B rating")
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

	calculator := skill.NewIccEloCalculator()
	newRatingA, newRatingB := calculator.GetNewRatings(*ratingA, *ratingB, scoreA, scoreB)

	fmt.Printf("%d,%d\n", newRatingA, newRatingB)
}
