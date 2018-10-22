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
            'setTypeIngredient' => 'TypeIngredient-1',
            'setImage' => 'https://cdn1.fermedesaintemarthe.com/I-Autre-21920_1200x1200-carotte-de-colmar-a-coeur-rouge-2-ab.net.jpg'
            ],
            'Ingredient-2' => [
                'setDenomination' => 'Boeuf',
                'setQuantite' => 12,
                'setSeuilAlerte' => 10,
                'setActif' => 1,
                'setTypeIngredient' => 'TypeIngredient-2',
                'setImage' => 'https://static.cuisineaz.com/610x610/i130833-roti-de-boeuf-au-cookeo.jpeg'
            ],
            'Ingredient-3' => [
                'setDenomination' => 'Cabillaud',
                'setQuantite' => 13,
                'setSeuilAlerte' => 10,
                'setActif' => 1,
                'setTypeIngredient' => 'TypeIngredient-3',
                'setImage' => 'http://res.cloudinary.com/hv9ssmzrz/image/fetch/c_fill,f_auto,h_288,q_auto,w_512/http://s3-eu-west-1.amazonaws.com/images-ca-1-0-1-eu/recipe_photos/slide/325/cabillaud-vapeur-0.jpg'
            ],
            'Ingredient-4' => [
                'setDenomination' => 'Pomme de terre',
                'setQuantite' => 15.5,
                'setSeuilAlerte' => 10,
                'setActif' => 1,
                'setTypeIngredient' => 'TypeIngredient-4',
                'setImage' => 'https://www.meillandrichardier.com/media/page/resized/page/images/4/8/1000x0/resized-4826-pdt-amandine-germicopa-0002-taille1000-ho.jpg'
            ],
            'Ingredient-5' => [
                'setDenomination' => 'Kiwi',
                'setQuantite' => 30,
                'setSeuilAlerte' => 10,
                'setActif' => 1,
                'setTypeIngredient' => 'TypeIngredient-5',
                'setImage' => 'https://www.lanutrition.fr/sites/default/files/styles/article_large/public/ressources/kiwis_bol_4.jpg?itok=spCQy2KN'
            ],
            'Ingredient-6' => [
                'setDenomination' => 'Confiture de mandarine',
                'setQuantite' => 5,
                'setSeuilAlerte' => 5,
                'setActif' => 1,
                'setTypeIngredient' => 'TypeIngredient-6',
                'setImage' => 'https://static.cuisineaz.com/400x320/i120384-confiture-de-mandarines.jpeg'
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
