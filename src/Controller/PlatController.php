<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\Plat;
use App\Form\PlatType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\CategoriePlat;

class PlatController extends AppController
{

    /**
     * Précision de constantes permettant de définir le type du plat
     *
     * @var array
     */
    const TYPE = array(
        1 => 'Entrée',
        2 => 'Plat',
        3 => 'Dessert'
    );

    /**
     * Listing des plats
     *
     * @Route("/plat/listing/{page}/{field}/{order}", name="plat_listing", defaults={"page" = 1, "field"= null, "order"= null}))
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
            'repositoryClass' => Plat::class,
            'repository' => 'Plat',
            'repositoryMethode' => 'findAllPlats'
        );

        $result = $this->genericSearch($request, $session, $params);

        $pagination = array(
            'page' => $page,
            'route' => 'plat_listing',
            'pages_count' => ceil($result['nb'] / self::MAX_NB_RESULT),
            'nb_elements' => $result['nb'],
            'route_params' => array(
                'field' => $field,
                'order' => $order
            )
        );

        $repository = $this->getDoctrine()->getRepository(CategoriePlat::class);
        $resultats = $repository->findAll();
        $categories = array();
        foreach ($resultats as $resultat){
            $categories[$resultat->getId()] = $resultat->getDenomination();
        }
        
        return $this->render('plat/index.html.twig', [
            'plats' => $result['paginator'],
            'pagination' => $pagination,
            'categories' => $categories,
            'current_order' => $order,
            'current_field' => $field,
            'current_search' => $session->get(self::CURRENT_SEARCH),
            'paths' => array(
                'home' => $this->indexUrlProject(),
                'active' => "Liste des plats"
            )
        ]);
    }

    /**
     * Ajout d'un plat
     *
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
            'form' => $form->createView(),
            'paths' => array(
                'home' => $this->indexUrlProject(),
                'active' => "Ajout d'un plat"
            )
        ));
    }

    /**
     * Fiche d'un plat
     *
     * @Route("/plat/see/{id}", name="plat_see")
     * @ParamConverter("plat", options={"mapping": {"id": "id"}})
     */
    public function seeAction(Plat $plat)
    {
        return $this->render('plat/see.html.twig', array(
            'plat' => $plat,
            'paths' => array(
                'home' => $this->indexUrlProject(),
                'urls' => [
                    $this->generateUrl('plat_listing') => "Listing des plats"
                ],
                'active' => "Fiche d'un plat"
            )
        ));
    }

    /**
     * Edition d'un plat
     *
     * @Route("/plat/edit/{id}", name="plat_edit")
     * @ParamConverter("plat", options={"mapping": {"id": "id"}})
     */
    public function editAction(Request $request, Plat $plat)
    {
        $form = $this->createForm(PlatType::class, $plat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($plat);
            $em->flush();
        }

        return $this->render('plat/edit.html.twig', array(
            'plat' => $plat,
            'form' => $form->createView(),
            'paths' => array(
                'home' => $this->indexUrlProject(),
                'urls' => [
                    $this->generateUrl('plat_listing') => "Listing des plats"
                ],
                'active' => "Edition d'un plat"
            )
        ));
    }

    /**
     * Désactivation d'un plat
     *
     * @Route("/plat/delete/{id}", name="plat_delete")
     * @ParamConverter("famille", options={"mapping": {"id": "id"}})
     * @Security("is_granted('ROLE_GERANT')")
     *
     */
    public function deleteAction(Request $request, Plat $plat)
    {
        if ($plat->getActif() == 0) {
            $plat->setActif(1);
        } else {
            $plat->setActif(0);
        }

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($plat);

        $entityManager->flush();

        return $this->redirectToRoute('plat_listing');
    }
}
