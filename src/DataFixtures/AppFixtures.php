<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 100; $i++) {
            $property = new Property();
            $property->setTitle($faker->sentence($nbWords = 3, $variableNbWords = true));
            $property->setDescription($faker->text($maxNbChars = 200));
            $property->setSurface($faker->numberBetween($min = 30, $max = 200));
            $property->setPrice($faker->numberBetween($min = 50000, $max = 1000000));
            $property->setHeat($faker->numberBetween($min = 0, $max = 1));
            $property->setSold($faker->numberBetween($min = 0, $max = 1));
            $property->setPostalCode($faker->postcode);
            $property->setCity($faker->city);
            $property->setCreatedAt($faker->dateTime($max = 'now', $timezone = null));
            $manager->persist($property);
        }

        $manager->flush();
    }
}
