<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Coach;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CoachFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i=1; $i<=5;$i++) {
            $coach = new Coach();
            $coach->setNom();

            $manager->persist($coach);
        }
        $manager->flush();
    }
    public static function getGroups(): array
    {
        // TODO: Implement getGroups() method.
        return ['$coach'];
    }
}
