<?php
/**
 * Fonctions Twig customisées pour les images
 */
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig_Extension;
use Twig\TwigFunction;

class ImageExtension extends AbstractExtension
{

    /**
     * Déclaration des fonctions pour twig
     *
     * {@inheritdoc}
     * @see Twig_Extension::getFilters()
     */
    public function getFilters()
    {
        return array();
    }

    /**
     *
     * {@inheritdoc}
     * @see Twig_Extension::getFunctions()
     */
    public function getFunctions()
    {
        return array(
            new TwigFunction('imagePlat', array(
                $this,
                'imagePlatFilter'
            )),
        );
    }

    /**
     * Permet d'afficher l'image de présentation d'un plat ou à défaut, d'un logo "en attente de visuel"
     */
    public function imagePlatFilter($img_plat = null, $plat_denomination)
    {
        $html = '';
        if (!is_null($img_plat)) {
            $html .= '<img class="redimensionnement-img d-block mt-5 mx-auto" src="'. $img_plat .'" alt=' . $plat_denomination .'><br/>';
        } else {
            $html .= '<img src="/img/image-a-venir.jpg" alt="photo à venir"><br/>';
        }
        return $html;
    }
}