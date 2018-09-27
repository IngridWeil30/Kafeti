<?php
namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\IngredientPlat;
use App\Entity\Ingredient;
use App\Entity\Plat;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadIngredientPlatData extends Fixture implements DependentFixtureInterface
{
    private $tabIngredientPlat = [
        'IngredientPlat' => [            
            'IngredientPlat-1' => [
            'setIngredient' => 'Ingredient-1',
            'setPlat' => 'Plat-1',
            'setQuantite' => 2,
            ],
            'IngredientPlat-2' => [
                'setIngredient' => 'Ingredient-2',
                'setPlat' => 'Plat-2',
                'setQuantite' => 2.5,
            ],
            'IngredientPlat-3' => [
                'setIngredient' => 'Ingredient-3',
                'setPlat' => 'Plat-3',
                'setQuantite' => 1.8,
            ],
            'IngredientPlat-4' => [
                'setIngredient' => 'Ingredient-4',
                'setPlat' => 'Plat-4',
                'setQuantite' => 8,
            ],
            'IngredientPlat-5' => [
                'setIngredient' => 'Ingredient-5',
                'setPlat' => 'Plat-5',
                'setQuantite' => 6,
            ],
            'IngredientPlat-6' => [
                'setIngredient' => 'Ingredient-6',
                'setPlat' => 'Plat-6',
                'setQuantite' => 1,
            ],
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $ingredientsPlatArray = $this->tabIngredientPlat['IngredientPlat'];

        foreach ($ingredientsPlatArray as $name => $object) {
            $ingredientPlat = new IngredientPlat();
            $ingredient = new Ingredient();
            $plat = new Plat();
            
            foreach ($object as $key => $val) {
                if ($key == 'setIngredient') {
                    $ingredient = $this->getReference($val);
                    $ingredientPlat->{$key}($ingredient);
                } 
                else if ($key == 'setPlat') {
                    $plat = $this->getReference($val);
                    $ingredientPlat->{$key}($plat);
                }               
                else {
                    $ingredientPlat->{$key}($val);
                }
            }

            $manager->persist($ingredientPlat);
            $this->addReference($name, $ingredientPlat);
        }
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            LoadIngredientData::class,
            LoadPlatData::class
        );
    }
}
