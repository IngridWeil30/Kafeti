<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AppController
{
    /**
     * Page d'accueil
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController'
        ]);
    }
}
