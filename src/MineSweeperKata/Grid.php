<?php

namespace MineSweeperKata;

class Grid
{
    /**
     * @var array
     */
    private $cells;

    public function __construct(array $cells)
    {
        $this->cells = $cells;
    }

    public function cells()
    {
        return $this->cells;
    }

    public static function fromString(string $field)
    {
        $rawCells = array_map('str_split', explode("\n", $field));

        $cells = array_map(function(array $row) {
            return array_map(function($rawCell) {
                return new Cell($rawCell);
            }, $row);
        }, $rawCells);

        return new static($cells);
    }

    public function minesNearOf(int $y, int $x): int
    {
        $mines = 0;

        $currentPosition = $this->pointAt($y - 1, $x - 1);

        foreach ([-1, 0, 1] as $deltaX) {
            foreach ([-1, 0, 1] as $deltaY) {

                $nextPosition = $currentPosition
                    ->moveHorizontallyTo($deltaX)
                    ->moveVerticallyTo($deltaY)
                ;

                if ($nextPosition->equalsTo($currentPosition) || $this->isPointOutOfBounds($nextPosition)) {
                    continue;
                }

                if ($this->cellAt($nextPosition)->isMine()) {
                    $mines++;
                }
            }
        }

        return $mines;
    }

    private function isPointOutOfBounds(Point $point)
    {
        return $point->isOutOfBounds(count($this->cells), count($this->cells[0]));
    }

    public function cellAt(Point $point): Cell
    {
        return $this->cells[$point->y()][$point->x()];
    }

    public function pointAt(int $y, int $x): Point
    {
        return new Point($x, $y);
    }
}