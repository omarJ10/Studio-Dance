<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    private $hasher;
    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $admin1 = new Client();

        $admin1->setEmail('omar@gmail.com');
        $admin1->setPassword($this->hasher->hashPassword($admin1,'omar'));
        $admin1->setRoles(['ROLE_ADMIN']);
        $admin1->setTelephone(26994306);
        $admin1->setNom('omar');
        $admin1->setPrenom('jalled');
        $manager->persist($admin1);


        $admin2 = new Client();

        $admin2->setEmail('hela@gmail.com');
        $admin2->setRoles(['ROLE_ADMIN']);
        $admin2->setPassword($this->hasher->hashPassword($admin2,'hela'));
        $admin2->setTelephone(54564489);
        $admin2->setNom('hela');
        $admin2->setPrenom('saoudi');

        $manager->persist($admin2);

        for ($i=1; $i<=5;$i++) {
            $user = new Client();
            $user->setEmail("user$i@gmail.com");
            $user->setPassword($this->hasher->hashPassword($user,'user'));
            $user->setTelephone(51605000+$i);
            $user->setNom("MrUser$i");
            $user->setPrenom("BenFeltan$i");

            $manager->persist($user);
        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        // TODO: Implement getGroups() method.
        return ['user'];
    }
}
