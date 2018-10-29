<?php
/* -----------------------------------------------------------------------------------------
   $Id: sitemap.php 1278 2005-10-02 07:40:25Z mz $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2004 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce; www.oscommerce.com
   (c) 2003	 nextcommerce; www.nextcommerce.org

   Released under the GNU General Public License
   -----------------------------------------------------------------------------------------
   Third Party contributions:
   Show_Products_and_Contentsites       Autor: Hetfield - www.Merz-IT-SerVice.de

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

$module_smarty = new Smarty;
$module_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');
require_once(DIR_FS_INC . 'xtc_count_products_in_category.inc.php');

function buildProducts($category_id) {
	$fsk_lock = '';
    if ($_SESSION['customers_status']['customers_fsk18_display'] == '0') {
      $fsk_lock = ' AND p.products_fsk18!=1 ';
    }
	if (GROUP_CHECK == 'true') {
      $group_check = " AND p.group_permission_".$_SESSION['customers_status']['customers_status_id']."=1 ";
    }
	$select_products = "SELECT DISTINCT 
							p.products_id, 
							pd.products_name, 
							p2c.categories_id 
						FROM products p, products_to_categories p2c, products_description pd
				        WHERE p2c.categories_id = ".$category_id." 
						AND p.products_id = p2c.products_id 
						AND products_status = '1' 
						AND pd.language_id = ".$_SESSION['languages_id'].
						$group_check.
						$fsk_lock."
						AND pd.products_id = p.products_id
						ORDER BY pd.products_name ASC";
	$products_query = xtc_db_query($select_products);
	while ($products = xtc_db_fetch_array($products_query))	{
		$products_array[] = array('pid' => $products['products_id'],
								  'cid' => $products['categories_id'],
								  'productslink' => '<a href="' . xtc_href_link(FILENAME_PRODUCT_INFO, xtc_product_link($products['products_id'], $products['products_name'])) . '" class="sitemap_products" title="' . $products['products_name'] . '">' . $products['products_name'] . '</a>');
	}
	return $products_array;
}

function get_category_tree($parent_id = '0', $spacing = '0', $exclude = '', $category_tree_array = '', $include_itself = false, $cPath = '') {
   if ($parent_id == 0){ $cPath = ''; } else { $cPath .= $parent_id . '_'; }
   if (!is_array($category_tree_array)) $category_tree_array = array();
   if ( (sizeof($category_tree_array) < 1) && ($exclude != '0') ) $category_tree_array[] = array('id' => '0', 'text' => TEXT_TOP);
   if ($include_itself) {
     $category_query = "SELECT cd.categories_name FROM " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE cd.language_id = '" . $_SESSION['languages_id'] . "' AND c.categories_status = '1' AND cd.categories_id = '" . $parent_id . "'";
     $category_query = xtDBquery($category_query);
     $category = xtc_db_fetch_array($category_query,true);
     $category_tree_array[] = array('id' => $parent_id, 'text' => $category['categories_name']);
   }
   $categories_query = "SELECT c.categories_id, cd.categories_name, c.parent_id FROM " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE c.categories_id = cd.categories_id AND cd.language_id = '" . $_SESSION['languages_id'] . "' AND c.parent_id = '" . $parent_id . "' AND c.categories_status = '1' ORDER BY c.sort_order, cd.categories_name";
   $categories_query = xtDBquery($categories_query);
   while ($categories = xtc_db_fetch_array($categories_query,true)) {
     $SEF_link = xtc_href_link(FILENAME_DEFAULT, xtc_category_link($categories['categories_id'],$categories['categories_name']));
     if ($exclude != $categories['categories_id'])
        $category_tree_array[] = array('id' => $categories['categories_id'],
      				                   'text' => $categories['categories_name'],
									   'level' => substr_count($spacing, '&nbsp;&nbsp;&nbsp;'),
									   'products' => buildProducts($categories['categories_id']),
									   'link'  => $SEF_link);
        $category_tree_array = get_category_tree($categories['categories_id'], $spacing.'&nbsp;&nbsp;&nbsp;', $exclude, $category_tree_array, false, $cPath);
   }
   return $category_tree_array;
}

if (GROUP_CHECK == 'true') {
 	$group_check = " AND c.group_permission_".$_SESSION['customers_status']['customers_status_id']." = 1 ";
}
$categories_query = "SELECT c.categories_image, c.categories_id, cd.categories_name, cd.categories_description 
					 FROM " . TABLE_CATEGORIES . " c LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON c.categories_id = cd.categories_id 
					 WHERE c.categories_status = '1' AND cd.language_id = " . $_SESSION['languages_id'] . " AND c.parent_id = '0' " . $group_check . " ORDER BY c.sort_order, cd.categories_name ASC";
$categories_query = xtDBquery($categories_query);
$module_content = array();
$categories_image='';
while ($categories = xtc_db_fetch_array($categories_query,true)) {
   	if ($categories['categories_image'] !='') {
	    $categories_image = DIR_WS_IMAGES . 'categories/' . $categories['categories_image'];
	} else {
	    $categories_image='';
	}
    $SEF_link = xtc_href_link(FILENAME_DEFAULT, xtc_category_link($categories['categories_id'],$categories['categories_name']));
    $module_content[]=array('ID'  => $categories['categories_id'],
                            'CAT_NAME'  => $categories['categories_name'],
						    'CAT_DESC'  => $categories['categories_description'],
                            'CAT_IMAGE' => $categories_image,
                            'CAT_LINK'  => $SEF_link,
						    'PROD' => buildProducts($categories['categories_id']),
						    'SCATS'  => get_category_tree($categories['categories_id'], '',0));
}
if (GROUP_CHECK == 'true') {
	$group_check2 = " AND group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%' ";
}
$content_string = '';
$content_query = "SELECT content_id, categories_id, parent_id, content_title, content_group FROM ".TABLE_CONTENT_MANAGER." WHERE languages_id = '" . (int) $_SESSION['languages_id'] . "' " . $group_check2 . " AND content_status = 1 ORDER BY sort_order";
$content_query = xtDBquery($content_query);
while ($content_data = xtc_db_fetch_array($content_query, true)) {
	$SEF_parameter = '';
	if (SEARCH_ENGINE_FRIENDLY_URLS == 'true')
		$SEF_parameter = '&content='.xtc_cleanName($content_data['content_title']);
    $content_string .= '<li class="sitemap_content"><a href="'.xtc_href_link(FILENAME_CONTENT, 'coID='.$content_data['content_group'].$SEF_parameter).'" class="sitemap_content_link">'.$content_data['content_title'].'</a></li>';
}
if ($content_string != '')
	$module_smarty->assign('SITEMAP_CONTENT', $content_string);

if (sizeof($module_content) >= 1 || $content_string != '') {
	$module_smarty->assign('language', $_SESSION['language']);
	$module_smarty->assign('module_content',$module_content);
	$module_smarty->assign('products_content',$products_content);
	// set cache ID
	if (!CacheCheck()) {
		$module_smarty->caching = 0;
		echo $module_smarty->fetch(CURRENT_TEMPLATE.'/module/sitemap.html');
	} else {
		$module_smarty->caching = 1;
		$module_smarty->cache_lifetime=CACHE_LIFETIME;
		$module_smarty->cache_modified_check=CACHE_CHECK;
		$cache_id = $GET['cPath'].$_SESSION['language'].$_SESSION['customers_status']['customers_status_name'].$_SESSION['currency'];
		echo $module_smarty->fetch(CURRENT_TEMPLATE.'/module/sitemap.html',$cache_id);
	}
}
?>