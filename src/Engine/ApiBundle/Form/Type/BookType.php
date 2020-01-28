<?php
declare(strict_types=1);

namespace App\Engine\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isbn', TextType::class)
            ->add('title', TextType::class)
            ->add('author', TextType::class)
            ->add('category', TextType::class)
            ->add('price', TextType::class)
            ->add('save', SubmitType::class)
        ;
    }
}