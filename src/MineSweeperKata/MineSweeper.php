<?php

namespace MineSweeperKata;

use Countable;

class MineSweeper implements Countable
{
    /**
     * @var int
     */
    private $numberOfMines;

    /**
     * @var Grid
     */
    private $grid;

    public function hasMines(): bool
    {
        return $this->numberOfMines > 0;
    }

    private function __construct(string $field)
    {
        $this->numberOfMines = preg_match_all('~\*~', $field);
        $this->grid = Grid::fromString($field);
    }

    public static function parse(string $field): MineSweeper
    {
        return new static($field);
    }

    public function count()
    {
        return $this->numberOfMines;
    }

    public function minesNearOf(int $x, int $y): int
    {
        return $this->grid->minesNearOf($x, $y);
    }

    public function resolve(): string
    {
        return
            implode(
                "\r\n",
                array_map(
                    function($rowNumber, array $row) {
                        return implode(
                            '',
                            array_map(
                                function ($cellNumber, Cell $cell) use ($rowNumber) {
                                    if ($cell->isMine()) {
                                        return '*';
                                    }

                                    return $this->minesNearOf($rowNumber + 1, $cellNumber + 1);
                                },
                                array_keys($row),
                                $row
                            )
                        );
                    },
                    array_keys($this->grid->cells()),
                    $this->grid->cells()
                )
            )
        ;
    }
}