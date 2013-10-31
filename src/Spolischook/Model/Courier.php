<?php

namespace Spolischook\Model;

class Courier extends AbstractSender
{
    const MALE   = 1;
    const FEMALE = 2;

    protected $gender;
    protected $age;

    public function __construct()
    {
        $this->setCapacity(10);
        $this->setMaxDistance(10);
        $this->setSpeed(2);
        $this->setRate(1);
    }

    public function calculateSenderPrice($distance)
    {
        if ($distance > $this->maxDistance) {
            throw new \InvalidArgumentException("Courier's max distance is: $this->maxDistance");
        }

        return $distance * $this->rate;
    }

    public function calculateSenderTime($distance)
    {
        if ($distance > $this->maxDistance) {
            throw new \InvalidArgumentException("Courier's max distance is: $this->maxDistance");
        }

        $speedRate = 1;
        switch ($this->gender) {
            case self::MALE:
                $speedRate = $speedRate * 2;
                break;
            case self::FEMALE:
                $speedRate = $speedRate * 0.5;
                break;
            default:
                $speedRate = $speedRate * 1;
                break;
        }

        return $distance / ($speedRate * $this->speed);
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }
}