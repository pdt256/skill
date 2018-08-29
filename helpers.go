package skill

func sumInt(values []int) int {
	sum := 0
	for _, value := range values {
		sum += value
	}
	return sum
}
