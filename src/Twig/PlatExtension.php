<?php
/**
 * Extensions Twig relatives à l'entité Plat
 */
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use App\Controller\PlatController;
use App\Controller\CategoriePlatController;

class PlatExtension extends AbstractExtension
{
    /**
     * Déclaration des filtres pour Twig
     * {@inheritDoc}
     * @see \Twig_Extension::getFilters()
     */
    public function getFilters(): array
    {
        return array(
            new TwigFilter('type', array(
                $this,
                'getType'
            )),
            new TwigFilter('continent', array(
                $this,
                'getContinent'
            ))
        );
    }

    /**
     * Déclarations des fonctions twig
     * {@inheritDoc}
     * @see \Twig_Extension::getFunctions()
     */
    public function getFunctions(): array
    {
        return array(
        );
        
    }

    /**
     * Précise le type du plat (entrée ? plat ? dessert ? etc...)
     */
    public function getType($key)
    {
        return (isset(PlatController::TYPE[$key]) ? PlatController::TYPE[$key] : $key);
    }
    
    /**
     * Récupère le nom du continent correspondant à une valeur
     */
    public function getContinent($key) {
        return (isset(CategoriePlatController::CONTINENTS[$key]) ? CategoriePlatController::CONTINENTS[$key] : $key);
    }
}
