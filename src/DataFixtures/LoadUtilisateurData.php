<?php
namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoadUtilisateurData extends Fixture
{
    private $encoder;
    
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

    public function __construct(UserPasswordEncoderInterface $encoder) {
      $this->encoder = $encoder;    
    }
    
    public function load(ObjectManager $manager)
    {
        $utilisateursArray = $this->tabUtilisateur['Utilisateur'];

        foreach ($utilisateursArray as $name => $object) {
            $utilisateur = new Utilisateur();

            foreach ($object as $key => $val) {
                if($key == 'setPassword') {
                    $password = $this->encoder($utilisateur, $val);
                    $utilisateur->{$key}($password);
                }
                else {
                    $utilisateur->{$key}($val);
                }
            }

            $manager->persist($utilisateur);
            $this->addReference($name, $utilisateur);
        }
        $manager->flush();
    }
    
    private function encoder(Utilisateur $utilisateur, $val) {
        return $this->encoder->encodePassword($utilisateur, $val);
    }
}
