<?php

namespace MineSweeperKata;

class Point
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function x()
    {
        return $this->x;
    }

    public function y()
    {
        return $this->y;
    }

    public function equalsTo(Point $point): bool
    {
        return $point->x === $this->x && $point->y === $this->y;
    }

    public function isOutOfBounds(int $heightLimit, int $widthLimit): bool
    {
        return $this->x < 0 || $this->y < 0 || $this->x >= $widthLimit || $this->y >= $heightLimit;
    }

    public function moveHorizontallyTo(int $x): Point
    {
        return new Point($this->x + $x, $this->y);
    }

    public function moveVerticallyTo(int $y): Point
    {
        return new Point($this->x, $this->y + $y);
    }
}