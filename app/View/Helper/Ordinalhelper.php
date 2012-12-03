<?php
/*
 * CakePHP helper for exporting ordinal numbers (1st, 3rd, etc.)
 * @var $num (INT) - the number to be suffixed.
 * @var $sup (BOOL) - whether to wrap the suffix in a superscript (<sup>) tag on output.
 *
 * Use: Place in app/View/Helper, add var $helper = array('Ordinal') in the controller,
 * either AppController to use it app-wide, or the individual controller.
 * 
 * Author: Brian Hollenbeck
 * URL: http://elsewar.es
 * github: elsewares
 * 
 */

class OrdinalHelper extends AppHelper {

    function addSuffix($num = 0, $sup = false) {
        $suff = '';
        if (!in_array(($num % 100),array(11,12,13))){
          switch ($num % 10) {
            // Handle 1st, 2nd, 3rd
            case 1:  $suff = 'st'; break;
            case 2:  $suff = 'nd'; break;
            case 3:  $suff = 'rd'; break;
            default: $suff = 'th';
          }
        }
        return ($sup)? $num . '<sup>' . $suff . '</sup>' : $num . $suff;
    }
}

?>