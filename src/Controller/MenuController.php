<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Menu;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu/listing", name="menu_listing")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Menu::class);
        $menus = $repository->findAll();
        return $this->render('menu/index.html.twig', [
            'controller_name' => 'MenuController',
            'menus' => $menus
        ]);
    }
}
