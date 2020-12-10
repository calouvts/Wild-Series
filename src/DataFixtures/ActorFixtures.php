<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use  Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()

    {

        return [ProgramFixtures::class];

    }

    const ACTORS = [
        'Andrew Lincoln',
        'Norman Reedus',
        'Lauren Cohan',
        'Danais Gurira',

    ];



    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $actor->addProgram($this->getReference('program_0'));
            $manager->persist($actor);
            $this->addReference('actor_' . $key, $actor);
        }
        $faker = Faker\Factory::create('fr_FR');
        for($i=4;$i<=50;$i++) {
            $actor = new Actor();
            $actor->setName($faker->name());
            $actor->addProgram($this->getReference('program_' . rand(1, 5), $actor));
            $manager->persist($actor);
        }
        $manager->flush();

    }
}
