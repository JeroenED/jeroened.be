<?php

namespace JeroenED\CmsEDBundle\Form;

/**
 * Description of FormErrors
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */

class FormErrors
{
    public function getArray(\Symfony\Component\Form\Form $form, $singleDim = false)
    {
        $errors =  $this->getErrors($form);
        if ($singleDim) {        
            $errors = $this->makeSingleDim($errors);
        }
        return $errors;
    }
    function makeSingleDim($element) {
        $final_array = array();
        foreach($element as $key => $value) {
            if(!is_array($value)) {array_push($final_array, $value); }
            else {
                $tempArray = $this->makeSingleDim($value);
                foreach ($tempArray as $var ) {
                    array_push($final_array, $var);
                }
            }
        }
        return $final_array;
    }
    private function getErrors($form)
    {
        $errors = array();

        if ($form instanceof \Symfony\Component\Form\Form) {

            // соберем ошибки элемента
            foreach ($form->getErrors() as $error) {

                $errors[] = $error->getMessage();
            }

            // пробежимся под дочерним элементам
            foreach ($form->all() as $key => $child) {
                /** @var $child \Symfony\Component\Form\Form */
                if ($err = $this->getErrors($child)) {
                    $errors[$key] = $err;
                }
            }
        }

        return $errors;
    }
}
