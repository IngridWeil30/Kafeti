<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ingredient;

class IngredientController extends AppController
{
    /**
     * @Route("/ingredient/listing", name="ingredient_listing")
     */
    public function index()
    {
        $ingredients = $this->getDoctrine()
        ->getRepository(Ingredient::class)
        ->findAll();
        
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
}
