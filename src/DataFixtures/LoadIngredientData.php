<?php
namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Ingredient;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadIngredientData extends Fixture implements DependentFixtureInterface
{

    private $tabIngredient = [
        'Ingredient' => [            
            'Ingredient-1' => [
            'setDenomination' => 'Carotte',
            'setQuantite' => 22.5,
            'setSeuilAlerte' => 10,
            'setActif' => 1,
            'setTypeIngredient' => 'TypeIngredient-1'
            ],
            'Ingredient-2' => [
                'setDenomination' => 'Boeuf',
                'setQuantite' => 12,
                'setSeuilAlerte' => 10,
                'setActif' => 1,
                'setTypeIngredient' => 'TypeIngredient-2'
            ],
            'Ingredient-3' => [
                'setDenomination' => 'Cabillaud',
                'setQuantite' => 13,
                'setSeuilAlerte' => 10,
                'setActif' => 1,
                'setTypeIngredient' => 'TypeIngredient-3'
            ],
            'Ingredient-4' => [
                'setDenomination' => 'Pomme de terre',
                'setQuantite' => 15.5,
                'setSeuilAlerte' => 10,
                'setActif' => 1,
                'setTypeIngredient' => 'TypeIngredient-4'
            ],
            'Ingredient-5' => [
                'setDenomination' => 'Kiwi',
                'setQuantite' => 30,
                'setSeuilAlerte' => 10,
                'setActif' => 1,
                'setTypeIngredient' => 'TypeIngredient-5'
            ],
            'Ingredient-6' => [
                'setDenomination' => 'Confiture de mandarine',
                'setQuantite' => 5,
                'setSeuilAlerte' => 5,
                'setActif' => 1,
                'setTypeIngredient' => 'TypeIngredient-6'
            ]
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $ingredientsArray = $this->tabIngredient['Ingredient'];

        foreach ($ingredientsArray as $name => $object) {
            $ingredient = new Ingredient();

            foreach ($object as $key => $val) {
                if ($key == 'setTypeIngredient') {
                    $type_ingredient = $this->getReference($val);
                    $ingredient->{$key}($type_ingredient);
                } else {
                    $ingredient->{$key}($val);
                }
            }

            $manager->persist($ingredient);
            $this->addReference($name, $ingredient);
        }
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            LoadTypeIngredientData::class
        );
    }
}
