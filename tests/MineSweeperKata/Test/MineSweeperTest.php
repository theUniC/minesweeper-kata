<?php

namespace MineSweeperKata\Test;

use PHPUnit_Framework_TestCase;
use MineSweeperKata\MineSweeper;

class MineSweeperTest extends PHPUnit_Framework_TestCase
{
    const FIELD_OF_ZERO_PER_ZERO_WITH_ZERO_MINES        = '';
    const FIELD_OF_ONE_PER_ONE_WITH_ZERO_MINES          = '.';
    const FIELD_OF_TWO_PER_TWO_WITH_ZERO_MINES          = "..\n..";
    const FIELD_OF_ONE_PER_ONE_WITH_ONE_MINE            = '*';
    const FIELD_OF_TWO_PER_TWO_WITH_TWO_MINES           = "*.\n.*";
    const FIELD_OF_TWO_PER_TWO_WITH_ONE_MINE            = "*.\n..";
    const FIELD_OF_FOUR_PER_FOUR_WITH_SEVERAL_MINES     = "*...\n....\n.*..\n....";
    const FIELD_OF_FOUR_PER_FOUR_WITH_A_LOT_OF_MINES    = "***.\n*...\n.**.\n..**";

    const EXPECTED_RESULT_FOR_A_FIELD_OF_FOUR_PER_FOUR_WITH_A_LOT_OF_MINES = "***1\r\n*642\r\n2**3\r\n13**";

    /** @test */
    public function it_should_be_able_to_parse_a_field_of_0_per_0_with_0_mines()
    {
        $minesweeper = MineSweeper::parse(self::FIELD_OF_ZERO_PER_ZERO_WITH_ZERO_MINES);

        $this->assertFalse(
            (bool) $minesweeper->hasMines()
        );
    }

    /** @test */
    public function it_should_be_able_to_parse_a_field_of_1_per_1_with_0_mines()
    {
        $minesweeper = MineSweeper::parse(self::FIELD_OF_ONE_PER_ONE_WITH_ZERO_MINES);

        $this->assertFalse(
            (bool) $minesweeper->hasMines()
        );
    }

    /** @test */
    public function it_should_be_able_to_parse_a_field_of_2_per_2_with_0_mines()
    {
        $minesweeper = MineSweeper::parse(self::FIELD_OF_TWO_PER_TWO_WITH_ZERO_MINES);

        $this->assertFalse(
            (bool) $minesweeper->hasMines()
        );
    }

    /** @test */
    public function it_should_be_able_to_parse_a_field_of_1_per_1_with_1_mine()
    {
        $minesweeper = MineSweeper::parse(self::FIELD_OF_ONE_PER_ONE_WITH_ONE_MINE);

        $this->assertTrue(
            (bool) $minesweeper->hasMines()
        );

        $this->assertCount(
            1,
            $minesweeper
        );
    }

    /** @test */
    public function it_should_be_able_to_parse_a_field_of_2_per_2_with_2_mines()
    {
        $minesweeper = MineSweeper::parse(self::FIELD_OF_TWO_PER_TWO_WITH_TWO_MINES);

        $this->assertTrue(
            (bool) $minesweeper->hasMines()
        );

        $this->assertCount(
            2,
            $minesweeper
        );
    }

    /**
     * @test
     */
    public function it_should_be_able_to_resolve_the_whole_field()
    {
        $string = MineSweeper::parse(self::FIELD_OF_FOUR_PER_FOUR_WITH_A_LOT_OF_MINES)->resolve();
        $this->assertEquals(
            self::EXPECTED_RESULT_FOR_A_FIELD_OF_FOUR_PER_FOUR_WITH_A_LOT_OF_MINES,
            $string
        );
    }
}