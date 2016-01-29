<?php

namespace MineSweeperKata;

class Cell
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function isMine()
    {
        return '*' === $this->value;
    }
}