<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoriePlatController extends AbstractController
{
    const CONTINENTS = array(
        1 => 'Amérique',
        2 => 'Afrique',
        3 => 'Asie',
        4 => 'Europe',
        5 => 'Océanie'
    );

    /**
     *
     * @Route("/categorie/plat", name="categorie_plat")
     */
    public function index()
    {
        return $this->render('categorie_plat/index.html.twig', [
            'controller_name' => 'CategoriePlatController'
        ]);
    }
}
