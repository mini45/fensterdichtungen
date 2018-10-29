<?php
/* export/google_xml.php
.---------------------------------------------------------------------------.
|    Software: GOOGLE-Shopping XML-Export for modified-shops and xt:c 3     |
|      Author: Andreas Guder                                                |
|     Version: 2.4                                                          |
|     Contact: info@andreas-guder.de / http://www.andreas-guder.de          |
| Copyright (c) 2014, Andreas Guder [info@andreas-guder.de]                 |
|               GNU General Public License  (Version 2)                     |
'--------------------------------------------------------------------------ö'
2.1: Versandkosten für mehrere Länder möglich
2.2: Preisangabe an Google-Forderungen angepasst
2.4: Übergabe der Variations-Parameter an der URL, Währungsparameter an URL angefügt
*/
require '../includes/configure.php';
if (function_exists('date_default_timezone_set'))
  date_default_timezone_set('Europe/Berlin');
error_reporting(E_ALL ^E_DEPRECATED ^E_NOTICE ^E_STRICT);
$cache_days       = 1; // number of days, the xml-file will be cached before 
$export_language  = 2; // GET['lang'] language-id to export
$export_group     = 1; // GET['group'] customers-group
$limit_page       = 0; // GET['page'] number of page to export, empty or not set to export the whole database 
$country_id       = 0; // GET['country'] country-id, will be shop-country-id if empty
$zone_id          = 0; // GET['zone'] zone-id, will be shop-zone-id if empty
$currency         = 'EUR'; // GET['curr'] curency-code, will be DEFAULT_CURRENCY if empty
$add_shipping     = 0; // GET['add_shipping'], add this price/100 to shipping-costs
$export_hersteller= 0; // GET['hersteller'] // Hersteller

define('LN',chr(10));

if (isset($_GET['lang']) && !empty($_GET['lang']))
  $export_language = (int) $_GET['lang'];
  
if (isset($_GET['group']) && !empty($_GET['group']))
  $export_group = (int) $_GET['group'];

if (isset($_GET['page']) && !empty($_GET['page']))
  $limit_page = (int) $_GET['page'];
  
if (isset($_GET['cache']))
  $cache_days = (int) $_GET['cache'];
  
if (isset($_GET['country']))
  $country_id = (int) $_GET['country'];
  
if (isset($_GET['curr']))
  $currency = $_GET['curr'];

if (isset($_GET['zone']))
  $zone_id = (int) $_GET['zone'];
  
if (isset($_GET['add_shipping']))
  $add_shipping = (int) $_GET['add_shipping'];
define('ADD_SHIPPING_COSTS', $add_shipping/100);
if (!defined('SQL_CACHEDIR'))
  define('SQL_CACHEDIR', DIR_FS_CATALOG.'cache/');
  
if (isset($_GET['hersteller']) && !empty($_GET['hersteller']))
{
  $export_hersteller = preg_match('/^\d[0-9,]+$/', $_GET['hersteller']) ? (string)$_GET['hersteller'] : '';
}
$s_string_hersteller = empty($export_hersteller) ? '' : '_m'.str_replace(',','-',$export_hersteller); // Hersteller

$xml_file_name = 'google_xml';
$xml_file_name .= '_l'.$export_language;
$xml_file_name .= '_g'.$export_group;
$xml_file_name .= '_p'.$limit_page;
$xml_file_name .= '_'.$country_id.$zone_id;
$xml_file_name .= '_'.$currency;
$xml_file_name .= '_s'.$add_shipping;
$xml_file_name .= $s_string_hersteller;

// load functions
require DIR_WS_INCLUDES.'database_tables.php';
require DIR_WS_INCLUDES.'filenames.php';

// require some functions anc classes
// Database
require_once (DIR_FS_INC.'xtc_db_connect.inc.php');
require_once (DIR_FS_INC.'xtc_db_close.inc.php');
require_once (DIR_FS_INC.'xtc_db_error.inc.php');
require_once (DIR_FS_INC.'xtc_db_perform.inc.php');
require_once (DIR_FS_INC.'xtc_db_query.inc.php');
require_once (DIR_FS_INC.'xtc_db_queryCached.inc.php');
require_once (DIR_FS_INC.'xtc_db_fetch_array.inc.php');
require_once (DIR_FS_INC.'xtc_db_num_rows.inc.php');
require_once (DIR_FS_INC.'xtc_db_data_seek.inc.php');
require_once (DIR_FS_INC.'xtc_db_insert_id.inc.php');
require_once (DIR_FS_INC.'xtc_db_free_result.inc.php');
require_once (DIR_FS_INC.'xtc_db_fetch_fields.inc.php');
require_once (DIR_FS_INC.'xtc_db_output.inc.php');
require_once (DIR_FS_INC.'xtc_db_input.inc.php');
require_once (DIR_FS_INC.'xtc_db_prepare_input.inc.php');
require_once (DIR_FS_INC.'xtc_get_top_level_domain.inc.php');
require_once (DIR_FS_INC.'xtc_href_link.inc.php');
require_once (DIR_FS_INC.'xtc_product_link.inc.php');
require_once (DIR_FS_INC.'xtc_category_link.inc.php');
require_once (DIR_FS_INC.'xtc_get_category_path.inc.php');
require_once (DIR_FS_INC.'xtc_get_parent_categories.inc.php');
require_once (DIR_FS_INC.'xtc_image.inc.php');
require_once (DIR_FS_INC.'xtc_get_tax_rate.inc.php');
require_once (DIR_FS_INC.'xtc_add_tax.inc.php');
require_once (DIR_FS_INC.'xtc_cleanName.inc.php');
require_once (DIR_FS_INC.'xtc_get_products_mo_images.inc.php');
require_once (DIR_FS_INC.'xtc_set_time_limit.inc.php');
require_once (DIR_FS_INC.'xtc_parse_category_path.inc.php');
require_once (DIR_FS_INC.'xtc_get_product_path.inc.php');
@xtc_set_time_limit(0);

// old functions
function xtDBquery($query) {
	if (strtolower(DB_CACHE) == 'true') {
//			echo  'cached query: '.$query.'<br />';
		$result = xtc_db_queryCached($query);
	} else {
//				echo '::$'.$query .'<br />';
		$result = xtc_db_query($query);

	}
	return $result;
}

// make a connection to the database... now
$connection = xtc_db_connect() or die('Unable to connect to database server!');
// load configuration
$configuration_query = xtc_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from '.TABLE_CONFIGURATION);
while ($configuration = xtc_db_fetch_array($configuration_query)) {
	define($configuration['cfgKey'], $configuration['cfgValue']);
}

if (!defined('MODULE_AGI_GOOGLE_XML_STATUS') || strtolower(MODULE_AGI_GOOGLE_XML_STATUS) != 'true')
{
  header("HTTP/1.0 403 Forbidden");
  exit;
}

$xml_file_name .= strtolower(MODULE_AGI_GOOGLE_XML_IS_GZIP) == 'true' ? '.xml.gz' : '.xml';
define('CACHED_GOOGLE_FILE', DIR_FS_CATALOG.'export/'.$xml_file_name);


// check cache
if ($cache_days > 0)
{
  if (file_exists(CACHED_GOOGLE_FILE))
  {
    if (time()-filemtime(CACHED_GOOGLE_FILE) < $cache_days * 24 * 3600 - 3600)
    {
      if (isset($_GET['out']) && $_GET['out']=='false')
        exit;
      // print out cached file
      header("Content-Type: text/xml");
      if (strtolower(MODULE_AGI_GOOGLE_XML_IS_GZIP) == 'true')
        header("Content-Encoding: gzip");
      echo file_get_contents(CACHED_GOOGLE_FILE);
      exit;
    }
  }
}
session_start();
$_SESSION['languages_id'] = $export_language;


// some defines
if (!defined('MODULE_AGI_GOOGLE_CHECK_GRADUATED_PRICE'))
  define('MODULE_AGI_GOOGLE_CHECK_GRADUATED_PRICE', 'FALSE');
if (!defined('MODULE_AGI_GOOGLE_IGNORE_FREESHIPPING_MODULES'))
  define('MODULE_AGI_GOOGLE_IGNORE_FREESHIPPING_MODULES', 'FALSE');
if (!defined('MODULE_AGI_GOOGLE_XML_SHOP_IS_UTF8'))
  define('MODULE_AGI_GOOGLE_XML_SHOP_IS_UTF8', 'FALSE');
if (!defined('MODULE_AGI_GOOGLE_XML_FEED_NB_ARTICLE'))
  define('MODULE_AGI_GOOGLE_XML_FEED_NB_ARTICLE', 5000);

$tmp_bluegate = false;
if (defined('MODULE_BLUEGATE_SEO_INDEX_STATUS') && file_exists(DIR_FS_CATALOG.'inc/bluegate_seo.inc.php'))
{
  if (strtolower(MODULE_BLUEGATE_SEO_INDEX_STATUS) == 'true')
  {
    require_once(DIR_FS_CATALOG.'inc/bluegate_seo.inc.php');
    $bluegateSeo = new BluegateSeo();
    $tmp_bluegate = true;
  }
}
define('USE_BLUEGATE_SEO_URL',$tmp_bluegate);

class SHOP_CONFIG
{
  private static $language_id = 2;
  private static $country_id  = 0;
  private static $customers_group = 1;
  private static $language_code = 'de';
  private static $country_code  = 'DE';
  private static $zone_id   = 0;
  private static $utf8_shop = false;
  private static $default_google_category = '';
  private static $bluegateSeo = null;
  private static $currency_to_link = false;
  
  /* Arrays */
  private static $currency = array();
  private static $ignor_vpe_values = array();
  private static $assing_vpe_values= array();
  private static $assign_words_gender = array('male'=>array(),'female'=>array(),'unisex'=>array());
  private static $assign_words_age_group = array('kids'=>array(),'adult'=>array(),'newborn'=>array(),'infant'=>array(),'toddler'=>array());
  private static $shop_categories = array();
  private static $shipping_status = array();
  private static $manufacturer    = array();
  private static $shipping_value_table = array();
  private static $vpe_data       = array();
  private static $customers_permissions = array();
  private static $tax_rates      = array();
  
  private static $google_attribute_options = array();
  private static $google_attribute_options_ids = array();
  private static $google_attribute_options_ids_name = array();
  
