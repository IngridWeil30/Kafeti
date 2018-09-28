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
            'setType' => 2
            ],
            'Plat-2' => [
                'setDenomination' => 'Spaghettis bolognaise',
                'setDescription' => 'Une délicieuse sauce Pomodoro aux  herbes.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-2',
                'setType' => 2
            ],
            'Plat-3' => [
                'setDenomination' => 'Ceviche',
                'setDescription' => 'A base de poisson mariné dans du jus de citron vert, de l’ail, de la coriandre et parfois des piments. Ce plat est accompagné généralement de patates douces et de salade.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-6',
                'setType' => 2
            ],
            'Plat-4' => [
                'setDenomination' => 'Purée maison à l\'ancienne',
                'setDescription' => 'Purée maison au beurre et au jus de citron.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-1',
                'setType' => 1
            ],
            'Plat-5' => [
                'setDenomination' => 'Délice aux deux kiwis',
                'setDescription' => 'Kiwis traditionnels et néo-zélandais accompagnés d\'une mousse de mangue.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-1',
                'setType' => 3
            ],
            'Plat-6' => [
                'setDenomination' => 'Nems sauce mandarine',
                'setDescription' => 'Vous n\'en goûterez jamais de plus croustillants.',
                'setActif' => 1,
                'setCategoriePlat' => 'CategoriePlat-3',
                'setType' => 1
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
                } else {
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
            LoadCategoriePlatData::class
        );
    }
}
