package skill

type duelingCalculator struct {
	ratingCalculator RatingCalculator
}

func NewDuelingCalculator(ratingCalculator RatingCalculator) *duelingCalculator {
	return &duelingCalculator{
		ratingCalculator: ratingCalculator,
	}
}

func (c *duelingCalculator) GetNewRatings(
	ratingsA []int,
	ratingsB []int,
	scoreA float64,
	scoreB float64) ([]int, []int) {

	return c.getFirstTeamNewRatings(ratingsA, ratingsB, scoreA, scoreB),
		c.getFirstTeamNewRatings(ratingsB, ratingsA, scoreB, scoreA)
}

func (c *duelingCalculator) getFirstTeamNewRatings(ratingsA []int, ratingsB []int, scoreA float64, scoreB float64) []int {
	var newRatings []int
	for _, rating := range ratingsA {
		newRatings = append(newRatings, c.getAverageRatingAgainstOpponentRatings(rating, ratingsB, scoreA, scoreB))
	}

	return newRatings
}

func (c *duelingCalculator) getAverageRatingAgainstOpponentRatings(rating int, opponentRatings []int, scoreA float64, scoreB float64) int {
	ratings := c.getRatingsAgainstOpponentRatings(rating, opponentRatings, scoreA, scoreB)

	return sumInt(ratings) / len(ratings)
}

func (c *duelingCalculator) getRatingsAgainstOpponentRatings(rating int, opponentRatings []int, scoreA float64, scoreB float64) []int {
	var ratings []int

	for _, opponentRating := range opponentRatings {
		newRating, _ := c.ratingCalculator.GetNewRatings(rating, opponentRating, scoreA, scoreB)
		ratings = append(ratings, newRating)
	}

	return ratings
}