  public function __construct($currency, $country = 0, $zone_id = 0, $export_language = 2, $customers_group = 1)
  {
    settype($export_language, 'int');
    settype($country, 'int');
    settype($zone_id, 'int');
    settype($customers_group, 'int');
    
    if (empty($country_id))
      $country_id = STORE_COUNTRY;
    if (empty($zone_id))
      $zone_id = STORE_ZONE;
    
    self::$utf8_shop = strtolower(MODULE_AGI_GOOGLE_XML_SHOP_IS_UTF8) == 'true' ? true : false;
    
    $q = xtc_db_query("SELECT * FROM `" . TABLE_LANGUAGES . "` WHERE `languages_id`=$export_language");
    $q_result = xtc_db_fetch_array($q);
    if ($q_result)
    {
      self::$language_id = $q_result['languages_id'];
      self::$language_code = strtolower($q_result['code']);
    }
    
    // get customers_status
    $c_check = xtc_db_query("SELECT * FROM `".TABLE_CUSTOMERS_STATUS."` WHERE `customers_status_id`=$customers_group AND `language_id`=$export_language");
    if (xtc_db_num_rows($c_check) == 0)
      $c_check = xtc_db_query("SELECT * FROM `".TABLE_CUSTOMERS_STATUS."` WHERE `customers_status_id`=1 AND `language_id`=1");
    self::$customers_permissions = xtc_db_fetch_array($c_check);
    self::$customers_group = self::$customers_permissions['customers_status_id'];
    
    // load country-code
    $query = xtc_db_query("SELECT `countries_iso_code_2` FROM `".TABLE_COUNTRIES."` WHERE `countries_id`=$country LIMIT 0,1");
    $tmp = xtc_db_fetch_array($query);
    if (!empty($tmp))
    {
      self::$country_code = $tmp['countries_iso_code_2'];
      self::$country_id   = $country;
    }
    else
    {
      $query = xtc_db_query("SELECT `countries_iso_code_2` FROM `".TABLE_COUNTRIES."` WHERE `countries_id`=".STORE_COUNTRY." LIMIT 0,1");
      $tmp = xtc_db_fetch_array($query);
      self::$country_code = $tmp['countries_iso_code_2'];
      self::$country_id   = STORE_COUNTRY;
    }
    
    // load shop-zone
    if (empty($zone_id) && !empty($country_id))
    {
      $tmp = xtc_db_query("SELECT `zone_id` FROM `".TABLE_ZONES."` WHERE `zone_country_id`=$country_id LIMIT 0,1");
      $tmp = xtc_db_fetch_array($tmp);
      $zone_id = $tmp['zone_id'];
    }
    self::$zone_id = $zone_id;

    // load currency-information
    self::$currency = array('SYMBOL_LEFT'=>'', 'SYMBOL_RIGHT'=>'', 'DECIMAL_POINT'=>'', 'THOUSANDS_POINT'=>'', 'DECIMAL_PLACES'=>2, 'VALUE'=>1, 'CODE'=>'');
    $query = xtc_db_query("SELECT * FROM `".TABLE_CURRENCIES."` WHERE `code`='$currency' LIMIT 0,1");
    $tmp = xtc_db_fetch_array($query);
    if (empty($tmp))
    {
      $query = xtc_db_query("SELECT * FROM `".TABLE_CURRENCIES."` WHERE `code`='".DEFAULT_CURRENCY."' LIMIT 0,1");
      $tmp = xtc_db_fetch_array($query);
    }
    if (!empty($tmp))
    {
      self::$currency = array(
        'SYMBOL_LEFT'     => $tmp['symbol_left'],
        'SYMBOL_RIGHT'    => $tmp['symbol_right'],
        'DECIMAL_POINT'   => $tmp['decimal_point'],
        'THOUSANDS_POINT' => $tmp['thousands_point'],
        'DECIMAL_PLACES'  => $tmp['decimal_places'],
        'VALUE'           => $tmp['value'],
        'CODE'            => $tmp['code']
      );
    }
    if (strtolower(DEFAULT_CURRENCY) != strtolower(self::$currency['CODE']) && !empty(self::$currency['CODE']))
      self::$currency_to_link = true;
    $this->prepare_language_containing_constants();
    
    self::$shop_categories[0] = array('parent'=>0, 'name'=>'Top', 'google'=>self::$default_google_category);
    // load shop_categories
    $q = "SELECT c.categories_id, c.parent_id, cd.categories_name, IFNULL(cda.google_category,'') AS google_category FROM
      `" . TABLE_CATEGORIES . "` AS c
      LEFT JOIN `" . TABLE_CATEGORIES_DESCRIPTION . "` AS cd ON cd.categories_id=c.categories_id AND cd.language_id=".self::$language_id."
      LEFT JOIN `" . TABLE_AGI_CATEGORIES_DESCRIPTION_ADD . "` AS cda ON cda.categories_id=c.categories_id AND cda.language_id=".self::$language_id;
    $q_result = xtc_db_query($q);
    while ($row = xtc_db_fetch_array($q_result))
    {
      self::$shop_categories[$row['categories_id']] = array(
        'parent'    => $row['parent_id'], 
        'name'      => $row['categories_name'], 
        'name_html' => str_replace('&', '&amp;', $row['categories_name']),
        'google'    => $row['google_category']
      );
    }
    // load shipping-status
    $q = "SELECT `shipping_status_id` AS data_id, `google_status_name` AS data_name FROM `" . TABLE_SHIPPING_STATUS . "` WHERE `language_id`=".self::$language_id;
    self::$shipping_status = $this->load_db_table_fields($q);
    
    // load vpe-names
    $q = "SELECT `products_vpe_id`, `products_vpe_name` FROM `" . TABLE_PRODUCTS_VPE . "` WHERE `language_id`=".self::$language_id;
    $result = array();
    $q_result = xtc_db_query($q);
    while ($row = xtc_db_fetch_array($q_result))
    {
      $t = $this->explode_vpe_parts($row['products_vpe_name']);
      self::$vpe_data[$row['products_vpe_id']] = array('name'=>$row['products_vpe_name'], 'unit'=>$t['unit'], 'value'=>$t['value']);
    }
    
    // load manufacturers name
    $q = "SELECT `manufacturers_id` AS data_id, `manufacturers_name` AS data_name FROM `".TABLE_MANUFACTURERS."`";
    self::$manufacturer = $this->load_db_table_fields($q);
      
    // load google_attributes
    $q = "SELECT `products_options_id`, `is_google_attribute` FROM `".TABLE_PRODUCTS_OPTIONS."` WHERE `language_id` = ".self::$language_id." AND `is_google_attribute` != ''";
    $q_result = xtc_db_query($q);
    while ( $row = xtc_db_fetch_array($q_result) )
    {
      if (!array_key_exists($row['is_google_attribute'], self::$google_attribute_options_ids_name))
        self::$google_attribute_options_ids_name[$row['is_google_attribute']] = array();
      self::$google_attribute_options_ids_name[$row['is_google_attribute']][] = $row['products_options_id'];
      self::$google_attribute_options_ids[] = $row['products_options_id'];
      self::$google_attribute_options[$row['products_options_id']] = $row['is_google_attribute'];
    }
    
    $t = trim(MODULE_AGI_GOOGLE_XML_SHIPPING_LIST);
    /* 2.1 verschiedene Länder */
    if (!empty($t))
    {
      $shippingTable = array();
      $tex = explode(';', $t);
      foreach ($tex as $row)
      {
        $tmp = explode('::', $row);
        if (count($tmp) == 2)
        {
          if (strtolower($tmp[0]) == strtolower(self::$country_code))
          {
            $shippingTable = preg_split("/[:,]/" , $tmp[1]);
            break;
          }
        }
        elseif (count($tmp) == 1)
        {
          $shippingTable = preg_split("/[:,]/" , $tmp[0]);
          break;
        }
      }
      if (empty($shippingTable))
      {
        $tmp = explode('::', $tex[0]);
        if (count($tmp) == 2)
          $shippingTable = preg_split("/[:,]/" , $tmp[1]);
        elseif (count($tmp) == 1)
          $shippingTable = preg_split("/[:,]/" , $tmp[0]);
        else
          $shippingTable = array();
      }
      self::$shipping_value_table = $shippingTable;
    }
    else
      self::$shipping_value_table = array();
    
    if (USE_BLUEGATE_SEO_URL)
      self::$bluegateSeo = new BluegateSeo();
  }
  
  /**
   * constructor called function
   */
  private function prepare_language_containing_constants()
  {
    $t = $this->split_language_containing_string(MODULE_AGI_GOOGLE_XML_DEFAULT_CATEGORY);
    self::$default_google_category = !empty($t) ? current($t) : '';
    
    self::$assign_words_gender['male']      = $this->split_language_containing_string(MODULE_AGI_GOOGLE_XML_GENDER_WORDS_MALE);
    self::$assign_words_gender['female']    = $this->split_language_containing_string(MODULE_AGI_GOOGLE_XML_GENDER_WORDS_FEMALE);
    self::$assign_words_gender['unisex']    = $this->split_language_containing_string(MODULE_AGI_GOOGLE_XML_GENDER_WORDS_UNISEX);
    self::$assign_words_age_group['kids']   = $this->split_language_containing_string(MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_KIDS);
    self::$assign_words_age_group['adult']  = $this->split_language_containing_string(MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_ADULT);
    self::$assign_words_age_group['newborn']= $this->split_language_containing_string(MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_NEWBORN);
    self::$assign_words_age_group['infant'] = $this->split_language_containing_string(MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_INFANT);
    self::$assign_words_age_group['toddler']= $this->split_language_containing_string(MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_TODDLER);
    $t = $this->split_language_containing_string(MODULE_AGI_GOOGLE_XML_IGNORE_VPE_VALUES);
    while ( list($key, $value) = each($t) )
      self::$ignor_vpe_values[$key] = strtolower($value);
    
    $t = $this->split_language_containing_string(MODULE_AGI_GOOGLE_XML_VPE_VALUES);
    $t_result = array();
    foreach ($t as $row)
    {
      $t1 = explode('=', $row);
      if (count($t1) == 2)
      {
        while ( list($key, $value) = each($t1) )
          $t2[$key] = trim($value);
        $t1 = $t2;
        $t_result[strtolower($t1[0])] = $t1[1];
      }
    }
    self::$assing_vpe_values = $t_result;
  }
  
