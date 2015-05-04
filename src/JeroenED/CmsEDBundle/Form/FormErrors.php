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
