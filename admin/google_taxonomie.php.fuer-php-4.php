<?php
/* admin/google_taxonomie.php für php4
.---------------------------------------------------------------------------.
|    Software: GOOGLE-Shopping XML-Export for modified-eCommerce            |
|      Author: Andreas Guder                                                |
|     Version: 2                                                            |
|     Contact: info@andreas-guder.de / http://www.andreas-guder.de          |
| Copyright (c) 2014, Andreas Guder [info@andreas-guder.de]                 |
|               GNU General Public License                                  |
'--------------------------------------------------------------------------ö'
*/
  require('includes/application_top.php');
  class GOOGLE_TAXONOMIE
  {
    var $taxonomie_array  = array();
    var $taxonomie_file   = array();
    
    /**
     * @param   string path to google-taxonomieflile
     */
    function google_taxonomie($file)
    {
      if (file_exists($file))
      {
        $this->taxonomie_file = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      }
      $this->file_to_array();
    }
    
    /**
     * create $taxonomie_array from $taxonomie_file
     */
    function file_to_array()
    {
      foreach ($this->taxonomie_file as $row)
      {
        $is_empty = preg_replace('/\s/', '', $row);
        if (empty($is_empty))
          continue;
        $google_cats = explode('>',$row);
        $ref = &$this->taxonomie_array;
        foreach ($google_cats as $category)
        {
          $check_cat = trim($category);
          if (array_key_exists($check_cat, $ref))
          {
            $ref = &$ref[$check_cat];
          }
          else
          {
            $ref[$check_cat] = array();
            $ref = &$ref[$check_cat];
          }
        }
      }
    }
    
    /**
     * create json-string of given array
     * @param   array $array: array to create json from
     * @param   array $child_path: child-elements of the given array
     * @return  string
     */
    function array_to_json($array, $child_path = array())
    {
      $string = '';
      $count = 0;
      foreach($array as $key => $value)
      {
        $add_child_path = $child_path;
        $add_child_path[] = $key;
        if($count > 0)
          $string .= ',';
        $string .= '"'.rawurlencode(strtolower($_SESSION['language_charset']) == 'utf-8' ? $key : utf8_encode($key)).'":{';
        $string .= '"string":"'.rawurlencode(strtolower($_SESSION['language_charset']) == 'utf-8' ? implode(' > ', $add_child_path) : utf8_encode(implode(' > ', $add_child_path))).'"';
        if (!empty($value))
        {
          $string .= ',"childs":{';
          $string .= $this->array_to_json($value, $add_child_path);
          $string .= '}';
        }
        $string .= '}';
        $count++;
      }
      return $string;
    }
    
    /**
     * public function to handle json-string (save to file or return as string
     * @param   string  $save_path: path (and name) of file to create, or empty to return string only
     * @param   string  $wrap:  string to wrap the json-string use "%s" for explode
     * @return  mixed   string/bool
     */
    function taxonomie_to_json($save_path = '', $wrap = 'var g_taxonimie = eval(%s)')
    {
      $string = '';
        $wrap_explode = !empty($wrap) ? explode('%s',$wrap) : array('','');
      if ($wrap_explode[0])
        $string .= $wrap_explode[0];
      $string .= '{';
      $string .= '"string":""';
      $string .= ',"childs":{';
      $string .= $this->array_to_json($this->taxonomie_array);
      $string .= '}}';
      if ($wrap_explode[1])
        $string .= $wrap_explode[1];
      if (empty($save_path))
        return $string;
      else
      {
        // try to write file
        if ($fp = fopen($save_path, 'w'))
        {
          fwrite($fp, $string);
          fclose($fp);
          return true;
        }
        else
          return false;
      }
    }
  }
  define('FILENAME_AGI_GOOGLE_TAXONOMIE','google_taxonomie.php');
  $languages = xtc_get_languages();

  function getTaxonomyLangCode($code)
  {
    $tlc = array('de'=>'de-DE','en'=>'en-GB','fr'=>'fr-FR');
    if (array_key_exists($code, $tlc))
      return $tlc[$code];
    return 'en-GB';
  }