  /**
   * constructor called function
   * @param string $q
   * @return array();
   */
  private function load_db_table_fields($q = '')
  {
    if (empty($q))
      return array();
    $result = array();
    $q_result = xtc_db_query($q);
    while ($row = xtc_db_fetch_array($q_result))
      $result[$row['data_id']] = $row['data_name'];
    return $result;
  }
  
  private function explode_vpe_parts($vpe_text)
  {
    $vpe_parts = array('value' => 1, 'unit' => '');
    if (preg_match('/^[0-9]{1,}/', $vpe_text, $matches))
    {
      $vpe_parts['value'] = $matches[0];
      $vpe_parts['unit'] = trim(substr($vpe_text, strlen($vpe_parts['value'])));
    }
    else
      $vpe_parts['unit'] = trim($vpe_text);
    settype($vpe_parts['value'], 'integer');
    return $vpe_parts;
  }
  
  /**
   * @param string eq: 2stelligerSprachcode:Wert1,Wert2;2stelligerSprachcode:Wert1,Wert2
   * @return array with values for export-language
   */
  private function split_language_containing_string($string)
  {
    $string = html_entity_decode(trim($string), ENT_COMPAT, self::$utf8_shop ? 'UTF-8' : 'ISO-8859-15');
    if (empty($string))
      return array();
    
    $l_array = explode(';', $string);
    $all_results = array();
    $l_data = array();
    foreach ($l_array as $l_row)
    {
      $l_row = trim($l_row);
      if (strpos($l_row, ':') !== FALSE)
      {
        $t = explode(':', $l_row);
        $l_data[strtolower(trim($t[0]))] = trim($t[1]);
      }
      else
        $l_data[self::$language_code] = $l_row;
    }
    
    foreach ($l_data as $l_code => $l_values)
    {
      $t = explode(',', $l_values);
      while ( list($key, $value) = each($t) )
          $t2[$key] = trim($value);
        $t = $t2;
      $all_results[$l_code] = $t;
    }
    if (empty($all_results))
      return array();
    else
      return array_key_exists(self::$language_code, $all_results) ? $all_results[self::$language_code] : current($all_results);
  }
  
  public static function get_language_id()
  {
    return self::$language_id;
  }
  public static function get_country_id()
  {
    return self::$country_id;
  }
  public static function get_zone_id()
  {
    return self::$zone_id;
  }
  public static function get_customers_group()
  {
    return self::$customers_group;
  }
  public static function get_language_code()
  {
    return self::$language_code;
  }
  public static function get_country_code()
  {
    return self::$country_code;
  }
  public static function get_default_google_category()
  {
    return self::$default_google_category;
  }
  public static function get_shop_categories()
  {
    return self::$shop_categories;
  }
  public static function get_shipping_value_table()
  {
    return self::$shipping_value_table;
  }
  public static function get_google_attribute_options()
  {
    return self::$google_attribute_options;
  }
  public static function get_google_attribute_options_ids()
  {
    return self::$google_attribute_options_ids;
  }
  public static function get_google_attribute_options_ids_name()
  {
    return self::$google_attribute_options_ids_name;
  }
  public static function get_tax_rate($tax_id)
  {
    settype($tax_id, 'int');
    if (!array_key_exists($tax_id, self::$tax_rates))
      self::$tax_rates[$tax_id] = xtc_get_tax_rate($tax_id, self::$country_id, self::$zone_id);
    return self::$tax_rates[$tax_id];
  }
  public static function get_google_shipping_status($sID = 0)
  {
    settype($sID, 'int');
    $result = '';
    if (array_key_exists($sID, self::$shipping_status))
      $result = !empty(self::$shipping_status[$sID]) ? self::$shipping_status[$sID] : '';
    return empty($result) ? 'in stock' : $result;
  }
  public static function get_manufacturers_name($mID = 0)
  {
    settype($mID, 'int');
    $result = '';
    if (array_key_exists($mID, self::$manufacturer))
      $result = !empty(self::$manufacturer[$mID]) ? self::$manufacturer[$mID] : '';
    return $result;
  }
  
  public static function get_categories_data($cID = 0)
  {
    settype($cID, 'int');
    $result = array('name'=>'', 'path'=>'', 'path_html'=>'', 'google'=>'');
    if (array_key_exists($cID, self::$shop_categories))
    {
      $result['name']   = self::$shop_categories[$cID]['name'];
      $result['google'] = self::$shop_categories[$cID]['google'];
      $t_path = array(self::$shop_categories[$cID]['name']);
      $t_path_html = array(self::$shop_categories[$cID]['name_html']);
      $next = self::$shop_categories[$cID]['parent'];
      while ($next > 0)
      {
        $t_path[] = self::$shop_categories[$next]['name'];
        $t_path_html[] = self::$shop_categories[$next]['name_html'];
        if (empty($result['google']))
          $result['google'] = self::$shop_categories[$next]['google'];
        $next = self::$shop_categories[$next]['parent'];
      }
      $t_path = array_reverse($t_path);
      $t_path_html = array_reverse($t_path_html);
      $result['path'] = implode(' > ', $t_path);
      $result['path_html'] = implode(' > ', $t_path_html);
    }
    return $result;
  }
  public static function get_currency_value($value)
  {
    return array_key_exists($value, self::$currency) ? self::$currency[$value] : null;
  }
  public static function get_vpe_data($vID = 0, $field = 'name')
  {
    settype($vID, 'int');
    if (!in_array($field, array('name', 'unit', 'value')))
      return false;
    $result = array();
    if (array_key_exists($vID, self::$vpe_data))
      $result = !empty(self::$vpe_data[$vID]) ? self::$vpe_data[$vID] : array();
    return $result[$field];
  }
  public static function is_utf8_shop()
  {
    return self::$utf8_shop;
  }
  public static function is_currency_to_url()
  {
    return self::$currency_to_link;
  }

  public static function is_ignored_vpe_unit($value)
  {
    return in_array(strtolower($value), self::$ignor_vpe_values) ? true : false;
  }
  
  public static function is_assigned_word($assign_to = 'gender', $field, $word)
  {
    if (empty($word))
      return false;
    switch ($assign_to)
    {
      case 'gender':
        $assign_array = self::$assign_words_gender;
        break;
      case 'age_group':
        $assign_array = self::$assign_words_age_group;
        break;
      default:
        return false;
    }
    if (!array_key_exists($field, $assign_array))
      return false;
    return in_array(strtolower($word), $assign_array[$field]) ? true : false;
  }
  public static function replace_vpe_unit($unit = '')
  {
    return array_key_exists(strtolower($unit), self::$assing_vpe_values) ? self::$assing_vpe_values[strtolower($unit)] : $unit;
  }

  public static function get_customers_permissions($field)
  {
    if (!array_key_exists($field, self::$customers_permissions))
      return '';
    else
      return self::$customers_permissions[$field];
  }
  public static function get_google_attribute_option($value)
  {
    return array_key_exists($value, self::$google_attribute_options) ? self::$google_attribute_options[$value] : '';
  }
  
  public static function set_google_attribute_options($value)
  {
    if (!empty($value))
      self::$google_attribute_options[$value] = $value;
  }
  
  public static function calculate_price($price = 0, $format = true)
  {
    $price *= self::get_currency_value('VALUE');
    $price = round($price,2);
    if ($format)
    {
      $string = '';
      $string .= number_format(
        $price, 
        self::get_currency_value('DECIMAL_PLACES'), 
        self::get_currency_value('DECIMAL_POINT'), 
        self::get_currency_value('THOUSANDS_POINT')
      );
      if (self::get_currency_value('CODE') != '')
        $string .= ' '.self::get_currency_value('CODE');
      $price = $string;
    }
    return $price;
  }
  public static function get_blueGateSEOLink($xtc_link, $ssl, $lang)
  {
    return self::$bluegateSeo->getProductLink($xtc_link, $ssl, $lang);
  }
}

class FEED_BUILDER
{
  /**
   * @param language_id
   */
  public function __construct()
  {
    // empty
  }
  
  public function start_feed()
  {
    echo '<?xml version="1.0" encoding="UTF-8"?>'.LN;
    echo '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">'.LN;
    echo '<channel>',LN;
  }
  public function end_feed()
  {
    echo '</channel>',LN;
    echo '</rss>';
  }
  
  public function clean_html_to_text($text, $short = 0)
  {
    $find     = array('</p>', '<br />', '<li />', '>');
    $replace  = array('</p>'.chr(10), '<br />'.chr(10), '</li>'.chr(10), '> ');
    $text = str_replace($find, $replace, $text);
    $cleared_text = strip_tags($text);
    $cleared_text = html_entity_decode($cleared_text,ENT_QUOTES, SHOP_CONFIG::is_utf8_shop() ? 'UTF-8' : 'ISO-8859-15');
    $cleared_text = str_replace("&nbsp;"," ",$cleared_text);
    $cleared_text = str_replace("'",", ",$cleared_text);
    $cleared_text = str_replace("\n"," ",$cleared_text);
    $cleared_text = str_replace("\r"," ",$cleared_text);
    $cleared_text = str_replace("\t"," ",$cleared_text);
    $cleared_text = str_replace("\v"," ",$cleared_text);
    $cleared_text = str_replace("|",",",$cleared_text);
    $cleared_text = preg_replace("/ {2,}/"," ",$cleared_text);
    if ($short > 0)
    {
      $shorten = wordwrap($cleared_text, $short, "|");
      $shorten = explode("|", $shorten);
      $cleared_text = $shorten[0];
    }
    
    $cleared_text = trim($cleared_text);
    return $cleared_text;
  }
  
  public function short_string($string, $maxlength)
  {
    if (strlen($string) <= $maxlength)
      return $string;
    $shorten = wordwrap($string, $maxlength, "||");
    $shorten = explode("||", $shorten);
    return $shorten[0];
  }
  
  public function print_out_xml_item($key, $value, $maxlength = null)
  {
    if (is_string($value) && (strtolower($value) != 'true' && strtolower($value) != 'false'))
    {
      if (!SHOP_CONFIG::is_utf8_shop())
      {
        if (function_exists('mb_convert_encoding'))
          echo '<',$key,'><![CDATA[',mb_convert_encoding($maxlength ? $this->short_string($value, $maxlength) : $value, 'UTF-8', 'ISO-8859-15'),']]></',$key,'>',LN;
        else
          echo '<',$key,'><![CDATA[',utf8_encode($maxlength ? $this->short_string($value, $maxlength) : $value),']]></',$key,'>',LN;
      }
      else
        echo '<',$key,'><![CDATA[',($maxlength ? $this->short_string($value, $maxlength) : $value),']]></',$key,'>',LN;
    }
    else
      echo '<',$key,'>',$value,'</',$key,'>',LN;
  }
  
}

