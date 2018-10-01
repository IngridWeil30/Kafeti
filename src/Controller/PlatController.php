<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Plat;
use App\Form\PlatType;
use Symfony\Component\HttpFoundation\Request;

class PlatController extends AppController
{
    /**
     * Précision de constantes permettant de définir le type du plat
     * @var array
     */
    const TYPE = array(
        1 => 'Entrée',
        2 => 'Plat',
        3 => 'Dessert'
    );
    
    /**
     * Index des plats
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
    
    /**
     * Ajout d'un plat
     * @Route("/plat/add", name="plat_add")
     */
    public function addAction(Request $request)
    {
        $plat = new Plat();
       
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $plat->setActif(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($plat);
            $em->flush();
            return $this->redirect($this->generateUrl('plat_listing'));
        }
        return $this->render('plat/add.html.twig', array(
            'plat' => $plat,
            'form' => $form->createView()
        ));
    }
    
    /**
     * Fiche d'un plat
     * @Route("/plat/see/{id}", name="plat_see")
     * @ParamConverter("plat", options={"mapping": {"id": "id"}})
     */
    public function seeAction(Plat $plat) {
        
        return $this->render('plat/see.html.twig', array(
            'plat' => $plat
        ));
    }
}
