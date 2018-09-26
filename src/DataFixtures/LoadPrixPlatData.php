<?php
namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\PrixPlat;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadPrixPlatData extends Fixture implements DependentFixtureInterface
{

    private $tabPrixPlat = [
        'PrixPlat' => [
            'PrixPlat-1' => [
                'setPrix' => 18.20,
                'setDateDebut' => '2018-09-25 17:00:00',
                'setPlat' => 'Plat-1'
            ],
            'PrixPlat-2' => [
                'setPrix' => 11.00,
                'setDateDebut' => '2018-09-12 15:21:05',
                'setPlat' => 'Plat-2'
            ],
            'PrixPlat-3' => [
                'setPrix' => 4.80,
                'setDateDebut' => '2018-08-15 09:10:48',
                'setPlat' => 'Plat-3'
            ],
            'PrixPlat-4' => [
                'setPrix' => 10.30,
                'setDateDebut' => '2018-07-05 13:27:50',
                'setPlat' => 'Plat-4'
            ],
            'PrixPlat-5' => [
                'setPrix' => 6.50,
                'setDateDebut' => '2018-06-11 14:10:32',
                'setPlat' => 'Plat-5'
            ],
            'PrixPlat-6' => [
                'setPrix' => 19.40,
                'setDateDebut' => '2018-09-26 09:21:19',
                'setPlat' => 'Plat-6'
            ]
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $prixPlatsArray = $this->tabPrixPlat['PrixPlat'];

        foreach ($prixPlatsArray as $name => $object) {
            $prix_plat = new PrixPlat();

            foreach ($object as $key => $val) {
                
                if($key == 'setDateDebut')
                {
                    $val = new \DateTime($val);
                }
                if ($key == 'setPlat') {
                    $plat = $this->getReference($val);
                    $prix_plat->{$key}($plat);
                } else {
                    $prix_plat->{$key}($val);
                }
            }

            $manager->persist($prix_plat);
            $this->addReference($name, $prix_plat);
        }
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            LoadPlatData::class,
           // LoadCategoriePlatData::class
        );
    }
}
