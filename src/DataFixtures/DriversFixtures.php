<?php

namespace App\DataFixtures;

use App\Entity\Drivers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DriversFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $driver1 = new Drivers();
        $driver1->setName("Jean Rep");
        $driver1->setWorkDays("4");
        $driver1->setVehicle("CAT");
        $manager->persist($driver1);

        $driver2 = new Drivers();
        $driver2->setName("Tom Rit");
        $driver2->setWorkDays("2");
        $driver2->setVehicle("Toyota");
        $manager->persist($driver2);

        $manager->flush();
    }
}
