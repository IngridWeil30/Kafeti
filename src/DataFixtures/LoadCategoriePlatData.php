<?php
namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\CategoriePlat;

class LoadCategoriePlatData extends Fixture
{

    private $tabCategoriePlat = [
        'CategoriePlat' => [
            'CategoriePlat-1' => [
                'setDenomination' => 'Français',
                'setContinent' => 'Europe'
            ],
            'CategoriePlat-2' => [
                'setDenomination' => 'Italien',
                'setContinent' => 'Europe'
            ],
            'CategoriePlat-3' => [
                'setDenomination' => 'Chinois',
                'setContinent' => 'Asie'
            ],
            'CategoriePlat-4' => [
                'setDenomination' => 'Mexicain',
                'setContinent' => 'Amérique'
            ],
            'CategoriePlat-5' => [
                'setDenomination' => 'Japonais',
                'setContinent' => 'Asie'
            ],
            'CategoriePlat-6' => [
                'setDenomination' => 'Péruvien',
                'setContinent' => 'Amérique'
            ]
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $categoriePlatsArray = $this->tabCategoriePlat['CategoriePlat'];

        foreach ($categoriePlatsArray as $name => $object) {
            $categorie_plat = new CategoriePlat();

            foreach ($object as $key => $val) {

                $categorie_plat->{$key}($val);
            }

            $manager->persist($categorie_plat);
            $this->addReference($name, $categorie_plat);
        }
        $manager->flush();
    }
}
