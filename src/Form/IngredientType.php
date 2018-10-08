<?php
namespace App\Form;

use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Controller\IngredientController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\TypeIngredient;
use App\Repository\TypeIngredientRepository;

class IngredientType extends AbstractType
{
    /**
     * Formulaire concernant l'objet Ingredient
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('denomination')
            ->add('quantite')
            ->add('seuilAlerte', IntegerType::class)
            ->add('image')
            // pour afficher une liste déroulante de propositions qui appartiennent à une autre entité
            ->add('typeIngredient', EntityType::class, array(
            'class' => TypeIngredient::class,
            'choice_label' => 'denomination',
            'query_builder' => function (TypeIngredientRepository $typIng) {
            return $typIng->createQueryBuilder('typIng')
            ->orderBy('typIng.denomination', 'ASC');
            }
            ));

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
            'data_class' => Ingredient::class,
            'label_submit' => 'Valider',
        ]);
    }
}
