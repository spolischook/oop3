<?php

namespace Spolischook\Model;

abstract class AbstractSender
{
    const INTERCONTINENTAL = 1;
    const LOCAL            = 2;

    protected $capacity;
    protected $price;
    protected $maxDistance;
    protected $speed;
    protected $rate;

    abstract public function calculateSenderPrice($distance);

    abstract public function calculateSenderTime($distance);

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getMaxDistance()
    {
        return $this->maxDistance;
    }

    /**
     * @param mixed $maxDistance
     */
    public function setMaxDistance($maxDistance)
    {
        $this->maxDistance = $maxDistance;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    /**
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param mixed $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }
}