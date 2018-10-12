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
                'setContinent' => '4'
            ],
            'CategoriePlat-2' => [
                'setDenomination' => 'Italien',
                'setContinent' => '4'
            ],
            'CategoriePlat-3' => [
                'setDenomination' => 'Chinois',
                'setContinent' => '3'
            ],
            'CategoriePlat-4' => [
                'setDenomination' => 'Mexicain',
                'setContinent' => '1'
            ],
            'CategoriePlat-5' => [
                'setDenomination' => 'Japonais',
                'setContinent' => '3'
            ],
            'CategoriePlat-6' => [
                'setDenomination' => 'Péruvien',
                'setContinent' => '1'
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
