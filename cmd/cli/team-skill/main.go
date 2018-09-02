package main

import (
	"fmt"
	"os"
	"strconv"
	"strings"

	"github.com/namsral/flag"
	"github.com/pdt256/skill"
)

func main() {
	flag.CommandLine = flag.NewFlagSet(os.Args[0], flag.ExitOnError)

	isElo := flag.Bool("elo", false, "elo rating system (default)")
	isIcc := flag.Bool("icc", false, "icc rating system")
	kValue := flag.Int("kValue", 32, "k value")
	ratingsAString := flag.String("ratingsA", "1500,1500", "team A ratings (comma separated)")
	ratingsBString := flag.String("ratingsB", "1500,1500", "team B ratings (comma separated)")
	winningTeam := flag.String("winningTeam", "A", "winning team")

	flag.Parse()

	var scoreA, scoreB float64

	if *winningTeam == "A" {
		scoreA = 1.0
		scoreB = 0.0
	} else {
		scoreA = 0.0
		scoreB = 1.0
	}

	ratingsA := getIntSlice(*ratingsAString)
	ratingsB := getIntSlice(*ratingsBString)

	var calculator skill.RatingCalculator

	if !*isIcc {
		*isElo = true
	}

	if *isElo {
		calculator = skill.NewEloCalculator(*kValue)
	} else if *isIcc {
		calculator = skill.NewIccEloCalculator()
	}

	duelingCalculator := skill.NewDuelingCalculator(calculator)
	newRatingsA, newRatingsB := duelingCalculator.GetNewRatings(ratingsA, ratingsB, scoreA, scoreB)

	fmt.Printf("%v,%v\n", newRatingsA, newRatingsB)
}

func getIntSlice(csvRatings string) []int {
	parts := strings.Split(csvRatings, ",")

	var newRatings []int
	for _, value := range parts {
		intVal, _ := strconv.Atoi(value)
		newRatings = append(newRatings, intVal)
	}

	return newRatings
}
