<?php
/* -----------------------------------------------------------------------------------------
   $Id$

   modified eCommerce Shopsoftware
   http://www.modified-shop.org

   Copyright (c) 2009 - 2013 [www.modified-shop.org]
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/
  
  require_once(DIR_FS_EXTERNAL.'paypal/classes/PayPalPayment.php');
  $paypal_cart = new PayPalPayment('paypalcart');
  if ($paypal_cart->enabled === true
      && $paypal_cart->get_config('MODULE_PAYMENT_'.strtoupper($paypal_cart->code).'_SHOW_PRODUCT') == '1'
      ) 
  {
    $info_smarty->assign('ADD_CART_BUTTON_PAYPAL', $paypal_cart->product_checkout_button());
  }

  $paypal_installment = new PayPalPayment('paypalinstallment');

  require_once (DIR_FS_INC.'xtc_get_countries.inc.php');
  $country = xtc_get_countriesList(((isset($_SESSION['country'])) ? $_SESSION['country'] : ((isset($_SESSION['customer_country_id'])) ? $_SESSION['customer_country_id'] : STORE_COUNTRY)), true);
  
  if ($paypal_installment->enabled === true
      && $country['countries_iso_code_2'] == 'DE'
      ) 
  {
    $amount = $xtPrice->xtcGetPrice($product->data['products_id'], false, 1, $product->data['products_tax_class_id'], $product->data['products_price']); 
    $presentment = $paypal_installment->get_presentment_details($amount, $_SESSION['currency'], $country['countries_iso_code_2'], 'product', true);
    $info_smarty->assign('PAYPAL_INSTALLMENT', $presentment);
  }
?>