class PRODUCT_ITEM extends FEED_BUILDER
{
  private $products_id = 0;
  private $products_discount = 0;
  private $product_data_raw = array();
  private $product_data_use = array();
  private $product_images = array();
  private $product_attribute_images = array();
  private $cartesian_attributes = array();
  
  private $overwrite_attributes = array();
  private $my_google_attribute_options_ids = array();
  private $my_google_attribute_options_ids_name = array();
  private $max_overwrite_attributes = 1;
  private $my_attributes_options = array(); // AGI Attribut-Link
  
  public function __construct($product_data)
  {
    $this->products_id = (int) $product_data['products_id'];
    $this->product_data_raw = $product_data;
    $this->product_data_use = $product_data;
    
    $this->overwrite_attributes = array();
    $this->my_google_attribute_options_ids = array();
    $this->my_google_attribute_options_ids_name = array();
  }
  
  /**
   * get a cartesian_product of the given attribute_array
   */
  private function get_cartesian_array($sofar,$arr,$pos,$max)
  {
    $tmp = array_keys($arr);
    for($i = 0; $i < count($arr[$tmp[$pos]]);$i++)
    {
      if($pos == $max)
        $this->cartesian_attributes[] = array_merge($sofar,array($arr[$tmp[$pos]][$i]));
      else
        $this->get_cartesian_array(array_merge($sofar,array($arr[$tmp[$pos]][$i])),$arr,$pos+1,$max);
    }
  }
  
  /**
   * combines all product-attributes (cartesian)
   * @param array
   * @return array
   */
  public function combine_attributes($arr)
  {
    $this->cartesian_attributes = array();
    $this->get_cartesian_array(array(),$arr,0,count($arr)-1);
    return $this->cartesian_attributes;
  }
  
  /**
   * return shipping-cost calculated by given shipping-table
   * @param double products_price
   * @param double products_weight
   * @return double
   */
  public function calculate_shipping_from_table($products_price, $products_weight)
  {
    $shipping = -1;
    $base = (MODULE_AGI_GOOGLE_XML_SHIPPING_BASE == 'weight') ? $products_weight : $products_price;
    if (MODULE_AGI_GOOGLE_XML_SHIPPING_BASE == 'weight' && defined('SHIPPING_BOX_WEIGHT'))
      $base += SHIPPING_BOX_WEIGHT;
    $shipping_value_table = SHOP_CONFIG::get_shipping_value_table();
    for ($i=0; $i<sizeof($shipping_value_table); $i+=2) 
    {
      if ($base <= $shipping_value_table[$i]) 
      {
        $shipping = $shipping_value_table[$i+1];
        break;
      }
    }
    if ($shipping == -1)
      $shipping = 0;
    return $shipping;
  }
  
