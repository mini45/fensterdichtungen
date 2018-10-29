<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_image_submit.inc.php 899 2005-04-29 02:40:57Z hhgag $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(html_output.php,v 1.52 2003/03/19); www.oscommerce.com 
   (c) 2003	 nextcommerce (xtc_image_submit.inc.php,v 1.3 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
   
// The HTML form submit button wrapper function
// Outputs a button in the selected language
	// Karl 06.01.2014 Buttons für Bootstarp angepasst
function xtc_image_submit($image, $alt = '', $parameters = '') {
    // wenn das gewählte Template "bootstrap" heisst die geänderte Funktion xtc_image_button aufrufen - sollte das template umbenannt werden, ist der Name des Templates in der nächsten Zeile zu ändern z.B. CURRENT_TEMPLATE == "mein_template"
    if (CURRENT_TEMPLATE == "bootstrap") {
        return xtc_image_button($image, $alt, $parameters, true);
    } else {
        $image_submit = '<input type="image" src="' . xtc_parse_input_field_data('templates/'.CURRENT_TEMPLATE.'/buttons/' . $_SESSION['language'] . '/'. $image, array('"' => '&quot;')) . '" alt="' . xtc_parse_input_field_data($alt, array('"' => '&quot;')) . '"';

        if (xtc_not_null($alt)) $image_submit .= ' title=" ' . xtc_parse_input_field_data($alt, array('"' => '&quot;')) . ' "';

        if (xtc_not_null($parameters)) $image_submit .= ' ' . $parameters;

        $image_submit .= ' />';

        return $image_submit;
    }
  }
	// Karl 06.01.2014 Buttons für Bootstarp angepasst
 ?>