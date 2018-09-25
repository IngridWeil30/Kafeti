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