  public function calculate_shipping()
  {
    // calculate shipping
    $s_price = $this->product_data_use['products_price'];
    if ($this->product_data_use['product_has_special']) 
      $s_price = $this->product_data_use['specials_new_products_price'];
    $shipping = 0;
    if (strtolower(MODULE_AGI_GOOGLE_IGNORE_FREESHIPPING_MODULES) == 'true')
    {
      $shipping = $this->calculate_shipping_from_table($s_price, $this->product_data_use['products_weight']);
      $shipping += ADD_SHIPPING_COSTS;
    }
    else
    {
      // 20150205 check country-code
      if (defined('MODULE_SHIPPING_FREEAMOUNT_AMOUNT') && defined('MODULE_SHIPPING_FREEAMOUNT_STATUS') && strtolower(MODULE_SHIPPING_FREEAMOUNT_STATUS) == 'true' && $s_price >= MODULE_SHIPPING_FREEAMOUNT_AMOUNT && (MODULE_SHIPPING_FREEAMOUNT_ALLOWED == '' || strpos(MODULE_SHIPPING_FREEAMOUNT_ALLOWED, SHOP_CONFIG::get_country_code()) !== FALSE))
        $shipping = 0;
      elseif (defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER') && strtolower(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING) == 'true' && $s_price > MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)
        $shipping = 0;
      else
        $shipping = $this->calculate_shipping_from_table($s_price, $this->product_data_use['products_weight']);
      if ($shipping > 0)
        $shipping += ADD_SHIPPING_COSTS;
    }
    $this->product_data_use['shipping_price'] = $shipping;
  }
  
  public function prepare_product()
  {
    $this->check_special();
    if ($this->set_personal_price() <= 0)
      return false;
    $this->get_category();
    $this->create_link();
    $this->set_condition();
    $this->set_vpe();
    $this->set_brand();
    $this->set_category();
    $this->set_images();
    $this->set_availability();
    $this->set_products_texts();
    $this->calculate_shipping();
    
    $this->prepare_attributes();
    if ($this->attribute_handling()) // returns true, if article has attributes, musnt print out later
      return false;
    return true;
  }
  
  private function get_category()
  {
    $categories = 0;
    $this->product_data_raw['categories_id'] = 0;
    $categorie_query=xtc_db_query("SELECT `categories_id` FROM `".TABLE_PRODUCTS_TO_CATEGORIES."` WHERE `categories_id` > 0 AND `products_id`='".$this->products_id."' LIMIT 0,1");
    $categorie_data=xtc_db_fetch_array($categorie_query);
    if ($categorie_data['categories_id'])
      $this->product_data_raw['categories_id'] = $categorie_data['categories_id'];
    $this->product_data_use['categories_id'] = $this->product_data_raw['categories_id'];
  }
  
  private function check_special()
  {
    if($this->product_data_raw['product_has_special'] && !empty($this->product_data_raw['special_expires_date']))
    {
      $tmp = strtotime($this->product_data_raw['special_expires_date']);
      if ($tmp < time() && $tmp > 0)
        $this->product_data_use['product_has_special'] = 0;
      if ($this->product_data_raw['products_price'] < $this->product_data_raw['specials_new_products_price'])
        $this->product_data_use['product_has_special'] = 0;
    }
  }
  
  private function set_personal_price()
  {
    if (!$this->product_data_raw['product_has_special'])
    {
      if (SHOP_CONFIG::get_customers_permissions('customers_status_graduated_prices') && strtolower(MODULE_AGI_GOOGLE_CHECK_GRADUATED_PRICE) == 'true')
      {
        $offer_check = xtc_db_query("SELECT `personal_offer` FROM `".TABLE_PERSONAL_OFFERS_BY.SHOP_CONFIG::get_customers_group()."` WHERE `products_id`=".$this->products_id." AND `personal_offer`>0 ORDER BY `quantity` DESC LIMIT 0,1");
        if (xtc_db_num_rows($offer_check) == 1)
        {
          $tmp = xtc_db_fetch_array($offer_check);
          if (!empty($tmp['personal_offer']))
          {
            $this->product_data_use['products_price'] = $tmp['personal_offer'];
            $this->product_data_raw['products_price'] = $tmp['personal_offer'];
          }
        }
      }
      else
      {
        $offer_check = xtc_db_query("SELECT `personal_offer` FROM `".TABLE_PERSONAL_OFFERS_BY.SHOP_CONFIG::get_customers_group()."` WHERE `products_id`=".$this->products_id." AND `personal_offer`>0 AND `quantity`=1");
        $tmp = xtc_db_fetch_array($offer_check);
        if (!empty($tmp))
        {
          $this->product_data_use['products_price'] = $tmp['personal_offer'];
          $this->product_data_raw['products_price'] = $tmp['personal_offer'];
        }
      }
    }
    if (SHOP_CONFIG::get_customers_permissions('customers_status_show_price_tax'))
    {
      $this->product_data_use['products_price'] = xtc_add_tax(
        $this->product_data_use['products_price'], 
        SHOP_CONFIG::get_tax_rate($this->product_data_raw['products_tax_class_id'])
      );
      $this->product_data_raw['products_price'] = $this->product_data_use['products_price'];
      $this->product_data_use['specials_new_products_price'] = xtc_add_tax(
        $this->product_data_use['specials_new_products_price'], 
        SHOP_CONFIG::get_tax_rate($this->product_data_raw['products_tax_class_id'])
      );
      $this->product_data_raw['specials_new_products_price'] = $this->product_data_use['specials_new_products_price'];
    }
    $products_discount = 0;
    if (!$this->product_data_raw['product_has_special'])
    {
      if (SHOP_CONFIG::get_customers_permissions('customers_status_discount') <> 0)
        $products_discount = ($this->product_data_raw['products_discount_allowed'] < SHOP_CONFIG::get_customers_permissions('customers_status_discount')) ? $this->product_data_raw['products_discount_allowed'] : SHOP_CONFIG::get_customers_permissions('customers_status_discount');
      if ($products_discount <> 0)
        $this->product_data_use['products_price'] = $this->product_data_use['products_price']*(100-$products_discount)/100;
    }
    $this->products_discount = $products_discount;
    return $this->product_data_use['products_price'];
  }
  
  private function set_condition()
  {
    // check condition
    $condition = 'new';
    if (empty($this->product_data_raw['google_condition']))
    {
      if (!empty($this->product_data_raw['products_zustand']))
      {
        switch ($this->product_data_raw['products_zustand'])
        {
          case 'neu':
          case 'new':
            $condition = 'new';
            break;
          case 'gebraucht':
          case 'used':
            $condition = 'used';
            break;
          case 'erneuert':
          case 'refurbished':
            $condition = 'refurbished';
            break;
          default: $condition = 'new'; break;
        }
      }
    }
    else
      $condition = $this->product_data_raw['google_condition'];
    $this->product_data_use['google_condition'] = $condition;
  }
  
  private function create_link()
  {
    /* BOF AGI Attribut-Link */
    $prid = $this->products_id;
    if (!empty($this->my_attributes_options))
    {
      $attribute = array();
      foreach ($this->my_attributes_options as $key => $value)
        $attribute[] = '{'.$key.'}'.$value;
      if (!empty($attribute))
        $prid .= implode('', $attribute);
    }
    /* EOF AGI Attribut-Link */
    if (USE_BLUEGATE_SEO_URL)
    {
      $this->product_data_use['link'] = SHOP_CONFIG::get_blueGateSEOLink(
        xtc_product_link($prid, $this->product_data_raw['products_name']),'NONSSL', SHOP_CONFIG::get_language_id()
      );
    }
    else
    {
      $pams = array();
      if (DEFAULT_LANGUAGE != SHOP_CONFIG::get_language_code())
        $pams[] = 'language='.SHOP_CONFIG::get_language_code();
      $pams_string = !empty($pams) ? '&'.implode('&',$pams) : '';
      $this->product_data_use['link'] = xtc_href_link(
        FILENAME_PRODUCT_INFO, 
        xtc_product_link($prid, $this->product_data_raw['products_name']).$pams_string,
        'NONSSL',
        false
      );
      $this->product_data_use['link']  = str_replace('&amp;','&',$this->product_data_use['link']);
    }
    if (MODULE_AGI_GOOGLE_XML_MOBILE_LINK == 'PARAMETER')
    {
      $this->product_data_use['google_mobile_link'] = $this->product_data_use['link'];
      if (MODULE_AGI_GOOGLE_XML_MOBILE_LINK_PARAMETER != '')
        $this->product_data_use['google_mobile_link'] .= strpos($this->product_data_use['link'], '?') ? '&'.MODULE_AGI_GOOGLE_XML_MOBILE_LINK_PARAMETER : '?'.MODULE_AGI_GOOGLE_XML_MOBILE_LINK_PARAMETER;
    }
    elseif (MODULE_AGI_GOOGLE_XML_MOBILE_LINK == 'PRODUCT')
    {
      $this->product_data_use['google_mobile_link'] = $this->product_data_raw['google_mobile_link'];
    }
    else
      $this->product_data_use['google_mobile_link'] = '';
    if (MODULE_AGI_GOOGLE_XML_CAMPAIGN != '')
      $this->product_data_use['link'] .= strpos($this->product_data_use['link'], '?') ? '&'.MODULE_AGI_GOOGLE_XML_CAMPAIGN : '?'.MODULE_AGI_GOOGLE_XML_CAMPAIGN;
    if (SHOP_CONFIG::is_currency_to_url())
    {
      $this->product_data_use['link'] .= strpos($this->product_data_use['link'], '?') ? '&' : '?';
      $this->product_data_use['link'] .= 'currency='.SHOP_CONFIG::get_currency_value('CODE');
    }
  }
  
  private function set_vpe()
  {
    if ($this->product_data_raw['products_vpe_status'] == 1 && $this->product_data_raw['products_vpe_value'] != 0.0 && $this->product_data_raw['products_price'] > 0)
    {
      if ($vpe_name = SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe']) && !SHOP_CONFIG::is_ignored_vpe_unit(SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'name')))
      {
        $tmp_price = $this->product_data_use['product_has_special'] ? $this->product_data_use['specials_new_products_price'] : $this->product_data_use['products_price'];
        $vpe_price = SHOP_CONFIG::calculate_price($tmp_price * (1 / $this->product_data_raw['products_vpe_value']), true).' pro '.SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'name');
        $this->product_data_use['vpe'] = $vpe_price;
        
        $tmp = number_format(SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'value')*$this->product_data_raw['products_vpe_value'],3,',','');
        $this->product_data_use['unit_pricing_measure']      = $tmp.' '.SHOP_CONFIG::replace_vpe_unit(SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'unit'));
        $this->product_data_use['unit_pricing_base_measure'] = SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'value').' '.SHOP_CONFIG::replace_vpe_unit(SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'unit'));
      }
      else
        $this->product_data_use['products_vpe_status'] = 0;
    }
  }
  
  private function set_brand()
  {
    $this->product_data_use['brand'] = !empty($this->product_data_use['manufacturers_id']) ? SHOP_CONFIG::get_manufacturers_name($this->product_data_use['manufacturers_id']) : '';
    if (!empty($this->product_data_use['google_products_brand']))
      $this->product_data_use['brand'] = $this->product_data_use['google_products_brand'];
  }
  
  private function set_category()
  {
    $pCategory = SHOP_CONFIG::get_categories_data($this->product_data_use['categories_id']);
    $this->product_data_use['category'] = str_replace('>', '&gt;', $pCategory['path_html']);
    $use_google_category = SHOP_CONFIG::get_default_google_category();
    if (!empty($this->product_data_raw['google_category']))
      $use_google_category = $this->product_data_raw['google_category'];
    elseif (!empty($pCategory['google']))
      $use_google_category = $pCategory['google'];
    $this->product_data_use['google_category'] = str_replace('>', '&gt;', $use_google_category);
  }
  
  private function set_images()
  {
    if (!empty($this->product_data_raw['products_image']))
      $this->product_images[0] = $this->product_data_raw['products_image'];
    $images = xtc_get_products_mo_images($this->products_id);
    if ($images) 
    {
      foreach($images as $image) {
        $this->product_images[$image['image_nr']] = $image['image_name'];
      }
    }
    $this->product_data_use['products_images'] = $this->product_images;
  }
  
  private function get_attributes_images($options_id, $options_values_id)
  {
    if (empty($this->product_attribute_images) || !preg_match('/^[0-9]{1,}$/', $options_id) || !preg_match('/^[0-9]{1,}$/', $options_values_id))
      return array();
    $found_images = array();
    foreach ($this->product_attribute_images as $key => $row)
    {
      if ($row['options_id'] == $options_id && ($row['options_values_id'] == $options_values_id || $row['options_values_id'] == 0))
      {
        if (array_key_exists($key, $this->product_images))
          $found_images[] = $this->product_images[$key];
      }
    }
    return $found_images;
  }
  
  private function load_attribute_images()
  {
    $this->product_attribute_images = array();
    $q = "SELECT * FROM `".TABLE_AGI_PRODUCTS_IMAGES_TO_ATTRIBUTES."` WHERE `products_id`=".$this->products_id." ORDER BY `image_nb`";
    $q_result = xtc_db_query($q);
    while ($row = xtc_db_fetch_array($q_result))
    {
      $this->product_attribute_images[$row['image_nb']] = array('options_id'=>$row['options_id'], 'options_values_id'=>$row['options_values_id']);
    }
  }
  
  private function set_availability($preset = '', $q = null)
  {
    $availability = empty($preset) ? 'in stock' : $preset;
    $quantity = $q !== null ? $q : $this->product_data_use['products_quantity'];
    if (defined('MODULE_AGI_GOOGLE_XML_AVAILABILITY_FROM'))
    {
      if (MODULE_AGI_GOOGLE_XML_AVAILABILITY_FROM == 'QUANTITY')
      {
        if ($quantity <= 0)
          $availability = 'out of stock';
        else
          $availability = 'in stock';
      }
      elseif (MODULE_AGI_GOOGLE_XML_AVAILABILITY_FROM == 'SHIPPING_TIME')
        $availability = SHOP_CONFIG::get_google_shipping_status($this->product_data_use['products_shippingtime']);
    }
    elseif (defined('MODULE_AGI_GOOGLE_XML_AVAILABILITY_FROM_QUANTITY') && strtolower(MODULE_AGI_GOOGLE_XML_AVAILABILITY_FROM_QUANTITY) == 'true')
    {
      if ($quantity <= 0)
        $availability = 'out of stock';
      else
        $availability = 'in stock';
    }
    
    $this->product_data_use['google_availability_status'] = empty($availability) ? 'in stock' : $availability;
    return $this->product_data_use['google_availability_status'];
  }
  
  private function prepare_attributes()
  {
    // get attributes set in product-details
    $this->my_google_attribute_options_ids = SHOP_CONFIG::get_google_attribute_options_ids();
    $this->my_google_attribute_options_ids_name = SHOP_CONFIG::get_google_attribute_options_ids_name();
    $check_detail_attributes = array('google_attribute_color','google_attribute_size','google_attribute_pattern','google_attribute_material');
    $this->overwrite_attributes = array();
    $this->max_overwrite_attributes = 1;
    foreach ($check_detail_attributes as $temp_a)
    {
      $tmp = preg_replace('/\s/', '', $this->product_data_use[$temp_a]);
      if (!empty($tmp))
      {
        $tmp_string = substr($temp_a,17);
        $this->overwrite_attributes[$tmp_string] = explode(';', $this->product_data_use[$temp_a]);
        $this->max_overwrite_attributes = count($this->overwrite_attributes[$tmp_string]) > $this->max_overwrite_attributes ? count($this->overwrite_attributes[$tmp_string]) : $this->max_overwrite_attributes;
        if (!array_key_exists($tmp_string, $this->my_google_attribute_options_ids_name))
          $this->my_google_attribute_options_ids_name[$tmp_string] = array();
        SHOP_CONFIG::set_google_attribute_options($tmp_string);
        if (!empty($this->my_google_attribute_options_ids_name[$tmp_string]))
          $this->my_google_attribute_options_ids = array_diff($this->my_google_attribute_options_ids, $this->my_google_attribute_options_ids_name[$tmp_string]);
      }
    }
  }
  
  private function attribute_handling()
  {
    if (!empty($this->my_google_attribute_options_ids) || !empty($this->overwrite_attributes))
    {
      $this->my_attributes_options = array(); // AGI Attribut-Link
      $allready_print_out = false;
      $attributes = array(); // entries of table 'products_attributes'
      $attributes_to_options = array();
      $found_db_attributes = 0;
      // get options from database
      if (!empty($this->my_google_attribute_options_ids))
      {
        // check for attributes
        $a_check = "SELECT COUNT(*) AS total 
        FROM 
          `".TABLE_PRODUCTS_ATTRIBUTES."` 
        WHERE 
          `products_id` = ".$this->products_id." AND 
          `options_id` IN (".implode(',', $this->my_google_attribute_options_ids).")
        ";
        $a_check = xtc_db_query($a_check);
        $a_check_result = xtc_db_fetch_array($a_check);
        $found_db_attributes = $a_check_result['total'];
        if ($found_db_attributes > 0)
        {
          // we've got attributes
          // get all attributes
          $attributes_query = xtc_db_query("SELECT pa.*, pav.products_options_values_name FROM `".TABLE_PRODUCTS_ATTRIBUTES."` AS pa, `".TABLE_PRODUCTS_OPTIONS_VALUES."` AS pav WHERE pa.products_id=".$this->products_id." AND pa.options_id IN (".implode(',', $this->my_google_attribute_options_ids).") AND pav.products_options_values_id=pa.options_values_id AND pav.language_id=".SHOP_CONFIG::get_language_id()." ORDER BY `options_id`, `sortorder`");
          while ($db_row = xtc_db_fetch_array($attributes_query))
          {
            if (!array_key_exists($db_row['options_id'], $attributes_to_options))
              $attributes_to_options[$db_row['options_id']] = array();
            $attributes_to_options[$db_row['options_id']][] = $db_row['products_attributes_id'];
            $attributes[$db_row['products_attributes_id']] = $db_row;
          }
        }
      }
      
      // get manually set options
      if (!empty($this->overwrite_attributes))
      {
        foreach ($this->overwrite_attributes as $google_name => $overrite_values)
        {
          if (!array_key_exists($google_name, $attributes_to_options))
            $attributes_to_options[$google_name] = array();
          foreach ($overrite_values as $key => $value)
          {
            $attributes_to_options[$google_name][] = $google_name.'_'.$key;
            $attributes[$google_name.'_'.$key] = array(
              'products_attributes_id'    => $google_name.'_'.$key,
              'products_id'               => $this->products_id,
              'options_id'                => $google_name,
              'options_values_id'         => 0,
              'options_values_price'      => 0,
              'price_prefix'              => '+',
              'attributes_model'          => '',
              'attributes_stock'          => $this->product_data_use['products_quantity'],
              'options_values_weight'     => 0,
              'weight_prefix'             => '+',
              'sortorder'                 => 0,
              'products_options_values_name' => trim($value),
              'attributes_vpe_value'      => 0, // MOD VPE Anpassung
              'attributes_ean'            => ''
            );
          }
        }
      }
      
      if ($found_db_attributes > 0 || $this->max_overwrite_attributes > 1)
      {
        $this->load_attribute_images(); // Attributbilder
        $attribute_response = $this->combine_attributes($attributes_to_options); // combination of all attributes
        $overwrite_products_data = array();
        foreach ($attribute_response as $attribut_combination)
        {
          $var_amount = 0;
          $tmp_attribute_vpe_value = 0; // MOD VPE Anpassung
          $var_price  = round($this->product_data_use['products_price'],2);
          $pdif = 0;
          $var_reduced_price = round($this->product_data_use['specials_new_products_price'],2);
          $var_weight = $this->product_data_use['products_weight'];
          $this->product_data_use['item_group_id'] = $this->products_id;
          $tmp_pid = $this->products_id;
          $tmp_google_attributes = array();
          $tmp_attributes_images = array();
          foreach ($this->my_google_attribute_options_ids_name as $key => $value)
            $tmp_google_attributes[$key] = '';

          $i_count = 0;
          foreach ($attribut_combination as $attribut_key)
          {
            $attribute_data = $attributes[$attribut_key];
            /* BOF AGI Attribut-Link */
            if ($attribute_data['options_values_id'] > 0)
              $this->my_attributes_options[$attribute_data['options_id']] = $attribute_data['options_values_id'];
            /* EOF AGI Attribut-Link */
            if (!empty($attribute_data['products_options_values_name']))
            {
              $tmp_google_attributes[SHOP_CONFIG::get_google_attribute_option($attribute_data['options_id'])] .= empty($tmp_google_attributes[SHOP_CONFIG::get_google_attribute_option($attribute_data['options_id'])]) ? $attribute_data['products_options_values_name'] : '-'.$attribute_data['products_options_values_name'];
            }
            $tmp_pid .= '-'.$attribut_key;
            
            // get amount
            if ($i_count==0)
              $var_amount = $attribute_data['attributes_stock'];
            else
              $var_amount = ($var_amount>$attribute_data['attributes_stock']) ? $attribute_data['attributes_stock'] : $var_amount;
            
            // calculate variant-price
            if (!empty($attribute_data['options_values_price']))
            {
              $values_price = (SHOP_CONFIG::get_customers_permissions('customers_status_show_price_tax')) ? xtc_add_tax($attribute_data['options_values_price'], SHOP_CONFIG::get_tax_rate($this->product_data_raw['products_tax_class_id'])) : $attribute_data['options_values_price'];
              if ($attribute_data['price_prefix'] == '+')
              {
                $pdif += $values_price;
                //$var_price += $values_price;
                //$var_reduced_price += $values_price;
              }
              if ($attribute_data['price_prefix'] == '-')
              {
                $pdif -= $values_price;
                //$var_price -= $values_price;
                //$var_reduced_price -= $values_price;
              }
              if ($attribute_data['price_prefix'] == '=')
              {
                //$pdif += $values_price;
                $var_price = $values_price;
                $var_reduced_price = $values_price;
              }
            }
            if ($this->products_discount <> 0 && SHOP_CONFIG::get_customers_permissions('customers_status_discount_attributes'))
              $overwrite_products_data['products_price'] = $var_price+($pdif*(100-$this->products_discount)/100);
            else
              $overwrite_products_data['products_price'] = $var_price+$pdif;
            $overwrite_products_data['specials_new_products_price'] = $var_reduced_price+$pdif;
            // calculate variants-weight
            if (!empty($attribute_data['options_values_weight']))
            {
              if ($attribute_data['weight_prefix'] == '+')
                $var_weight += $attribute_data['options_values_weight'];
              if ($attribute_data['weight_prefix'] == '-')
                $var_weight -= $attribute_data['options_values_weight'];
              if ($attribute_data['weight_prefix'] == '=')
                $var_weight = $attribute_data['options_values_weight'];
              $overwrite_products_data['products_weight'] = $var_weight;
            }
            
            if (!empty($attribute_data['attributes_ean']))
              $overwrite_products_data['products_ean'] = $attribute_data['attributes_ean'];
              
            /** BOF VPE Anpassung */
            if ($attribute_data['attributes_vpe_value'] <> 0)
            {
              if ($tmp_attribute_vpe_value == 0)
                $tmp_attribute_vpe_value = $attribute_data['attributes_vpe_value'];
              else
                $tmp_attribute_vpe_value = $attribute_data['attributes_vpe_value'] < $tmp_attribute_vpe_value ? $attribute_data['attributes_vpe_value'] : $tmp_attribute_vpe_value;
            }
            /** EOF VPE Anpassung */
            
            /** BOF Attributbilder **/
            $tmp = $this->get_attributes_images($attribute_data['options_id'], $attribute_data['options_values_id']);
            if (!empty($tmp))
              $tmp_attributes_images = array_merge($tmp_attributes_images, $tmp);
            /** EOF Attribut-Bilder **/
            
            $i_count++;
          }
          $overwrite_products_data['products_id'] = md5($tmp_pid);
          foreach ($this->my_google_attribute_options_ids_name as $key => $value)
          {
            if (!empty($tmp_google_attributes[$key]))
              $overwrite_products_data['agi_attribute_'.$key] = $tmp_google_attributes[$key];
          }
          
          // Verfügbarkeit neu berechnen
          $quantity = $var_amount;
          if (count($attribut_combination) == 1)
            $quantity = $this->product_data_use['products_quantity'];
          if ($quantity < 0)
            $quantity = 0;
          $overwrite_products_data['products_quantity'] = $quantity;
          $overwrite_products_data['google_availability_status'] = $this->set_availability($this->product_data_use['google_availability_status'], $overwrite_products_data['products_quantity']);
          
          // VPE neu berechnen
          if ($this->product_data_use['products_vpe_status'] == 1 && $this->product_data_raw['products_vpe_value'] != 0.0 && $this->product_data_raw['products_price'] > 0)
          {
            if ($vpe_name = SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe']) && !SHOP_CONFIG::is_ignored_vpe_unit(SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'name')))
            {
              /** BOF VPE Anpassung */
              $tmp_vpe_value = $this->product_data_raw['products_vpe_value'];
              if ($tmp_attribute_vpe_value <> 0)
                $tmp_vpe_value = $tmp_attribute_vpe_value;
              /** EOF VPE Anpassung */
              $tmp_price = $this->product_data_use['product_has_special'] ? $overwrite_products_data['specials_new_products_price'] : $overwrite_products_data['products_price'];
              $vpe_price = SHOP_CONFIG::calculate_price($tmp_price * (1 / $tmp_vpe_value), true).' pro '.SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'name');
              $overwrite_products_data['vpe'] = $vpe_price;
              
              $tmp = number_format(SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'value')*$tmp_vpe_value,3,',','');
              $overwrite_products_data['unit_pricing_measure']      = $tmp.' '.SHOP_CONFIG::replace_vpe_unit(SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'unit'));
              $overwrite_products_data['unit_pricing_base_measure'] = SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'value').' '.SHOP_CONFIG::replace_vpe_unit(SHOP_CONFIG::get_vpe_data($this->product_data_raw['products_vpe'], 'unit'));
            }
            else
              $overwrite_products_data['products_vpe_status'] = 0;
          }
          
          // Versandgewicht anpassen
          $this->calculate_shipping();
          $this->set_products_texts();
          // Attributbilder setzen
          if (!empty($tmp_attributes_images))
            $overwrite_products_data['products_images'] = array_unique($tmp_attributes_images);
          /* BOF AGI Attribut-Link */
          if (!empty($this->my_attributes_options))
            $this->create_link();
          /* EOF AGI Attribut-Link */
          // Produkt hier ausgeben
          $this->print_out_product($overwrite_products_data);
          $allready_print_out = true;
        }
      }
      return $allready_print_out;
    }
    return false;
  }
  
  private function set_products_texts()
  {
    $products_description = strtolower(MODULE_AGI_GOOGLE_XML_LONG_DESCRIPTION) == 'true' ? $this->product_data_raw['products_description'] : $this->product_data_raw['products_short_description'];
    if (strpos($products_description, '[TAB:') !== false)
      $products_description = preg_replace('/\[TAB:(.+?)\]/', '<br /><br />$1<br />', $products_description);
    $products_description = $this->clean_html_to_text($products_description);
    $products_name = empty($this->product_data_raw['google_alternative_title']) ? $this->product_data_raw['products_name'] : $this->product_data_raw['google_alternative_title'];
    $this->product_data_use['products_description'] = $products_description;
    $this->product_data_use['products_name'] = $products_name;
  }
  
  public function print_out_product($overwrite_products_data = array())
  {
    $products_data = $this->product_data_use;
    foreach($overwrite_products_data as $key => $value)
    {
      if (!array_key_exists($key, $products_data))
        $products_data[$key] = $value;
      elseif (!empty($value))
        $products_data[$key] = $value;
    }
    
    if (!empty($products_data['vpe']))
    {
      if (strtolower(MODULE_AGI_GOOGLE_XML_VPE_TITLE) == 'true')
        $products_data['products_name'] .= ' ('.$products_data['vpe'].')';
      if (strtolower(MODULE_AGI_GOOGLE_XML_VPE_DESCRIPTION) == 'true')
        $products_data['products_description'] = '('.$products_data['vpe'].') '.$products_data['products_description'];
    }
    
    echo '<item>',LN;
    $this->print_out_xml_item('title', $products_data['products_name'], 150);
    $this->print_out_xml_item('description', $products_data['products_description'], 5000);
    $this->print_out_xml_item('link', $products_data['link']);
    if (!empty($products_data['google_mobile_link']))
      $this->print_out_xml_item('mobile_link', $products_data['google_mobile_link'], 2000);
    $this->print_out_xml_item('g:id', $products_data['products_id'], 50);
    if (!empty($products_data['item_group_id']))
      $this->print_out_xml_item('g:item_group_id', $products_data['item_group_id'], 50);
    $this->print_out_xml_item('g:google_product_category', $products_data['google_category']);
    $this->print_out_xml_item('g:product_type', $products_data['category'], 750);
    $image_dir = DIR_WS_POPUP_IMAGES;
    if (defined('MODULE_AGI_GOOGLE_XML_USE_PRODUCT_IMAGE') && MODULE_AGI_GOOGLE_XML_USE_PRODUCT_IMAGE == 'info_images')
      $image_dir = DIR_WS_INFO_IMAGES;
    if (defined('MODULE_AGI_GOOGLE_XML_USE_PRODUCT_IMAGE') && MODULE_AGI_GOOGLE_XML_USE_PRODUCT_IMAGE == 'original_images')
      $image_dir = DIR_WS_ORIGINAL_IMAGES;
      
    $i_count = 0;
    foreach ($products_data['products_images'] as $row)
    {
      $this->print_out_xml_item($i_count > 0 ? 'g:additional_image_link' : 'g:image_link', HTTP_SERVER . DIR_WS_CATALOG . $image_dir . $row);
      $i_count++;
      if ($i_count >= 10)
        break;
    }
    $this->print_out_xml_item('g:condition', $products_data['google_condition']);
    
    $this->print_out_xml_item('g:availability', $products_data['google_availability_status']);
    $this->print_out_xml_item('g:price', SHOP_CONFIG::calculate_price($products_data['products_price'], true));
    if ($products_data['product_has_special'])
    {
      $this->print_out_xml_item('g:sale_price', SHOP_CONFIG::calculate_price($products_data['specials_new_products_price'], true));
      if (!empty($products_data['special_expires_date']))
      {
        $tmp = strtotime($products_data['special_expires_date'].' +1 day');
        if ($tmp > 0)
          $this->print_out_xml_item('g:sale_price_effective_date', date('Y-m-d').'T00:00'.date('O').'/'.date('Y-m-d',$tmp).'T'.date('H:iO',$tmp));
      }
      else
      {
        $tmp = time()+10*86400;
        $this->print_out_xml_item('g:sale_price_effective_date', date('Y-m-d').'T00:00'.date('O').'/'.date('Y-m-d',$tmp).'T'.date('H:iO',$tmp));
      }
    }

    $ident_count = 0;
    if (!empty($products_data['brand']))
    {
      $this->print_out_xml_item('g:brand', $products_data['brand'], 70);
      $ident_count++;
    }
    if (!empty($products_data['products_ean']) && strlen($products_data['products_ean']) > 5)
    {
      $this->print_out_xml_item('g:gtin', $products_data['products_ean'], 50);
      $ident_count++;
    }
    $mpn = !empty($products_data['products_manufacturers_model']) ? $products_data['products_manufacturers_model'] : $products_data['products_model'];
    if (!empty($mpn))
    {
      $this->print_out_xml_item('g:mpn', $mpn, 70);
      $ident_count++;
    }
    if ($products_data['google_identifier_exists'] == 1 && $ident_count < 2)
      $this->print_out_xml_item('g:identifier_exists', 'FALSE');
    else
      $this->print_out_xml_item('g:identifier_exists', $products_data['google_identifier_exists'] ? 'TRUE' : 'FALSE');
    
    echo '<g:shipping>',LN;
      $this->print_out_xml_item('g:country', SHOP_CONFIG::get_country_code());
      $this->print_out_xml_item('g:service', $this->product_data_use['shipping_price'] > 0 ? 'Standard' : 'Versandkostenfrei');
      $this->print_out_xml_item('g:price', SHOP_CONFIG::calculate_price($this->product_data_use['shipping_price'], true));
    echo '</g:shipping>',LN;
    
    if (!empty($products_data['products_weight']))
      $this->print_out_xml_item('g:shipping_weight', number_format($products_data['products_weight'],3,',',''). ' kg');
    
    if (!empty($products_data['google_energy_efficiency']))
      $this->print_out_xml_item('g:energy_efficiency_class', $products_data['google_energy_efficiency']);
    
    if ($products_data['products_fsk18'])
      $this->print_out_xml_item('g:adult', 'TRUE');
      
    if ($products_data['google_multipack_amount'] > 1)
      $this->print_out_xml_item('g:multipack', $products_data['google_multipack_amount']);
      
    if (!empty($products_data['vpe']))
    {
      $this->print_out_xml_item('g:unit_pricing_measure', $products_data['unit_pricing_measure']);
      $this->print_out_xml_item('g:unit_pricing_base_measure', $products_data['unit_pricing_base_measure']);
    }
    
    
    if (array_key_exists('google_adwords_grouping', $products_data) && !empty($products_data['google_adwords_grouping']))
      $this->print_out_xml_item('g:adwords_grouping', $products_data['google_adwords_grouping']);
    
    if (array_key_exists('google_adwords_labels', $products_data) && !empty($products_data['google_adwords_labels']))
    {
      $tmp = explode(',',$products_data['google_adwords_labels']);
      foreach ($tmp as $row)
      {
        $row = trim($row);
        if (!empty($row))
          $this->print_out_xml_item('g:adwords_labels', $row);
      }
    }
    
    for ($i=0; $i<=4; $i++)
    {
      if (!empty($products_data['google_custom_label'.$i]))
        $this->print_out_xml_item('g:custom_label_'.$i, $products_data['google_custom_label'.$i], 100);
    }
    
    if (array_key_exists('google_adwords_redirect', $products_data) && !empty($products_data['google_adwords_redirect']))
      $this->print_out_xml_item('g:adwords_redirect', $products_data['google_adwords_redirect'], 2000);
    
    if (array_key_exists('google_excluded_destination', $products_data) && !empty($products_data['google_excluded_destination']))
      $this->print_out_xml_item('g:excluded_destination', $products_data['google_excluded_destination']);
    
    if (array_key_exists('google_expiration_date', $products_data) && !empty($products_data['google_expiration_date']))
      $this->print_out_xml_item('g:expiration_date', $products_data['google_expiration_date']);
    
    if (array_key_exists('clothing_product', $products_data) && $products_data['clothing_product'])
    {
      if (array_key_exists('agi_attribute_color', $products_data) && !empty($products_data['agi_attribute_color']))
        $this->print_out_xml_item('g:color', $products_data['agi_attribute_color'], 100);
      elseif(array_key_exists('google_attribute_color', $products_data) && !empty($products_data['google_attribute_color']))
        $this->print_out_xml_item('g:color', $products_data['google_attribute_color'], 100);
      
      if (array_key_exists('agi_attribute_size', $products_data) && !empty($products_data['agi_attribute_size']))
        $this->print_out_xml_item('g:size', $products_data['agi_attribute_size'], 100);
      elseif(array_key_exists('google_attribute_size', $products_data) && !empty($products_data['google_attribute_size']))
        $this->print_out_xml_item('g:size', $products_data['google_attribute_size'], 100);
      else
        $this->print_out_xml_item('g:size', 'one size', 100);
      
      if (array_key_exists('agi_attribute_pattern', $products_data) && !empty($products_data['agi_attribute_pattern']))
        $this->print_out_xml_item('g:pattern', $products_data['agi_attribute_pattern'], 100);
      elseif(array_key_exists('google_attribute_pattern', $products_data) && !empty($products_data['google_attribute_pattern']))
        $this->print_out_xml_item('g:pattern', $products_data['google_attribute_pattern'], 100);
      
      if (array_key_exists('agi_attribute_material', $products_data) && !empty($products_data['agi_attribute_material']))
        $this->print_out_xml_item('g:material', $products_data['agi_attribute_material'], 200);
      elseif(array_key_exists('google_attribute_material', $products_data) && !empty($products_data['google_attribute_material']))
        $this->print_out_xml_item('g:material', $products_data['google_attribute_material'], 200);
      
      if (array_key_exists('agi_attribute_gender', $products_data) && !empty($products_data['agi_attribute_gender']))
      {
        if (SHOP_CONFIG::is_assigned_word('gender', 'male', $products_data['agi_attribute_gender']))
          $this->print_out_xml_item('g:gender', 'male');
        elseif (SHOP_CONFIG::is_assigned_word('gender', 'female', $products_data['agi_attribute_gender']))
          $this->print_out_xml_item('g:gender', 'female');
        else
          $this->print_out_xml_item('g:gender', 'unisex');
      }
      elseif(array_key_exists('google_attribute_gender', $products_data) && !empty($products_data['google_attribute_gender']))
        $this->print_out_xml_item('g:gender', $products_data['google_attribute_gender']);
      else
        $this->print_out_xml_item('g:gender', MODULE_AGI_GOOGLE_XML_PRESELECT_GENDER);
        
      if (array_key_exists('agi_attribute_age_group', $products_data) && !empty($products_data['agi_attribute_age_group']))
      {
        if (SHOP_CONFIG::is_assigned_word('age_group', 'adult', $products_data['agi_attribute_age_group']))
          $this->print_out_xml_item('g:age_group', 'adult');
        elseif (SHOP_CONFIG::is_assigned_word('age_group', 'kids', $products_data['agi_attribute_age_group']))
          $this->print_out_xml_item('g:age_group', 'kids');
        elseif (SHOP_CONFIG::is_assigned_word('age_group', 'newborn', $products_data['agi_attribute_age_group']))
          $this->print_out_xml_item('g:age_group', 'newborn');
        elseif (SHOP_CONFIG::is_assigned_word('age_group', 'infant', $products_data['agi_attribute_age_group']))
          $this->print_out_xml_item('g:age_group', 'infant');
        elseif (SHOP_CONFIG::is_assigned_word('age_group', 'toddler', $products_data['agi_attribute_age_group']))
          $this->print_out_xml_item('g:age_group', 'toddler');
        else
          $this->print_out_xml_item('g:age_group', 'adult');
      }
      elseif(array_key_exists('google_attribute_age_group', $products_data) && !empty($products_data['google_attribute_age_group']))
        $this->print_out_xml_item('g:age_group', $products_data['google_attribute_age_group']);
      else
        $this->print_out_xml_item('g:age_group', MODULE_AGI_GOOGLE_XML_PRESELECT_AGEGROUP);
      
      if (!empty($products_data['google_attribute_size_type']))
        $this->print_out_xml_item('g:size_type', $products_data['google_attribute_size_type']);
      else
        $this->print_out_xml_item('g:size_type', MODULE_AGI_GOOGLE_XML_PRESELECT_SIZETYPE);
      if (!empty($products_data['google_attribute_size_system']))
        $this->print_out_xml_item('g:size_system', $products_data['google_attribute_size_system']);
      else
        $this->print_out_xml_item('g:size_system', MODULE_AGI_GOOGLE_XML_DEFAULT_CL_SIZESYSTEM);
    }
    else
    {
      if (array_key_exists('agi_attribute_color', $products_data) && !empty($products_data['agi_attribute_color']))
        $this->print_out_xml_item('g:color', $products_data['agi_attribute_color'], 100);
      elseif(array_key_exists('google_attribute_color', $products_data) && !empty($products_data['google_attribute_color']))
        $this->print_out_xml_item('g:color', $products_data['google_attribute_color'], 100);
      if (array_key_exists('agi_attribute_size', $products_data) && !empty($products_data['agi_attribute_size']))
        $this->print_out_xml_item('g:size', $products_data['agi_attribute_size'], 100);
      elseif(array_key_exists('google_attribute_size', $products_data) && !empty($products_data['google_attribute_size']))
        $this->print_out_xml_item('g:size', $products_data['google_attribute_size'], 100);
      if (array_key_exists('agi_attribute_pattern', $products_data) && !empty($products_data['agi_attribute_pattern']))
        $this->print_out_xml_item('g:pattern', $products_data['agi_attribute_pattern'], 100);
      elseif(array_key_exists('google_attribute_pattern', $products_data) && !empty($products_data['google_attribute_pattern']))
        $this->print_out_xml_item('g:pattern', $products_data['google_attribute_pattern'], 100);
      if (array_key_exists('agi_attribute_material', $products_data) && !empty($products_data['agi_attribute_material']))
        $this->print_out_xml_item('g:material', $products_data['agi_attribute_material'], 200);
      elseif(array_key_exists('google_attribute_material', $products_data) && !empty($products_data['google_attribute_material']))
        $this->print_out_xml_item('g:material', $products_data['google_attribute_material'], 200);
    }
    
    echo '</item>',LN;
  }
}

