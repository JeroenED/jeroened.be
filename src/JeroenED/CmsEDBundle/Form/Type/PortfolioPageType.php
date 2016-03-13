<?php

/*
 * The MIT License
 *
 * Copyright 2015 Jeroen De Meerleer <me@jeroened.be>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

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
        $builder->add('background', TextType::class, array('label' => 'Background image', 'required' => false, 'attr' => array('class' => 'openkcfinder')));
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
