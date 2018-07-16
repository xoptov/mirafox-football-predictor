<?php

use Respect\Validation\Validator;

class Goals
{
    /** @var int */
    private $scored;

    /** @var int */
    private $skipped;

    /**
     * Goals constructor.
     * @param array $desc
     */
    public function __construct(array $desc)
    {
        Validator::keySet(
            Validator::key("scored", Validator::intType()),
            Validator::key("skiped", Validator::intType())
        )->check($desc);

        $this->scored = $desc["scored"];
        $this->skipped = $desc["skiped"];
    }

    /**
     * @return int
     */
    public function getScored()
    {
        return $this->scored;
    }

    /**
     * @return int
     */
    public function getSkipped()
    {
        return $this->skipped;
    }
}