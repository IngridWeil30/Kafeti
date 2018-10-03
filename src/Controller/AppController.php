<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     * Url de la home du projet
     *
     * @return string
     */
    public function indexUrlProject()
    {
        return $this->generateUrl('index');
    }

}