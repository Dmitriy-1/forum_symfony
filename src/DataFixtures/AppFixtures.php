<?php


namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class   AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('testUser@yandex.ru');
        $password = $this->encoder->encodePassword($user, 'User123');
        $user->setPassword($password);
        $user->setRoles(['ROLE_USER']);
        $user->setNameUser('User');

        $admin = new User();
        $admin->setEmail('testAdmin@yandex.ru');
        $password = $this->encoder->encodePassword($admin, 'Admin123');
        $admin->setPassword($password);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setNameUser('Admin');

        $manager->persist($user);
        $manager->persist($admin);

        $manager->flush();
    }
}



/*
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class  AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}*/