$print_error = array();
switch ($_GET['action']) {
  case 'save':
    foreach ($languages as $langdata)
    {
      if ($fp = fopen(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.'.$langdata['code'].'.txt', 'w'))
      {
        fwrite($fp, $_POST['google_cats_'.$langdata['code']]);
        fclose($fp);
        if (file_exists(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.'.$langdata['code'].'.txt'))
        {
          $google = new GOOGLE_TAXONOMIE(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.'.$langdata['code'].'.txt');
          $wrap = 'var g_taxonimie_'.$langdata['code'].' = eval(%s)';
          $success = $google->taxonomie_to_json(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.'.$langdata['code'].'.json.js', $wrap);
          if (!$success)
            $print_error[] = 'google_taxonomie.'.$langdata['code'].'.json.js konnte nicht erstellt werden';
        }
      }
      else
        $print_error[] = 'google_taxonomie.'.$langdata['code'].'.txt konnte nicht erstellt werden';
    }
    if (empty($print_error))
      xtc_redirect(FILENAME_AGI_GOOGLE_TAXONOMIE);
  break;
}

// get file_information
$google_text = array();
$google_json = array();
$google_file = array();
foreach ($languages as $langdata)
{
  $google_text[$langdata['id']] = 'not available';
  $google_json[$langdata['id']] = 'not available';
  $google_file[$langdata['id']] = '';
  if (file_exists(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.'.$langdata['code'].'.txt'))
  {
    $info = filemtime(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.'.$langdata['code'].'.txt');
    $google_text[$langdata['id']] = 'Date: '.date('Y-m-d H:i',$info);
    if (!is_writable(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.'.$langdata['code'].'.txt'))
      $google_text[$langdata['id']] .= ' NOT writable, please ask your administrator';
    $google_file[$langdata['id']] = file_get_contents(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.'.$langdata['code'].'.txt');
  }
  elseif (file_exists(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.txt'))
  {
    $google_file[$langdata['id']] = file_get_contents(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.txt');
  }
  if (file_exists(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.'.$langdata['code'].'.json.js'))
  {
    $info = filemtime(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.'.$langdata['code'].'.json.js');
    $google_json[$langdata['id']] = 'Date: '.date('Y-m-d H:i',$info);
    if (!is_writable(DIR_FS_DOCUMENT_ROOT.'export/google_taxonomie.'.$langdata['code'].'.json.js'))
      $google_json[$langdata['id']] .= ' NOT writable, please ask your administrator';
  }
}
  require (DIR_WS_INCLUDES.'head.php');
?>
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body >
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td class="columnLeft2" width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td class="boxCenter" width="100%" valign="top">
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="80" rowspan="2"><?php echo xtc_image(DIR_WS_ICONS.'heading_news.gif'); ?></td>
    <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
  </tr>
  <tr>
    <td class="main" valign="top"><a href="http://www.andreas-guder.de" onClick="window.open(this.href,'_blank',''); return false;">AGI - Internetagentur Andreas Guder</a></td>
  </tr>
</table>
        </td>
      </tr>
      <tr>
        <td class="main">
        <div style="margin-top: 15px;">
          <ul class="agi_language_tabs">
<?php foreach ($languages as $arrayKey => $langdata) { ?>
            <li <?php echo $arrayKey == 0 ? 'class="active"' : ''; ?> onclick="showAgiLanguageTab(this, 'agilagtabarea', '<?php echo $arrayKey; ?>');"><?php echo xtc_image(DIR_WS_LANGUAGES . $langdata['directory'] .'/admin/images/'. $langdata['image'], $langdata['name']) . ' ' . $langdata['name']; ?></li>
<?php } ?>
          </ul>
          <div class="agiclear">&nbsp;</div>
          <?php echo xtc_draw_form('google_taxonomie',FILENAME_AGI_GOOGLE_TAXONOMIE,'action=save','POST'); ?>
          <ul class="agi_language_list_area" id="agilagtabarea">
<?php foreach ($languages as $arrayKey => $langdata) { ?>
            <li <?php echo $arrayKey == 0 ? 'class="active"' : ''; ?>>
              <table class="infoBoxHeading" width="100%">
                <tr>
                  <td width="250">export/google_taxonomie.<?php echo $langdata['code']; ?>.txt</td>
                  <td><?php echo $google_text[$langdata['id']]; ?></td>
                </tr>
                <tr>
                  <td width="250">export/google_taxonomie.<?php echo $langdata['code']; ?>.json.js</td>
                  <td><?php echo $google_json[$langdata['id']]; ?></td>
                </tr>
                <tr>
                  <td width="250">Google Taxonomy.<?php echo getTaxonomyLangCode($langdata['code']);?>.txt</td>
                  <td><a href="http://www.google.com/basepages/producttype/taxonomy.<?php echo getTaxonomyLangCode($langdata['code']);?>.txt" onclick="window.open(this.href,'_blank',''); return false;">http://www.google.com/basepages/producttype/taxonomy.<?php echo getTaxonomyLangCode($langdata['code']);?>.txt</a></td>
                </tr>
              </table>
              <table width="100%"  border="0" cellspacing="5" cellpadding="0">
                <tr>
                  <td class="pageHeading"><?php echo TEXT_GOOGLE_TAXONOMY_FILE.' '.$langdata['name']; ?>:</td>
                </tr>
                <tr>
                  <td class="dataTableHeadingContent">
                    <p><?php echo TEXT_GOOGLE_TAXONOMY_DESC; ?></p>
                    <?php echo xtc_draw_textarea_field('google_cats_'.$langdata['code'],'', 60, 30, $google_file[$langdata['id']], 'style="width: 90%"'); ?>
                  </td>
                </tr>
              </table>
            </li>
<?php } ?>
              </ul>
              <p><input type="submit" class="button" onclick="this.blur();" value="<?php echo BUTTON_SAVE; ?>" /></p>
            </form>
          </div>
        </td>
      </tr>
    </table>
  </td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>