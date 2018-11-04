<?php
namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Plat;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadPlatData extends Fixture implements DependentFixtureInterface
{

    private $tabPlat = [
        'Plat' => [
            'Plat-1' => [
                'setDenomination' => 'Boeuf bourguignon',
                'setDescription' => 'Un plat typiquement français et d\'une grande authenticité.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-1',
                'setType' => 2,
                'setImage' => 'https://cdn-rdb.arla.com/Files/arla-se/746782244/3335ceed-81c7-4c2e-b510-7d97914933c6.jpg?mode=crop&w=1680&h=750&scale=both&ak=f525e733&hm=e6b63260',
                'addMenu' => array(
                    'Menu-1'
                )
            ],
            'Plat-2' => [
                'setDenomination' => 'Spaghettis bolognaise',
                'setDescription' => 'Une délicieuse sauce Pomodoro aux  herbes.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-2',
                'setType' => 2,
                'setImage' => 'https://static.cuisineaz.com/400x320/i84653-spaghettis-bolognaise-rapides.jpg',
                'addMenu' => array(
                    'Menu-2'
                )
            ],
            'Plat-3' => [
                'setDenomination' => 'Ceviche',
                'setDescription' => 'A base de poisson mariné dans du jus de citron vert, de l’ail, de la coriandre et parfois des piments. Ce plat est accompagné généralement de patates douces et de salade.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-6',
                'setType' => 2,
                'setImage' => 'https://img-3.journaldesfemmes.fr/-dmwzz-lh83Iey6j879vcRdVyfw=/748x499/smart/d7df78062e434fb8aca2012502531bc7/recipe-jdf/10016003.jpg',
                'addMenu' => array(
                    'Menu-3'
                )
            ],
            'Plat-4' => [
                'setDenomination' => 'Hachis parmentier maison à l\'ancienne',
                'setDescription' => 'Viande origine France, purée au beurre et au jus de citron.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-1',
                'setType' => 2,
                'setImage' => 'http://sf2.viepratique.fr/wp-content/uploads/sites/2/2015/04/pur%C3%A9e-maison-2.jpg',
                'addMenu' => array(
                    'Menu-1'
                )
            ],
            'Plat-5' => [
                'setDenomination' => 'Délice aux deux kiwis',
                'setDescription' => 'Kiwis traditionnels et néo-zélandais accompagnés d\'une mousse de mangue.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-1',
                'setType' => 3,
                'setImage' => 'https://454a3915j1d326y4rhle8lk1-wpengine.netdna-ssl.com/wp-content/uploads/2018/05/pavlovamanguekiwi-1000x500.jpg',
                'addMenu' => array(
                    'Menu-3'
                )
            ],
            'Plat-6' => [
                'setDenomination' => 'Nems sauce mandarine',
                'setDescription' => 'Vous n\'en goûterez jamais de plus croustillants.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-3',
                'setType' => 1,
                'setImage' => 'https://cache.marieclaire.fr/data/photo/w600_h315_ci/1bi/petits-nems-au-boudin-noir.jpg',
                'addMenu' => array(
                    'Menu-3'
                )
            ],
            'Plat-7' => [
                'setDenomination' => 'Oeufs Mimosa',
                'setDescription' => 'Coupés en deux, le jaune est remplacé par un mélange avec de la mayonnaise et des herbes.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-1',
                'setType' => 1,
                'setImage' => 'https://image.afcdn.com/recipe/20130924/17648_w420h344c1cx1328cy1928.jpg',
                'addMenu' => array(
                    'Menu-1'
                )
            ],
            'Plat-8' => [
                'setDenomination' => 'Velouté aux deux champignons',
                'setDescription' => 'Crème aux morilles et aux cèpes, une touche de crème.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-1',
                'setType' => 1,
                'setImage' => 'https://image.afcdn.com/recipe/20160404/2282_w420h344c1cx1500cy1000.jpg',
                'addMenu' => array(
                    'Menu-1'
                )
            ],
            'Plat-9' => [
                'setDenomination' => 'Tendres filets de sole meunière',
                'setDescription' => 'Poisson sauvage, sauce beurre citron.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-1',
                'setType' => 2,
                'setImage' => 'https://aguabistrotdelamer.files.wordpress.com/2013/03/sol-meuniere.jpg',
                'addMenu' => array(
                    'Menu-1'
                )
            ],
            
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $platsArray = $this->tabPlat['Plat'];

        foreach ($platsArray as $name => $object) {
            $plat = new Plat();

            foreach ($object as $key => $val) {
                if ($key == 'setCategoriePlat') {
                    $categorie_plat = $this->getReference($val);
                    $plat->{$key}($categorie_plat);
                } else if ($key == 'addMenu') {
                    foreach ($val as $value) {
                        $val = $this->getReference($value);
                        $plat->{$key}($val);
                    }
                } 
                else {
                    $plat->{$key}($val);
                }
            }

            $manager->persist($plat);
            $this->addReference($name, $plat);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            LoadCategoriePlatData::class,
            LoadMenuData::class
        );
    }
}
