<?php

namespace App\Form;

use App\Entity\Batiment;
use App\Entity\Chambre;
use App\Entity\Departement;
use App\Entity\Etudiant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('prenom')
            ->add('nom')
            ->add('mail')
            ->add('telephone')
            ->add('adresse')
            ->add('date')
            ->add('typeEtudiant')
            ->add('typeBourse', ChoiceType::class,[
                'placeholder'=>'Choisir le type de d\'etudiant',
                'choices'=>[
                    'Boursier Loge'=>'Boursier Loge',
                    'Boursier Non Loge'=>'Boursier Non Loge',
                    'Non Boursier'=>'Non Boursier',
                ],
            ])
            ->add('numChambre', EntityType::class,[
                'class' => Chambre::class,
                'choice_label' => 'numChambre'])
            ->add('nomDepartement', EntityType::class,[
            'class' => Departement::class,
            'choice_label' => 'nomDepartement']);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
