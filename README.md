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

## License

The MIT License (MIT)

Copyright (c) 2015 Jamie Isaacs <pdt256@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
