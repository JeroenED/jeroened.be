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

namespace JeroenED\CmsEDBundle\Classes;

/**
 * Description of Functions
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class Functions {
    
    static function encryptEmails($html) {
        $replacements[0]['from'] = '-';
        $replacements[0]['to'] = '&#x2D;';
        $replacements[1]['from'] = '_';
        $replacements[1]['to'] = '&#x5F;';
        $replacements[2]['from'] = '~';
        $replacements[2]['to'] = '&#x7E;';
        $replacements[3]['from'] = '.';
        $replacements[3]['to'] = '&#x2E;';
        $replacements[4]['from'] = '@';
        $replacements[4]['to'] = '&#x40;';
        
        foreach($replacements as $key=>$value) {
            $html = str_replace($value['from'], $value['to'], $html);
        }
        
        return $html;
        
    }
    
}
