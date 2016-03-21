<?php
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
