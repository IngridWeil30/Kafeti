<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Plat;

class PlatController extends AppController
{
    const TYPE = array(
        1 => 'Entrée',
        2 => 'Plat',
        3 => 'Dessert'
    );
    /**
     * @Route("/plat/listing", name="plat_listing")
     */
    public function index()
    {
        $plats = $this->getDoctrine()
        ->getRepository(Plat::class)
        ->findAll();
        
        return $this->render('plat/index.html.twig', [
            'plats' => $plats,
        ]);
    }
}
