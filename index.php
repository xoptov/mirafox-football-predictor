<?php

require_once "vendor/autoload.php";
require_once "data.php";

function match($c1, $c2)
{
    global $data;

    if ($c1 === $c2) {
        throw new RuntimeException("c1 can not be equal to c2");
    }

    /** @var Team[] $teams */
    $teams = [];

    foreach ($data as $match) {
        array_push($teams, new Team($match));
    }

    if (!isset($teams[$c1], $teams[$c2])) {
        throw new RuntimeException("Invalid arguments");
    }

    $countGoals = 0;
    $countGames = 0;

    /** @var Team $team */
    foreach ($teams as $team) {
        $countGoals += $team->getGoalsScored();
        $countGames += $team->getGames();
    }

    $average = ($countGoals / $countGames) / 2;

    $delta1 = $teams[$c1]->attackPower($average) - $teams[$c2]->defensePower($average);
    if ($delta1 < 0) {
        $delta1 = 0;
    }

    $delta2 = $teams[$c2]->attackPower($average) - $teams[$c1]->defensePower($average);
    if ($delta2 < 0) {
        $delta2 = 0;
    }

    $r1 = rand(0, ceil($delta1));
    $r2 = rand(0, ceil($delta2));

    return [$r1, $r2];
}