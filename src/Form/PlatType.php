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
use App\Controller\PlatController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PlatType extends AbstractType
{
    /**
     * Formulaire concernant l'objet Plat
     *
     * {@inheritdoc}
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('denomination')
            ->add('description')
            ->add('image')
            //affichage des libellés et non-pas des int dans le menu déroulant (type de plat)
            ->add('type', ChoiceType::class, array(
            'choices' => array_flip($options['type_plat'])
        ))
            ->
        // pour afficher une liste déroulante de propositions qui appartiennent à une autre entité
        add('categoriePlat', EntityType::class, array(
            'class' => CategoriePlat::class,
            'choice_label' => 'denomination',
            'query_builder' => function (CategoriePlatRepository $cpr) {
                return $cpr->createQueryBuilder('cp')
                    ->orderBy('cp.denomination', 'ASC');
            },
            'group_by' => function (CategoriePlat $cp) {
            return $cp->getContinent();
            }
            ));
        
            // si on voulait trier le menu déroulant par continent par exemple :
            // 'group_by' => function(CategoriePlat $cp){
            // return $cp->getContinent();
            // }
        
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
            'label_submit' => 'Valider',
            'type_plat' => PlatController::TYPE
        ]);
    }
}
