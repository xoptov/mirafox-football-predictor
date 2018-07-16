<?php

use Respect\Validation\Validator;

class Team
{
    /** @var string */
    private $name;

    /** @var int */
    private $games;

    /** @var int */
    private $win;

    /** @var int */
    private $draw;

    /** @var int */
    private $defeat;

    /** @var Goals */
    private $goals;

    /**
     * Team constructor.
     * @param array $desc
     */
    public function __construct(array $desc)
    {
        Validator::keySet(
            Validator::key("name", Validator::stringType()),
            Validator::key("games", Validator::intType()),
            Validator::key("win", Validator::intType()),
            Validator::key("draw", Validator::intType()),
            Validator::key("defeat", Validator::intType()),
            Validator::key("goals", Validator::arrayType())
        )->check($desc);

        foreach ($desc as $name => $value){
            if ($name === "goals") {
                $this->goals = new Goals($desc[$name]);
                continue;
            }
            $this->$name = $value;
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getGames(): int
    {
        return $this->games;
    }

    /**
     * @return int
     */
    public function getWin(): int
    {
        return $this->win;
    }

    /**
     * @return int
     */
    public function getDraw(): int
    {
        return $this->draw;
    }

    /**
     * @return int
     */
    public function getDefeat(): int
    {
        return $this->defeat;
    }

    /**
     * @return Goals
     */
    public function getGoals(): Goals
    {
        return $this->goals;
    }

    /**
     * @return int
     */
    public function getGoalsScored(): int
    {
        return $this->goals->getScored();
    }

    /**
     * @return int
     */
    public function getGoalsSkipped(): int
    {
        return $this->goals->getSkipped();
    }

    /**
     * @return float
     */
    public function averageGoalsScored(): float
    {
        return $this->getGoalsScored() / $this->getGames();
    }

    /**
     * @return float
     */
    public function averageGoalsSkipped(): float
    {
        return $this->getGoalsSkipped() / $this->getGames();
    }

    /**
     * @return float
     */
    public function attackPower($average): float
    {
        return $this->averageGoalsScored() / $average;
    }

    /**
     * @return float
     */
    public function defensePower($average): float
    {
        return $this->averageGoalsSkipped() / $average;
    }
}