<?php
namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\PrixIngredient;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadPrixIngredientData extends Fixture implements DependentFixtureInterface
{

    private $tabPrixIngredient = [
        'PrixIngredient' => [
            'PrixIngredient-1' => [
                'setPrix' => 0.20,
                'setDateDebut' => '2018-09-25 17:00:00',
                'setIngredient' => 'Ingredient-1'
            ],
            'PrixIngredient-2' => [
                'setPrix' => 4.00,
                'setDateDebut' => '2018-09-12 15:21:05',
                'setIngredient' => 'Ingredient-2'
            ],
            'PrixIngredient-3' => [
                'setPrix' => 4.80,
                'setDateDebut' => '2018-08-15 09:10:48',
                'setIngredient' => 'Ingredient-3'
            ],
            'PrixIngredient-4' => [
                'setPrix' => 0.30,
                'setDateDebut' => '2018-07-05 13:27:50',
                'setIngredient' => 'Ingredient-4'
            ],
            'PrixIngredient-5' => [
                'setPrix' => 0.50,
                'setDateDebut' => '2018-06-11 14:10:32',
                'setIngredient' => 'Ingredient-5'
            ],
            'PrixIngredient-6' => [
                'setPrix' => 0.15,
                'setDateDebut' => '2018-09-26 09:21:19',
                'setIngredient' => 'Ingredient-6'
            ]
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $prixIngredientsArray = $this->tabPrixIngredient['PrixIngredient'];

        foreach ($prixIngredientsArray as $name => $object) {
            $prix_ingredient = new PrixIngredient();

            foreach ($object as $key => $val) {
                
                if($key == 'setDateDebut')
                {
                    $val = new \DateTime($val);
                }
                if ($key == 'setIngredient') {
                    $ingredient = $this->getReference($val);
                    $prix_ingredient->{$key}($ingredient);
                } else {
                    $prix_ingredient->{$key}($val);
                }
            }

            $manager->persist($prix_ingredient);
            $this->addReference($name, $prix_ingredient);
        }
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            LoadIngredientData::class
        );
    }
}
