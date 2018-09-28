<?php
namespace App\Form;

use App\Entity\Plat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\CategoriePlat;
use App\Repository\CategoriePlatRepository;

class PlatType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('denomination')
            ->add('description')
            ->add('image')
            ->add('type')
        //pour afficher une liste déroulante de propositions qui appartiennent à une autre entité
            ->add('categoriePlat', EntityType::class, array(
            'class' => CategoriePlat::class,
            'choice_label' => 'denomination',
                'query_builder' => function(CategoriePlatRepository $cpr){
                    return $cpr->createQueryBuilder('cp')
                    ->orderBy('cp.denomination', 'ASC');
                },
                'group_by' => function(CategoriePlat $cp){
                    return $cp->getId();
                }
        ));  
        // ->add('actif')
        // ->add('commandes')
        // ->add('menus')
        

        $builder->add('save', SubmitType::class, array(
            'label' => $options['label_submit'],
            'attr' => array(
                'class' => 'btn btn-primary'
            )
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
            'label_submit' => 'Valider'
        ]);
    }
}
