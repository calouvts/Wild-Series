<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {

        $contributeur = new User();
        $contributeur ->setPassword($this->passwordEncoder->encodePassword(
            $contributeur ,
            'contributorpassword'
        ));
        $contributeur ->setEmail('contributor@monsite.com');
        $contributeur->setRoles(['ROLE_CONTRIBUTOR']);
        $this->addReference('test_contrib', $contributeur);

        $manager->persist($contributeur);

        $contributeur2 = new User();
        $contributeur2 ->setPassword($this->passwordEncoder->encodePassword(
            $contributeur2 ,
            'contributorpassword'
        ));
        $contributeur2 ->setEmail('contributor2@monsite.com');
        $contributeur2->setRoles(['ROLE_CONTRIBUTOR']);
        $this->addReference('test_contrib2', $contributeur2);

        $manager->persist($contributeur2);

        $admin = new User();
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $this->addReference('test_admin', $admin);


        $manager->persist($admin);
        $manager->flush();
    }
}
