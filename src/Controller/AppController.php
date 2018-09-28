<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{   
    const DROITS = array(
        'ROLE_GERANT' => 'Gérant',
        'ROLE_SERVEUR' => 'Serveur',
    );
}