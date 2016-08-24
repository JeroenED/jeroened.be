<?php


namespace JeroenED\CmsEDBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Description of MenuType
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class PortfolioPageType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('slug', TextType::class, array('label' => 'Slug'));
        $builder->add('showtitle', CheckboxType::class, array('label' => 'Show title', 'required' => false));
        $builder->add('background', TextType::class, array('label' => 'Background image', 'required' => false, 'attr' => array('class' => 'typefile')));
        $builder->add('html', TextareaType::class, array('label' => 'Html'));
        $builder->add('index', HiddenType::class);
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array('mapped' => false));
    }

    public function getName() {
        return 'PortfolioPage';
    }
    
}
