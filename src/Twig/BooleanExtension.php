<?php
/**
 * Traitement des éléments de type booléens dans Twig
 */
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class BooleanExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return array(
            new TwigFilter('actif', array(
                $this,
                'isActif'
            ))
        );
    }

    public function getFunctions(): array
    {
        return array(
            new TwigFunction('function_name', array(
                $this,
                'doSomething'
            ))
        );
    }
    
    /**
     * Renvoie Oui ou Non en fonction de $value
     *
     * @param boolean $value
     * @return string
     */
    public function isActif($value, $avec_pastille = false, $avec_texte = false)
    {
        if($avec_pastille && $avec_texte){
            return ($value == 1 ? '<span class="text-success"><span class="oi oi-media-record"></span></span> Oui' : '<span class="text-danger"><span class="oi oi-media-record"></span></span> Non');
        } else if ($avec_pastille && !$avec_texte) {
            return ($value == 1 ? '<span class="text-success"><span class="oi oi-media-record"></span></span>' : '<span class="text-danger"><span class="oi oi-media-record"></span></span>');
        }
        return ($value == 1 ? 'Oui' : 'Non');
    }
}
