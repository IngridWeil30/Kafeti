<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Menu;

class LoadMenuData extends Fixture
{

    private $tabMenu = [
        'Menu' => [
            'Menu-1' => [
                'setDenomination' => 'Menu midi express',
                'setActif' => 1
            ],
            'Menu-2' => [
                'setDenomination' => 'Menu du soir',
                'setActif' => 1
            ],
            'Menu-3' => [
                'setDenomination' => 'Menu week-ends & jours fériés',
                'setActif' => 1
            ]
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $menusArray = $this->tabMenu['Menu'];

        foreach ($menusArray as $name => $object) {
            $menu = new Menu();

            foreach ($object as $key => $val) {
                $menu->{$key}($val);
            }

            $manager->persist($menu);
            $this->addReference($name, $menu);
        }
        $manager->flush();
    }
}
