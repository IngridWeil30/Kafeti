<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ingredient;
use App\Entity\PrixIngredient;
use Symfony\Component\HttpFoundation\Request;
use App\Form\IngredientType;

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
            'prix_ingredients' => $prix_ingredients,
            'paths' => array(
                'home' => $this->indexUrlProject(),
                'active' => "Liste des ingrédients"
            )
        ]);
    }
    
    /**
     * Ajout d'un ingrédient
     * @Route("/ingredient/add", name="ingredient_add")
     */
    public function addAction(Request $request)
    {
        $ingredient = new Ingredient();
        
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient->setActif(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingredient);
            $em->flush();
            return $this->redirect($this->generateUrl('ingredient_listing'));
        }
        return $this->render('plat/add.html.twig', array(
            'ingredient' => $ingredient,
            'form' => $form->createView(),
            'paths' => array(
                'home' => $this->indexUrlProject(),
                'active' => "Ajout d'un ingrédient"
            )
        ));
    }
}
