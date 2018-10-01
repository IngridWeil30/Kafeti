<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ingredient;
use App\Entity\PrixIngredient;

class IngredientController extends AppController
{
    /**
     * Index des ingrédients
     * @Route("/ingredient/listing", name="ingredient_listing")
     */
    public function index()
    {
        $ingredients = $this->getDoctrine()
        ->getRepository(Ingredient::class)
        ->findAll();
        
        $prix_ingredients = $this->getDoctrine()
        ->getRepository(PrixIngredient::class)
        ->findAll();
        
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
            'prix_ingredients' => $prix_ingredients
        ]);
    }
}
