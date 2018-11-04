<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Menu;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MenuType;

class MenuController extends AppController
{

    /**
     *
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

    /**
     * Ajout d'un menu
     *
     * @Route("/menu/add", name="menu_add")
     */
    public function addAction(Request $request)
    {
        $menu = new Menu();

        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $menu->setActif(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);
            $em->flush();
            return $this->redirect($this->generateUrl('menu_listing'));
        }
        return $this->render('menu/add.html.twig', array(
            'menu' => $menu,
            'form' => $form->createView(),
            'paths' => array(
                'home' => $this->indexUrlProject(),
                'active' => "Ajout d'un menu"
            )
        ));
    }
}