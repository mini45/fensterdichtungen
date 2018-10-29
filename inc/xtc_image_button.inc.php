<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_image_button.inc.php 899 2005-04-29 02:40:57Z hhgag $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(html_output.php,v 1.52 2003/03/19); www.oscommerce.com 
   (c) 2003	 nextcommerce (xtc_image_button.inc.php,v 1.3 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
   
// Output a function button in the selected language
function xtc_image_button($image, $alt = '', $parameters = '', $submit = false) {

    // wenn das gewählte Template "bootstrap" heisst folgende Anweisungen ausführen - sollte das template umbenannt werden, ist der Name des Templates in der nächsten Zeile zu ändern z.B. CURRENT_TEMPLATE == "mein_template"
    if (CURRENT_TEMPLATE == "bootstrap") {

    $name           = $image;
    $html           = '';
    $title          = xtc_parse_input_field_data($alt, array('"' => '&quot;'));
    
    // Erklärung: es wird geprüft, welches Buttonbild von Modified aufgerufen wird. Dementsprechend werden neue Attribute zugewiesen.
    // z.B. dem Buttonbild 'button_buy_now.gif' wird zugewiesen:
    //      'Image' => '' (kein Bild - vergleiche cart_del.gif, dort wird das Bild cart_del.gif zugewiesen, damit bleibt der Button ein Bildbutton).
    //      'Text' => IMAGE_BUTTON_IN_CART (der Text der auf dem neuen Button angezeigt wird, in der Regel der Text der Modifiedvariablen '$alt', in unserem Beispiel der Text der in der Languagedatei 'IMAGE_BUTTON_IN_CART' zugewiesen wurde).
    //      'icon' => 'icon-shopping-cart' (das Icon das im Button angezeigt wird - in der Bootstrapdokumentation unter 'Icons by Glyphicons' kann man diese aussuchen).
    //      'iconposition' => 'iconleft' (die Position des Icons im Button - 'iconleft' = links vom Text, 'iconright' = rechts vom Text).
    //      'Class' => '' (hier kann dem Button noch eine zusätzliche CSS-Klasse zugewiesen werden).
    /* Buttons array */
    $buttons = array(
    'default'                       => array('Image' => '',                       'Text' => $alt,                           'icon' => '',                     'iconposition' => '',             'Class' => ''),
    'button_add_address.gif'        => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-edit',            'iconposition' => 'iconleft',     'Class' => ''),
    'button_add_quick.gif'          => array('Image' => '',                       'Text' => IMAGE_BUTTON_IN_CART,           'icon' => 'icon-shopping-cart',   'iconposition' => 'iconleft',     'Class' => ''),
    'button_admin.gif'              => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-wrench',          'iconposition' => 'iconleft',     'Class' => ''),
    'button_back.gif'               => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-arrow-left',      'iconposition' => 'iconleft',     'Class' => ''),
    'button_buy_now.gif'            => array('Image' => '',                       'Text' => IMAGE_BUTTON_IN_CART,           'icon' => 'icon-shopping-cart',   'iconposition' => 'iconleft',     'Class' => ''),
    'button_change_address.gif'     => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-edit',            'iconposition' => 'iconleft',     'Class' => ''),
    'button_checkout.gif'           => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-ok',              'iconposition' => 'iconright',    'Class' => ''),
    'button_confirm.gif'            => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-ok',              'iconposition' => 'iconright',    'Class' => ''),
    'button_confirm_order.gif'      => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-ok',              'iconposition' => 'iconright',    'Class' => ''),
    'button_continue.gif'           => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-arrow-right',     'iconposition' => 'iconright',    'Class' => ''),
    'button_continue_shopping.gif'  => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-arrow-left',      'iconposition' => 'iconleft',     'Class' => ''),
    'button_delete.gif'             => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-remove',          'iconposition' => 'iconleft',     'Class' => ''),
    'button_download.gif'           => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-download',        'iconposition' => 'iconleft',     'Class' => ''),
    'button_login.gif'              => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-user',            'iconposition' => 'iconleft',     'Class' => ''),
    'button_logoff.gif'             => array('Image' => '',                       'Text' => $alt,                           'icon' => '',                     'iconposition' => '',             'Class' => ''),
    'button_in_cart.gif'            => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-shopping-cart',   'iconposition' => 'iconleft',     'Class' => ''),
    'button_login_newsletter.gif'   => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-ok',              'iconposition' => 'iconleft',     'Class' => ''),
    'button_print.gif'              => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-print',           'iconposition' => 'iconleft',     'Class' => ''),
    'button_product_more.gif'       => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-info-sign',       'iconposition' => 'iconleft',     'Class' => ''),
    'button_quick_find.gif'         => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-search',          'iconposition' => 'iconleft',     'Class' => ''),
    'button_redeem.gif'             => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-asterisk',        'iconposition' => 'iconleft',     'Class' => ''),
    'button_search.gif'             => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-search',          'iconposition' => 'iconleft',     'Class' => ''),
    'button_send.gif'               => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-ok',              'iconposition' => 'iconleft',     'Class' => ''),
    'button_login_small.gif'        => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-user',            'iconposition' => 'iconleft',     'Class' => ''),
    'button_update.gif'             => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-refresh',         'iconposition' => 'iconleft',     'Class' => ''),
    'button_update_cart.gif'        => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-refresh',         'iconposition' => 'iconleft',     'Class' => ''),
    'button_view.gif'               => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-eye-open',        'iconposition' => 'iconleft',     'Class' => ''),
    'button_write_review.gif'       => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-edit',            'iconposition' => 'iconleft',     'Class' => ''),
    'small_edit.gif'                => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-edit',            'iconposition' => 'iconleft',     'Class' => ''),
    'small_delete.gif'              => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-remove',          'iconposition' => 'iconright',    'Class' => ''),
    'small_view.gif'                => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-eye-open',        'iconposition' => 'iconright',    'Class' => ''),
    'cart_del.gif'                  => array('Image' => 'cart_del.gif',           'Text' => $alt,                           'icon' => '',                     'iconposition' => '',             'Class' => ''),
    'edit_product.gif'              => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-edit',            'iconposition' => 'iconleft',     'Class' => ''),
    'print.gif'                     => array('Image' => '',                       'Text' => TEXT_PRINT,                     'icon' => 'icon-print',           'iconposition' => 'iconleft',     'Class' => ''),
    'button_goto_cart_gif'          => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-shopping-cart',   'iconposition' => 'iconleft',     'Class' => ''),
    'button_manufactors_info.gif'   => array('Image' => '',                       'Text' => $alt,                           'icon' => 'icon-list-alt',        'iconposition' => 'iconleft',     'Class' => ''),
    );

    if (!array_key_exists($name, $buttons)) {$name = 'default';}
    // kein Submitbutton
    if (!$submit)
    {
      if ($buttons[$name]['Image']) {
        $html .= xtc_image('templates/'.CURRENT_TEMPLATE.'/buttons/' . $_SESSION['language'] . '/'. $buttons[$name]['Image'], $buttons[$name]['Text'], '', '', $parameters);
      } else {
        $html .= '<span class="btn';
        if ($buttons[$name]['Class']) {
          $html .= ' '.$buttons[$name]['Class'].'"';
        }
        if (xtc_not_null($parameters)) {
          $html .= '" '.$parameters.'>';
        } else {
          $html .= '">';
        }
        if  ($buttons[$name]['iconposition'] == 'iconleft') {
          $html .= '<i class="'.$buttons[$name]['icon'].'"></i>&nbsp;'.$buttons[$name]['Text'];
        }
        elseif ($buttons[$name]['iconposition'] == 'iconright') {
          $html .= $buttons[$name]['Text'].'&nbsp;<i class="'.$buttons[$name]['icon'].'"></i>';
        } 
        else {
          $html .= $buttons[$name]['Text'];
        }
        $html .= '</span>';
      } 
    }

    // wenn Submitbutton
    if ($submit) 
    {
      $html .= '<button class="btn';
      if ($buttons[$name]['Class']) {
        $html .= ' '.$buttons[$name]['Class'].'"';
      } else {
        $html .= '"';
      }
      if ($submit <> true) {
        $html .= ' name="'.$submit.'"';
      }
      if ($submit == true || $submit == "submit"){
        $html .= ' type="submit"';
      }
      $html .= ' title="'.$title.'"'.$parameters.'>';
      if  ($buttons[$name]['iconposition'] == 'iconleft') {
        $html .= '<i class="'.$buttons[$name]['icon'].'"></i>&nbsp;'.$buttons[$name]['Text'];
      }
      elseif ($buttons[$name]['iconposition'] == 'iconright') {
        $html .= $buttons[$name]['Text'].'&nbsp;<i class="'.$buttons[$name]['icon'].'"></i>';
      }
      else {
        $html .= $buttons[$name]['Text'];
      }
      $html .= '</button>';
    }

    return $html;

    } else {    
      return xtc_image('templates/'.CURRENT_TEMPLATE.'/buttons/' . $_SESSION['language'] . '/'. $image, $alt, '', '', $parameters);
    }
  }
 ?>