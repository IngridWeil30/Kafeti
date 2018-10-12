<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends Controller
{   
    /**
     * Liste de constantes précisant les différents droits (selon l'utilisateur connecté)
     */
    const DROITS = array(
        'ROLE_GERANT' => 'Gérant',
        'ROLE_SERVEUR' => 'Serveur',
    );
    
    /**
     * Nombre maximum d'éléments pour la pagination
     *
     * @var integer
     */
    const MAX_NB_RESULT = 15;
    
    /**
     * Indentifiant pour la recherche courante
     *
     * @var string
     */
    const CURRENT_SEARCH = 'current_search';
    
    /**
     * Debug array
     *
     * @param mixed $data
     */
    public function pre($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    
    /**
     * Url de la home du projet
     *
     * @return string
     */
    public function indexUrlProject()
    {
        return $this->generateUrl('index');
    }
    
    /**
     * Ajoute dans la session le champ field et order pour les tris
     *
     * @param SessionInterface $session
     * @param string $field
     * @param string $order
     */
    public function setDatasFilter(SessionInterface $session, $field, $order)
    {
        $session->set('current_field', $field);
        $session->set('current_order', $order);
    }
    
    /**
     * Renvoi un tableau contenant le champ field et order des tris
     *
     * @param SessionInterface $session
     * @return array [order] => l'ordre de tri
     *         [field] => champs à trier
     */
    public function getDatasFilter(SessionInterface $session)
    {
        $return = array();
        $return['order'] = $session->get('current_order');
        $return['field'] = $session->get('current_field');
        
        return $return;
    }
    
    /**
     * Fonction permettant la recherche à multiples filtres
     *
     * @param Request $request
     * @param SessionInterface $session
     * @param array $params
     *            [order] => l'ordre de tri
     *            [field] => champs à trier
     *            [repositoryClass] => repository (classe) concerné
     *            [repositoryMethode] => méthode à utiliser dans le repository
     *            [page] => indication pour la pagination
     *            [jointure] => tableau des jointures supplémentaires à faire
     *            [condition] => tableau contenant les filtres supplémentaires
     *            [ajax] => booléen, pour savoir si la requête est une requête ajax
     * @return array @return liste des résultats de la recherche
     */
    public function genericSearch(Request $request, SessionInterface $session, array $params)
    {
        $repository = $this->getDoctrine()->getRepository($params['repositoryClass']);
        
        $paramsSearch = $session->get(self::CURRENT_SEARCH);
        
        
        
        if (empty($paramsSearch)) {
            $paramsSearch = $request->request->all();
        } else {
            $paramsSearch = array_merge($paramsSearch, $request->request->all());
        }
        
        foreach ($paramsSearch as $key => $val) {
            $tab = explode('-', $key);
            if ($tab[0] != $params['repository']) {
                unset($paramsSearch[$key]);
            }
        }
        
        // Vérification si le champ de tri appartient bien à l'objet
        $obj = new $params['repositoryClass']();
        $array_methode = get_class_methods($obj);
        $field = str_replace('_', '', $params['field']);
        $is_true = false;
        foreach ($array_methode as $methode) {
            $methode = str_replace('set', '', $methode);
            $methode = strtolower($methode);
            if ($methode == $field) {
                $is_true = true;
                break;
            }
        }
        
        if (! $is_true) {
            $params['field'] = 'id';
        }
        
        $paramsRepo = array(
            'field' => $params['field'],
            'order' => $params['order'],
            'repository' => $params['repository'],
            'search' => $paramsSearch
        );
        
        if (isset($params['condition'])) {
            $paramsRepo['condition'] = $params['condition'];
        }
        
        if (isset($params['jointure'])) {
            $paramsRepo['jointure'] = $params['jointure'];
        }
        
        $session->set(self::CURRENT_SEARCH, $paramsSearch);
        
        $max_nbr_result = (isset($params['ajax']) && $params['ajax'] ? self::MAX_NB_RESULT_AJAX : self::MAX_NB_RESULT);
        
        return $repository->{$params['repositoryMethode']}($params['page'], $max_nbr_result, $paramsRepo);
    }
   
    /**
     * Supprime une recherche de la session
     *
     * @Route("/utils/delete-search/{page}/{key}", name="utils_delete-search", defaults={"key"= null})
     */
    public function deleteSearch(Request $request, SessionInterface $session, int $page, $key = null)
    {
        $paramsSearch = $session->get(self::CURRENT_SEARCH);
        if (isset($paramsSearch[$key])) {
            unset($paramsSearch[$key]);
        }
        
        $session->set(self::CURRENT_SEARCH, $paramsSearch);
        
        return $this->redirect($request->headers->get('referer'));
    }

}