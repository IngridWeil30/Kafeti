<?php
namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Utilisateur;

class LoadUtilisateurData extends Fixture
{

    private $tabUtilisateur = [
        'Utilisateur' => [            
            'Utilisateur-1' => [
                'setUsername' => 'gerant',
                'setPassword' => 'gerant',
                'setSalt' => '1A2B3C4D5E6F7G890',
                'setRoles' => array('ROLE_GERANT'),
                'setNom' => 'Lignac',
                'setPrenom' => 'Cyril',
                'setEmail' => 'cyril.lignac@gmail.com',
                'setActif' => 1,   
            ],
            'Utilisateur-2' => [
                'setUsername' => 'serveur',
                'setPassword' => 'serveur',
                'setSalt' => '1A2B3C4D5E6F7G890',
                'setRoles' => array('ROLE_SERVEUR'),
                'setNom' => 'Durand',
                'setPrenom' => 'Gaston',
                'setEmail' => 'gaston.durand@gmail.com',
                'setActif' => 1,
            ],
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $utilisateursArray = $this->tabUtilisateur['Utilisateur'];

        foreach ($utilisateursArray as $name => $object) {
            $utilisateur = new Utilisateur();

            foreach ($object as $key => $val) {
                if ($key == 'setCategoriePlat') {
                    $categorie_plat = $this->getReference($val);
                    $plat->{$key}($categorie_plat);
                } else {
                    $utilisateur->{$key}($val);
                }
            }

            $manager->persist($utilisateur);
            $this->addReference($name, $utilisateur);
        }
        $manager->flush();
    }
}
