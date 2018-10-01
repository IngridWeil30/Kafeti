<?php
/**
 * Génération automatique des liens See, Edit, Disabled
 */
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig_Extension;
use Twig\TwigFunction;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ActionExtension extends AbstractExtension
{    
    public function getFunctions()
    {
        return array(
            new TwigFunction('actionSee', array(
                $this,
                'actionSeeFilter'
            )),
            new TwigFunction('actionEdit', array(
                $this,
                'actionEditFilter'
            )),
            new TwigFunction('actionDelete', array(
                $this,
                'actionDeleteFilter'
            ))
        );
    }

    /**
     * Génération du lien See
     * @param string $url_see
     * @return string
     */
    public function actionSeeFilter($url_see)
    {
        return '<a href="' . $url_see . '" title="Voir la fiche"><span class="oi oi-eye"></span></a>';
    }

    /**
     * Génération du lien Edit
     * @param string $url_edit
     * @param string $id
     * @return string
     */
    public function actionEditFilter($url_edit, string $id = null)
    {
        $return = '<a href="' . $url_edit . '"';
        if(!is_null($id)){
            $return .= ' id="' . $id . '"';
        }
        $return .= ' title="Editer la fiche"><span class="oi oi-pencil"></span></a>';
        return $return;
    }

    /**
     * Génération du lien delete
     * @param string $url_delete
     * @param string $disabled
     * @return string
     */
    public function actionDeleteFilter($disabled, $url_delete, $id = null)
    {
        $title = "Désactiver la donnée";
        $icon = "oi-x";
        if ($disabled == 1) {
            $title = "Activer la donnée";
            $icon = "oi-check";
        }

        return '<a href="' . $url_delete . '" title="' . $title . '" class="link-delete" ' . ($id ? 'id="delete-' . $id . '"' : '') . '><span class="oi ' . $icon . '"></span></a>';
    }
}