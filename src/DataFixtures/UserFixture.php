<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setFirstName('leela');
        $user->setlastName('krishna');
        $user->setEmail('krishna18798@gmail.com');

        $user->setPassword($this->passwordEncoder->encodePassword(
                         $user,
                         'Hanatech@'

                     ));
        $manager->persist($user);
        $manager->flush();







    }
}
