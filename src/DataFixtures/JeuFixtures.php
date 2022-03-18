<?php

namespace App\DataFixtures;

use App\Entity\Jeu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JeuFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $jeu = new Jeu();
        $jeu->setName('Kluster');
        $jeu->setEditor('Kluster');
        $jeu->setCreatedAt(new \DateTime);
        $manager->persist($jeu);
        $manager->flush();
    }
}