$config = new SHOP_CONFIG(empty($currency) ? DEFAULT_CURRENCY : $currency, $country_id, $zone_id, $export_language, $export_group);

// Prepare general database query
$general_query = "SELECT 
    p.*, 
    IFNULL(pa.google_export, ".(MODULE_AGI_GOOGLE_XML_PRESELECT_EXPORT_ALLOWED == 'TRUE' ? '1' : '0').") AS google_export,
    IFNULL(pa.google_condition, '".MODULE_AGI_GOOGLE_XML_PRESELECT_CONDITION."') AS google_condition,
    IFNULL(pa.google_excluded_destination, '') AS google_excluded_destination,
    IFNULL(pa.google_expiration_date, '') AS google_expiration_date,
    IFNULL(pa.google_products_brand, '') AS google_products_brand,
    IFNULL(pa.google_identifier_exists, ".(MODULE_AGI_GOOGLE_XML_PRESELECT_IDENTIFIER_EXISTS == 'TRUE' ? '1' : '0').") AS google_identifier_exists,
    IFNULL(pa.google_multipack_amount, 1) AS google_multipack_amount,
    IFNULL(pa.google_energy_efficiency, '') AS google_energy_efficiency,
    IFNULL(pa.clothing_product, ".(MODULE_AGI_GOOGLE_XML_PRESELECT_CLOTHING_PRODUCT == 'TRUE' ? '1' : '0').") AS clothing_product,
    IFNULL(pa.google_attribute_gender, '".MODULE_AGI_GOOGLE_XML_PRESELECT_GENDER."') AS google_attribute_gender,
    IFNULL(pa.google_attribute_age_group, '".MODULE_AGI_GOOGLE_XML_PRESELECT_AGEGROUP."') AS google_attribute_age_group,
    IFNULL(pa.google_attribute_size_type, '') AS google_attribute_size_type,
    IFNULL(pa.google_attribute_size_system, '') AS google_attribute_size_system,
    pd.products_short_description, 
    pd.products_name, 
    pd.products_description,
    IFNULL(pda.google_category, '') AS google_category,
    IFNULL(pda.google_adwords_redirect, '') AS google_adwords_redirect,
    IFNULL(pda.google_mobile_link, '') AS google_mobile_link,
    IFNULL(pda.google_alternative_title, '') AS google_alternative_title,
    IFNULL(pda.google_adwords_grouping, '') AS google_adwords_grouping,
    IFNULL(pda.google_adwords_labels, '') AS google_adwords_labels,
    IFNULL(pda.google_attribute_color, '') AS google_attribute_color,
    IFNULL(pda.google_attribute_size, '') AS google_attribute_size,
    IFNULL(pda.google_attribute_pattern, '') AS google_attribute_pattern,
    IFNULL(pda.google_attribute_material, '') AS google_attribute_material,
    IFNULL(pda.google_custom_label0, '') AS google_custom_label0,
    IFNULL(pda.google_custom_label1, '') AS google_custom_label1,
    IFNULL(pda.google_custom_label2, '') AS google_custom_label2,
    IFNULL(pda.google_custom_label3, '') AS google_custom_label3,
    IFNULL(pda.google_custom_label4, '') AS google_custom_label4,
    IFNULL(s.status, 0) AS product_has_special,
    IFNULL(s.specials_new_products_price, 0) AS specials_new_products_price,
    IFNULL(s.expires_date,'') AS special_expires_date
  FROM 
    `".TABLE_PRODUCTS."` AS p
    LEFT JOIN `".TABLE_AGI_PRODUCTS_ADD."` AS pa ON pa.products_id=p.products_id
    LEFT JOIN `".TABLE_PRODUCTS_DESCRIPTION."` AS pd ON pd.products_id=p.products_id AND pd.language_id=".SHOP_CONFIG::get_language_id()."
    LEFT JOIN `".TABLE_AGI_PRODUCTS_DESCRIPTION_ADD."` AS pda ON pda.products_id=p.products_id AND pda.language_id=".SHOP_CONFIG::get_language_id()."
    LEFT JOIN `".TABLE_SPECIALS."` AS s ON s.products_id=p.products_id
  WHERE 
    p.products_status=1
  ";
