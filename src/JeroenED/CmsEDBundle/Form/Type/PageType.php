<?php

namespace JeroenED\CmsEDBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Description of MenuType
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class PageType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', TextType::Class, array('label' => 'Title'));
        $builder->add('download', TextType::Class, array('label' => 'Download', 'required' => false, 'attr' => array('class' => 'typefile')));
        $builder->add('html', TextareaType::Class, array('label' => 'Html'));
        $builder->add('slug', TextType::Class, array('label' => 'Slug'));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'JeroenED\PortfolioBundle\Entity\Page',
            'error_bubbling' => true
        ));
    }

    public function getName() {
        return 'page';
    }
    
}
