Skill Calculator
================

[![Build Status](https://travis-ci.org/pdt256/skill.svg?branch=master)](https://travis-ci.org/pdt256/skill)

Calculate Skills using various methods.

## Setup

### Install Dependencies

```
go get ./...
```

## Unit Tests

```
go test ./...
```

## Run

### Skill CLI Application

```
$ go run cmd/cli/skill/main.go --help
Usage of skill:
  -elo=false: elo rating system (default)
  -fide=false: fide rating system
  -icc=false: icc rating system
  -kValue=32: k value
  -ratingA=1500: player A rating
  -ratingB=1500: player B rating
  -totalGamesA=0: total games played by A (fide only)
  -totalGamesB=0: total games played by B (fide only)
  -winningPlayer="A": winning player
```

#### Elo Rankings

```
$ go run cmd/cli/skill/main.go -elo -kValue 32 -ratingA 1600 -ratingB 2400 -winningPlayer A
1631,2368
```

#### Icc Rankings

```
$ go run cmd/cli/skill/main.go -icc -ratingA 1600 -ratingB 2400 -winningPlayer A
1631,2376
```

#### Fide Rankings

```
$ go run cmd/cli/skill/main.go -fide -ratingA 1600 -ratingB 2400 -totalGamesA 50 -totalGamesB 50 -winningPlayer A
1619,2390
```

### Team Skill CLI Application

```
$ go run cmd/cli/team-skill/main.go --help
Usage of team-skill:
  -elo=false: elo rating system (default)
  -icc=false: icc rating system
  -kValue=32: k value
  -ratingsA="1500,1500": team A ratings (comma separated)
  -ratingsB="1500,1500": team B ratings (comma separated)
  -winningTeam="A": winning team
```

#### Team Rankings w/ Dueling Calculator using Elo

```
$ go run cmd/cli/team-skill/main.go -elo -ratingsA 1400,1600 -ratingsB 2400,2100 -winningTeam A
[1431 1630],[2368 2068]
```

#### Team Rankings w/ Dueling Calculator using Icc

```
$ go run cmd/cli/team-skill/main.go -icc -ratingsA 1400,1600 -ratingsB 2400,2100 -winningTeam A
[1431 1630],[2376 2076]
```

#### Team Rankings with 3 players

```
$ go run cmd/cli/team-skill/main.go -elo -ratingsA 1400,1500,1600 -ratingsB 2100,2000,1900 -winningTeam A
[1430 1530 1628],[2068 1969 1870]
```
