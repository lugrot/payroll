<?php

declare(strict_types=1);

namespace App\Tests\Domain\ValueObject;

use App\Domain\ValueObject\Currency;
use App\Domain\ValueObject\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @test
     */
    public function adding_money_should_not_modify_original_object()
    {
        $money = new Money(100, new Currency());

        $money->add(new Money(50, new Currency()));

        $this->assertEquals(100, $money->amount());
    }

    /**
     * @test
     */
    public function adding_money_should_create_new_money_object_with_increased_amount()
    {
        $money = new Money(1000, new Currency());

        $result = $money->add(new Money(500, new Currency()));

        $this->assertEquals(1500, $result->amount());
        $this->assertNotSame($money, $result);
    }

    /**
     * @test
     */
    public function multipling_money_should_create_new_money_object_with_increased_amount()
    {
        $money = new Money(555, new Currency());

        $result = $money->multiply(5);

        $this->assertEquals(2775, $result->amount());
        $this->assertNotSame($money, $result);
    }
}
