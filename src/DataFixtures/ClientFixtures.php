<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientFixtures extends Fixture
{
    public const CLIENT_REFERENCE = 'client';

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for($i=0;$i<10;$i++)
        {
            $client = new Client();
            $client->setEmail($faker->email)->setContact($faker->name)->setName($faker->company)->setPhone($faker->phoneNumber);
            $manager->persist($client);
            $manager->flush();
            $this->addReference(self::CLIENT_REFERENCE . "_{$i}", $client);
        }
    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
