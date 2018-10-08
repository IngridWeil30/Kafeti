<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ingredient;
use Symfony\Component\HttpFoundation\Request;
use App\Form\IngredientType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class IngredientController extends AppController
{
    /**
     * Précision de constantes permettant de définir le type d'un ingrédient
     * @var array
     */
    const TYPE = array(
        1 => 'Légumes',
        2 => 'Viandes',
        3 => 'Poissons',
        4 => 'Féculents',
        5 => 'Fruits',
        6 => 'Condiments',
    );
    
    /**
     * Listing des ingrédients
     * 
     * @Route("/ingredient/listing{page}/{field}/{order}", name="ingredient_listing", defaults={"page" = 1, "field"= null, "order"= null}))
     * @Security("is_granted('ROLE_GERANT') or is_granted('ROLE_SERVEUR')")
     */
    public function index(Request $request, SessionInterface $session, int $page = 1, $field = null, $order = null)
    {
        if (is_null($field)) {
            $field = 'id';
        }
        
        if (is_null($order)) {
            $order = 'DESC';
        }
        
        $params = array(
            'field' => $field,
            'order' => $order,
            'page' => $page,
            'repositoryClass' => Ingredient::class,
            'repository' => 'Ingredient',
            'repositoryMethode' => 'findAllIngredients'
        );      
        
        $result = $this->genericSearch($request, $session, $params);
        
        $pagination = array(
            'page' => $page,
            'route' => 'ingredient_listing',
            'pages_count' => ceil($result['nb'] / self::MAX_NB_RESULT),
            'nb_elements' => $result['nb'],
            'route_params' => array()
        );
        
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $result['paginator'],
            'pagination' => $pagination,
            'current_order' => $order,
            'current_field' => $field,
            'current_search' => $session->get(self::CURRENT_SEARCH),
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
        
        return $this->render('ingredient/add.html.twig', array(
            'ingredient' => $ingredient,
            'form' => $form->createView(),
            'paths' => array(
                'home' => $this->indexUrlProject(),
                'active' => "Ajout d'un ingrédient"
            )
        ));
    }
}
