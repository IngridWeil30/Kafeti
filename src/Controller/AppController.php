<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    const TYPE = array(
        1 => 'Entrée',
        2 => 'Plat',
        3 => 'Dessert'
    );
}