if (MODULE_AGI_GOOGLE_XML_PRESELECT_EXPORT_ALLOWED == 'TRUE')
  $general_query .=  ' AND IFNULL(pa.google_export,1)=1 ';
else
  $general_query .=  ' AND pa.google_export=1 ';

if (strtolower(GROUP_CHECK) == 'true')
  $general_query .= " AND p.group_permission_".SHOP_CONFIG::get_customers_group()."=1";
if (!empty($export_hersteller))
  $general_query .= " AND p.manufacturers_id IN (".$export_hersteller.")"; // Hersteller

// Export FSK-Article?
if (!SHOP_CONFIG::get_customers_permissions('customers_fsk18_display'))
  $general_query .= ' AND p.products_fsk18!=1';

// GROUP BY ORDER BY
$general_query .= ' ORDER BY p.products_id ASC';

// Export-Limit ?
$limit_amount = MODULE_AGI_GOOGLE_XML_FEED_NB_ARTICLE;
if ($limit_page > 0)
{
  $lstart = ($limit_page-1) * $limit_amount;
  $general_query .= " LIMIT $lstart, $limit_amount";
}

$main_product_query = xtc_db_query($general_query);
$tmp = xtc_db_num_rows($main_product_query);

if (empty($tmp))
{
  header("HTTP/1.0 204 No Content");
  exit;
}

