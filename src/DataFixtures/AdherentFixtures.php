<?php

namespace App\DataFixtures;

use App\Entity\Adherent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class AdherentFixtures extends Fixture
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $adherent = new Adherent();
        $adherent->setLastName('Tillet');
        $adherent->setFirstName('Jérémy');
        $adherent->setBirthdate(new \DateTime('1997-06-08'));
        $adherent->setAddress('3b Route de Chauvigny');
        $adherent->setZipcode('86800');
        $adherent->setCity('Pouillé');
        $adherent->setEmail('jeremytillet8@gmail.com');
        $adherent->setPhone('0610604674');
        $adherent->setCreatedAt(new \DateTime('@'.strtotime('now')));
        $manager->persist($adherent);
        $manager->flush();
    }
}
