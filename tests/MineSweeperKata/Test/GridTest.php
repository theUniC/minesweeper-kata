<?php

namespace MineSweeperKata\Test;

use PHPUnit_Framework_TestCase;
use MineSweeperKata\Grid;

class GridTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_be_able_to_determine_the_proximity_of_a_field_of_one_per_one_with_no_mines()
    {
        $grid = Grid::fromString(MineSweeperTest::FIELD_OF_ONE_PER_ONE_WITH_ZERO_MINES);

        $this->assertEquals(0, $grid->minesNearOf(1, 1));
    }

    /** @test */
    public function it_should_be_able_to_determine_the_proximity_of_a_field_of_two_per_two_with_one_mine()
    {
        $grid = Grid::fromString(MineSweeperTest::FIELD_OF_TWO_PER_TWO_WITH_ONE_MINE);

        $this->assertEquals(1, $grid->minesNearOf(2, 1));
        $this->assertEquals(1, $grid->minesNearOf(1, 2));
        $this->assertEquals(1, $grid->minesNearOf(2, 2));
    }

    /**
     * @test
     */
    public function it_should_be_able_to_determine_the_proximity_of_mines_of_a_field_of_four_per_four_with_several_mines()
    {
        $grid = Grid::fromString(MineSweeperTest::FIELD_OF_FOUR_PER_FOUR_WITH_SEVERAL_MINES);

        $this->assertEquals(0, $grid->minesNearOf(1, 4));
        $this->assertEquals(1, $grid->minesNearOf(1, 2));
        $this->assertEquals(2, $grid->minesNearOf(2, 1));
        $this->assertEquals(2, $grid->minesNearOf(2, 2));
        $this->assertEquals(0, $grid->minesNearOf(2, 4));
        $this->assertEquals(1, $grid->minesNearOf(4, 2));
    }

    /**
     * @test
     */
    public function it_should_be_able_to_determine_the_proximity_of_mines_of_a_field_of_four_per_four_with_a_lot_of_mines()
    {
        $grid = Grid::fromString(MineSweeperTest::FIELD_OF_FOUR_PER_FOUR_WITH_A_LOT_OF_MINES);

        $this->assertEquals(6, $grid->minesNearOf(2, 2));
        $this->assertEquals(1, $grid->minesNearOf(1, 4));
        $this->assertEquals(3, $grid->minesNearOf(3, 4));
        $this->assertEquals(4, $grid->minesNearOf(2, 3));
    }
}