<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Service\Slugify;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for($i=1;$i<=50;$i++) {
            $episode = new Episode();
            $episode->setSeason($this->getReference("season_" . rand(1, 50)));
            $episode->setTitle($faker->sentence());
            $episode->setNumber($faker->numberBetween($min=1, $max=12));
            $episode->setSynopsis($faker->text());
            $slug = $this->slugify->generate($episode->getTitle());
            $episode->setSlug($slug);
            $manager->persist($episode);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }
}
