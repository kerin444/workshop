<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'admin-user';
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('flamaison@sporafric.net');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setName("Fabien LAMAISON");
        $password = $this->hasher->hashPassword($user, 'fab-babar');
        $user->setPassword($password);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('uokiemba@sporafric.net');
        $user->setRoles(["ROLE_USER"]);
        $user->setName("Urbain OKIEMBA");
        $password = $this->hasher->hashPassword($user, 'urbain');
        $user->setPassword($password);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('fbazebi@sporafric.net');
        $user->setRoles(["ROLE_USER"]);
        $user->setName("Fortuné BAZEBI");
        $password = $this->hasher->hashPassword($user, 'fortune');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();
        // other fixtures can get this object using the UserFixtures::ADMIN_USER_REFERENCE constant
        $this->addReference(self::ADMIN_USER_REFERENCE, $user);

    }
}