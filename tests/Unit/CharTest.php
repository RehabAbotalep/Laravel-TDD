<?php

namespace Tests\Unit;

use App\BackingClass\Char;
use PHPUnit\Framework\TestCase;

class CharTest extends TestCase
{
    public function testGetCamelCaseStringFromSnakeCase()
    {
        $char = new Char();
        $out = $char->getCamelCaseFromSnakeCase("call_of_duty");
        $this->assertEquals("callOfDuty", $out);

        $out = $char->getCamelCaseFromSnakeCase("change_of_heart");
        $this->assertEquals("changeOfHeart", $out);

    }
}