$temp_tax = array();
// Start OUTPUT
// start caching
ob_start();

$feed_builder = new FEED_BUILDER();
$feed_builder->start_feed();
$feed_builder->print_out_xml_item('title', STORE_NAME);
$feed_builder->print_out_xml_item('link', HTTP_SERVER);
$feed_builder->print_out_xml_item('description', 'Google product feed created at '.date('Y-m-d H:i'));
while ($listing = xtc_db_fetch_array($main_product_query))
{
  if (empty($listing['products_image']))
    continue;
  $xml_item = new PRODUCT_ITEM($listing);
  if ($xml_item->prepare_product())
  {
    // jetzt ausgeben! nur wenn keine Attribute, da ausgabe sonst schon erledgt
    $xml_item->print_out_product();
  }
  unset($xml_item);
}

$feed_builder->end_feed();

// END OUTPUT
// end caching
$content = strtolower(MODULE_AGI_GOOGLE_XML_IS_GZIP) == 'true' ? gzencode(ob_get_clean(), 9) : ob_get_clean();

// save cache
$fp = fopen(CACHED_GOOGLE_FILE,'w');
fputs($fp, $content);
fclose($fp);

if (isset($_GET['out']) && $_GET['out']=='false')
  exit;

// show cached content
header("Content-Type: text/xml");
if (strtolower(MODULE_AGI_GOOGLE_XML_IS_GZIP) == 'true')
  header("Content-Encoding: gzip");
echo $content;

?>