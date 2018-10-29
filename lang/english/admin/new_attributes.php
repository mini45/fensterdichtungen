<?php
/* --------------------------------------------------------------
   $Id: new_attributes.php 899 2005-04-29 02:40:57Z hhgag $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on:
   (c) 2002-2003 osCommerce coding standards www.oscommerce.com

   Released under the GNU General Public License
   --------------------------------------------------------------*/

   define('SORT_ORDER','Sort order');
   define('ATTR_MODEL','Attribute Model');
   define('ATTR_STOCK','Stock');
   define('ATTR_WEIGHT','Value Weight');
   define('ATTR_PREFIXWEIGHT','Weight Prefix');
   define('ATTR_PRICE','Value Price');
   define('ATTR_PREFIXPRICE','Price Prefix');
   define('DL_COUNT','Count:');
   define('DL_EXPIRE','Expire:');
   define('TITLE_EDIT','Edit Attributes ');
   define('TITLE_UPDATED','Product Attributes Updated.');
   define('SELECT_PRODUCT','Please select a product to edit:');
   define('SELECT_COPY','Please select a product to copy attributes from:');

// BOF - Tomcraft - 2009-11-11 - NEW SORT SELECTION
   define('TEXT_OPTION_ID', 'Option ID');
   define('TEXT_OPTION_NAME', 'Option Name');
   define('TEXT_SORTORDER', 'Sorting');
// EOF - Tomcraft - 2009-11-11 - NEW SORT SELECTION

  define('ATTR_EAN', 'EAN No.');
  
  /* BOF AGI GOOGLE-XML-EXPORT www.andreas-guder.de 1/1 */
  define('ATTR_VPE_VALUE', 'VPE-value');
  define('ATTR_VPE_VALUE_DESCRIPTION', 'How many units will fill this attribute? (Example: unit given at the product is 100ml, Size of this attribute is 500ml; input value of this field is 5) Leave the field empty if the unit is not relevant.');
  /* EOF AGI GOOGLE-XML-EXPORT www.andreas-guder.de 1/1 */
?>