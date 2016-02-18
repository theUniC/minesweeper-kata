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
        return $this->joinRows($this->resolveRows($this->grid));
    }

    private function joinRows(array $rows): string
    {
        return implode("\r\n", $rows);
    }

    private function resolveRows(Grid $grid): array
    {
        return array_map(
            function ($rowNumber, array $row) {
                return $this->resolveRow($rowNumber, $row);
            },
            array_keys($grid->cells()),
            $grid->cells()
        );
    }

    private function resolveRow(int $rowNumber, array $row): string
    {
        $cells = array_map(
            function ($cellNumber, Cell $cell) use ($rowNumber) {
                return $this->resolveCell($cellNumber, $rowNumber, $cell);
            },
            array_keys($row),
            $row
        );

        return $this->joinCells($cells);
    }

    private function resolveCell(int $cellNumber, int $rowNumber, Cell $cell): string
    {
        if ($cell->isMine()) {
            return '*';
        }

        return $this->minesNearOf($rowNumber + 1, $cellNumber + 1);
    }

    private function joinCells($cells)
    {
        return implode('', $cells);
    }
}