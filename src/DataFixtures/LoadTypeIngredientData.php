<?php
namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\TypeIngredient;

class LoadTypeIngredientData extends Fixture
{

    private $tabTypeIngredient = [
        'TypeIngredient' => [
            'TypeIngredient-1' => [
                'setDenomination' => 'Légumes'
            ],
            'TypeIngredient-2' => [
                'setDenomination' => 'Viandes'
            ],
            'TypeIngredient-3' => [
                'setDenomination' => 'Poissons'
            ],
            'TypeIngredient-4' => [
                'setDenomination' => 'Féculents'
            ],
            'TypeIngredient-5' => [
                'setDenomination' => 'Fruits'
            ],
            'TypeIngredient-6' => [
                'setDenomination' => 'Condiments'
            ]
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $typeIngredientsArray = $this->tabTypeIngredient['TypeIngredient'];

        foreach ($typeIngredientsArray as $name => $object) {
            $type_ingredient = new TypeIngredient();

            foreach ($object as $key => $val) {

                $type_ingredient->{$key}($val);
            }

            $manager->persist($type_ingredient);
            $this->addReference($name, $type_ingredient);
        }
        $manager->flush();
    }
}
