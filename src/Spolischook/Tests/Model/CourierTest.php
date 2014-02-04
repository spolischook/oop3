<?php

namespace Spolischook\Tests\Model;

use Spolischook\Model\Courier;

class CourierTest extends \PHPUnit_Framework_TestCase
{
    public function testCalculateSenderPrice()
    {
        $courier = new Courier();
        $courier->setGender(Courier::MALE);

        $this->assertEquals(2, $courier->calculateSenderPrice(2));
        $this->assertEquals(3, $courier->calculateSenderPrice(3));
        $this->assertEquals(5, $courier->calculateSenderPrice(5));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider calculateSenderPriceExceptionProvider
     */
    public function testCalculateSenderPriceException($distance)
    {
        $courier = new Courier();
        $courier->setGender(Courier::MALE);

        $this->assertEquals(5, $courier->calculateSenderPrice($distance));
    }

    /**
     * @dataProvider calculateSenderTimeProvider
     */
    public function testCalculateSenderTime($result, $distance)
    {
        $courier = new Courier();
        $courier->setGender(Courier::FEMALE);

        $this->assertEquals($result, $courier->calculateSenderTime($distance));
    }

    public function calculateSenderTimeProvider()
    {
        return array(
            array(8, 8),
            array(5, 5),
            array(3, 3),
            array(1, 1)
        );
    }

    public function calculateSenderPriceExceptionProvider()
    {
        return array(
            array(50),
            array(100),
            array(15),
        );
    }
}