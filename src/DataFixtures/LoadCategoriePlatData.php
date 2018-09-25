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
                'setDenomination' => 'Français'
            ],
            'CategoriePlat-2' => [
                'setDenomination' => 'Italien'
            ],
            'CategoriePlat-3' => [
                'setDenomination' => 'Chinois'
            ],
            'CategoriePlat-4' => [
                'setDenomination' => 'Mexicain'
            ],
            'CategoriePlat-5' => [
                'setDenomination' => 'Japonais'
            ],
            'CategoriePlat-6' => [
                'setDenomination' => 'Péruvien'
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
