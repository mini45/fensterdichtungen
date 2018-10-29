<?php
  $agi_google_destination_options = array(
    array('id' => '', 'text' => TEXT_NONE),
    array('id' => 'Shopping', 'text' => 'Shopping')
  );
  $agi_google_condition_options = array(
    array('id' => 'new', 'text' => TEXT_GOOGLE_CONDITION_NEW),
    array('id' => 'used', 'text' => TEXT_GOOGLE_CONDITION_USED),
    array('id' => 'refurbished', 'text' => TEXT_GOOGLE_CONDITION_REFURBISHED)
  );
  $agi_google_energy_options = array(
    array('id' => '', 'text' => ''),
    array('id' => 'A+++', 'text' => 'A+++'),
    array('id' => 'A++', 'text' => 'A++'),
    array('id' => 'A+', 'text' => 'A+'),
    array('id' => 'A', 'text' => 'A'),
    array('id' => 'B', 'text' => 'B'),
    array('id' => 'C', 'text' => 'C'),
    array('id' => 'D', 'text' => 'D'),
    array('id' => 'E', 'text' => 'E'),
    array('id' => 'F', 'text' => 'F'),
    array('id' => 'G', 'text' => 'G')
  );
  $clothing_gender_options = array(
    array('id' => 'unisex', 'text' => AGI_GOOGLE_ATTRIBUTE_GENDER_UNISEX),
    array('id' => 'female', 'text' => AGI_GOOGLE_ATTRIBUTE_GENDER_FEMALE),
    array('id' => 'male', 'text' => AGI_GOOGLE_ATTRIBUTE_GENDER_MALE)
  );
  $clothing_age_group_options = array(
    array('id' => 'adult', 'text' => AGI_GOOGLE_ATTRIBUTE_AGE_GROUP_ADULT),
    array('id' => 'kids', 'text' => AGI_GOOGLE_ATTRIBUTE_AGE_GROUP_KIDS),
    array('id' => 'newborn', 'text' => AGI_GOOGLE_ATTRIBUTE_AGE_GROUP_NEWBORN),
    array('id' => 'infant', 'text' => AGI_GOOGLE_ATTRIBUTE_AGE_GROUP_INFANT),
    array('id' => 'toddler', 'text' => AGI_GOOGLE_ATTRIBUTE_AGE_GROUP_TODDLER)
  );
  $clothing_size_type = array(
    array('id' => '', 'text' => ''),
    array('id' => 'regular', 'text' => AGI_GOOGLE_ATTRIBUTE_SIZE_TYPE_REGULAR),
    array('id' => 'petite', 'text' => AGI_GOOGLE_ATTRIBUTE_SIZE_TYPE_PETITE),
    array('id' => 'plus', 'text' => AGI_GOOGLE_ATTRIBUTE_SIZE_TYPE_PLUS),
    array('id' => 'maternity', 'text' => AGI_GOOGLE_ATTRIBUTE_SIZE_TYPE_MATERNITY)
  );
  $clothing_size_system = array(
    array('id' => '', 'text' => AGI_GOOGLE_ATTRIBUTE_SIZE_SYSTEM_DEFAULT),
    array('id' => 'US', 'text' => 'US'),
    array('id' => 'UK', 'text' => 'UK'),
    array('id' => 'EU', 'text' => 'EU'),
    array('id' => 'DE', 'text' => 'DE'),
    array('id' => 'FR', 'text' => 'FR'),
    array('id' => 'JP', 'text' => 'JP'),
    array('id' => 'CN', 'text' => 'CN'),
    array('id' => 'IT', 'text' => 'IT'),
    array('id' => 'BR', 'text' => 'BR'),
    array('id' => 'MEX', 'text' => 'MEX'),
    array('id' => 'AU', 'text' => 'AU')
  );
  
  $agi_google_data = array();
  if (!empty($pInfo->products_id))
  {
    $q = xtc_db_query("SELECT * FROM `".TABLE_AGI_PRODUCTS_ADD."` WHERE `products_id`=".$pInfo->products_id);
    $agi_google_data = xtc_db_fetch_array($q);
    $agi_google_data['language_data'] = array();
    $q = xtc_db_query("SELECT * FROM `".TABLE_AGI_PRODUCTS_DESCRIPTION_ADD."` WHERE `products_id`=".$pInfo->products_id);
    while ($qdata = xtc_db_fetch_array($q))
      $agi_google_data['language_data'][$qdata['language_id']] = $qdata;
  }
  function agi_get_value($field, $data)
  {
    $preselect = array(
      'google_export'               => MODULE_AGI_GOOGLE_XML_PRESELECT_EXPORT_ALLOWED == 'TRUE' ? 1 : 0,
      'clothing_product'            => MODULE_AGI_GOOGLE_XML_PRESELECT_CLOTHING_PRODUCT == 'TRUE' ? 1 : 0,
      'google_identifier_exists'    => MODULE_AGI_GOOGLE_XML_PRESELECT_IDENTIFIER_EXISTS == 'TRUE' ? 1 : 0,
      'google_condition'            => MODULE_AGI_GOOGLE_XML_PRESELECT_CONDITION,
      'google_attribute_gender'     => MODULE_AGI_GOOGLE_XML_PRESELECT_GENDER,
      'google_attribute_age_group'  => MODULE_AGI_GOOGLE_XML_PRESELECT_AGEGROUP,
      'google_attribute_size_type'  => MODULE_AGI_GOOGLE_XML_PRESELECT_SIZETYPE
    );
    if (!array_key_exists($field, $data))
      return array_key_exists($field, $preselect) ? $preselect[$field] : null;
    else
      return $data[$field];
  }
  $tmp = defined('AGI_GOOGLE_CUSTOM_LABEL_TITLE') ? unserialize(AGI_GOOGLE_CUSTOM_LABEL_TITLE) : array();
  $google_cl_title = array();
  for ($i=0; $i<=4; $i++) 
  {
    $google_cl_title[$i] = empty($tmp[$i]) ? 'Custom Label '.($i+1) : $tmp[$i];
  }
?>
<table style="width: 100%;" cellspacing="0" cellpadding="3">
  <tr>
    <td><span class="main"><?php echo AGI_GOOGLE_EXPORT_ALLOWED ?></span></td>
    <td><?php echo xtc_draw_selection_field('agi_google_export', 'checkbox', '1', agi_get_value('google_export', $agi_google_data)==1 ? true : false); ?></td>
    <td style="width: 30px"></td>
    <td><span class="main"><?php echo AGI_GOOGLE_ATTRIBUTE_CLOTHING_TITLE ?></span></td>
    <td><?php echo xtc_draw_selection_field('clothing_product', 'checkbox', '1', agi_get_value('clothing_product', $agi_google_data)==1 ? true : false); ?></td>
  </tr>
  <tr>
    <td><span class="main"><?php echo AGI_GOOGLE_IDENTIFIER_EXISTS ?></span></td>
    <td><?php echo xtc_draw_selection_field('agi_google_identifier_exists', 'checkbox', '1', agi_get_value('google_identifier_exists', $agi_google_data)==1 ? true : false); ?></td>
    <td style="width: 30px"></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><span class="main"><?php echo AGI_GOOGLE_CONDITION ?></span></td>
    <td><?php echo xtc_draw_pull_down_menu('agi_google_condition', $agi_google_condition_options, agi_get_value('google_condition', $agi_google_data)); ?></td>
    <td style="width: 30px"></td>
    <td><span class="main"><?php echo AGI_GOOGLE_MULTIPACK_AMOUNT ?></span></td>
    <td><?php echo xtc_draw_input_field('agi_google_multipack_amount', agi_get_value('google_multipack_amount', $agi_google_data), 'style="width:100%"'); ?></td>
  </tr>
  <tr>
    <td><span class="main"><?php echo AGI_GOOGLE_PRODUCTS_BRAND ?></span></td>
    <td><?php echo xtc_draw_input_field('agi_google_products_brand', agi_get_value('google_products_brand', $agi_google_data), 'style="width:100%"'); ?></td>
    <td style="width: 30px"></td>
    <td><span class="main"><?php echo AGI_GOOGLE_ENERGY_EFFICIENCY ?></span></td>
    <td><?php echo xtc_draw_pull_down_menu('agi_google_energy_efficiency', $agi_google_energy_options, agi_get_value('google_energy_efficiency', $agi_google_data)); ?></td>
  </tr>
  <tr>
    <td><span class="main"><?php echo AGI_GOOGLE_ATTRIBUTE_GENDER; ?></span></td>
    <td><?php echo xtc_draw_pull_down_menu('agi_google_attribute_gender', $clothing_gender_options, agi_get_value('google_attribute_gender', $agi_google_data)); ?></td>
    <td style="width: 30px"></td>
    <td><span class="main"><?php echo AGI_GOOGLE_ATTRIBUTE_AGE_GROUP; ?></span></td>
    <td><?php echo xtc_draw_pull_down_menu('agi_google_attribute_age_group', $clothing_age_group_options, agi_get_value('google_attribute_age_group', $agi_google_data)); ?></td>
  </tr>
  <tr>
    <td><span class="main"><?php echo AGI_GOOGLE_ATTRIBUTE_SIZE_TYPE; ?></span></td>
    <td><?php echo xtc_draw_pull_down_menu('agi_google_attribute_size_type', $clothing_size_type, agi_get_value('google_attribute_size_type', $agi_google_data)); ?></td>
    <td style="width: 30px"></td>
    <td><span class="main"><?php echo AGI_GOOGLE_ATTRIBUTE_SIZE_SYSTEM; ?></span></td>
    <td><?php echo xtc_draw_pull_down_menu('agi_google_attribute_size_system', $clothing_size_system, agi_get_value('google_attribute_size_system', $agi_google_data)); ?></td>
  </tr>
  <tr>
    <td><span class="main"><?php echo AGI_GOOGLE_EXCLUDED_DESTINATION ?></span></td>
    <td><?php echo xtc_draw_pull_down_menu('agi_google_excluded_destination', $agi_google_destination_options, agi_get_value('google_excluded_destination', $agi_google_data)); ?></td>
    <td style="width: 30px"></td>
    <td><span class="main"><?php echo AGI_GOOGLE_EXPIRATION_DATE ?></span></td>
    <td><?php echo xtc_draw_input_field('agi_google_expiration_date', agi_get_value('google_expiration_date', $agi_google_data), 'style="width: 135px"'); ?></td>
  </tr>
  <tr>
    <td colspan="5">
      <ul class="agi_language_tabs">
<?php foreach ($languages as $arrayKey => $langdata) { ?>
        <li <?php echo $arrayKey == 0 ? 'class="active"' : ''; ?> onclick="showAgiLanguageTab(this, 'agilagtabarea', '<?php echo $arrayKey; ?>');"><?php echo xtc_image(DIR_WS_LANGUAGES . $langdata['directory'] .'/admin/images/'. $langdata['image'], $langdata['name']) . ' ' . $langdata['name']; ?></li>
<?php } ?>
      </ul>
      <div class="agiclear">&nbsp;</div>
      <ul class="agi_language_list_area" id="agilagtabarea">
<?php
  foreach ($languages as $arrayKey => $langdata) 
  {
    $tmp = agi_get_value('language_data', $agi_google_data);
    if (empty($tmp))
      $tmp = array();
    $plangdata = array_key_exists($langdata['id'], $tmp) ? $tmp[$langdata['id']] : array();
?>
        <li <?php echo $arrayKey == 0 ? 'class="active"' : ''; ?>>
          <table style="width: 100%;" cellspacing="0" cellpadding="3">
            <tr>
              <td colspan="5" class="main">
                <small><?php echo AGI_GOOGLE_ATTRIBUTE_CLOTHING_DESC; ?></small>
              </td>
            </tr>
            <tr>
              <td><span class="main"><?php echo AGI_GOOGLE_ATTRIBUTE_COLOR; ?></span></td>
              <td><?php echo xtc_draw_input_field('agi_google_attribute_color_'.$langdata['id'], agi_get_value('google_attribute_color', $plangdata), 'style="width:100%"'); ?></td>
              <td style="width: 30px"></td>
              <td><span class="main"><?php echo AGI_GOOGLE_ATTRIBUTE_SIZE; ?></span></td>
              <td><?php echo xtc_draw_input_field('agi_google_attribute_size_'.$langdata['id'], agi_get_value('google_attribute_size', $plangdata), 'style="width:100%"'); ?></td>
            </tr>
            <tr>
              <td><span class="main"><?php echo AGI_GOOGLE_ATTRIBUTE_PATTERN; ?></span></td>
              <td><?php echo xtc_draw_input_field('agi_google_attribute_pattern_'.$langdata['id'], agi_get_value('google_attribute_pattern', $plangdata), 'style="width:100%"'); ?></td>
              <td style="width: 30px"></td>
              <td><span class="main"><?php echo AGI_GOOGLE_ATTRIBUTE_MATERIAL; ?></span></td>
              <td><?php echo xtc_draw_input_field('agi_google_attribute_material_'.$langdata['id'], agi_get_value('google_attribute_material', $plangdata), 'style="width:100%"'); ?></td>
            </tr>
            <tr>
              <td colspan="5">
                <hr />
              </td>
            </tr>
            <tr>
              <td><span class="main"><?php echo AGI_GOOGLE_ADWORDS_GROUPING ?></span></td>
              <td><?php echo xtc_draw_input_field('agi_google_adwords_grouping_'.$langdata['id'], agi_get_value('google_adwords_grouping', $plangdata), 'style="width:100%"'); ?></td>
              <td style="width: 30px"></td>
              <td><span class="main"><?php echo AGI_GOOGLE_ADWORDS_LABELS ?></span></td>
              <td><?php echo xtc_draw_input_field('agi_google_adwords_labels_'.$langdata['id'], agi_get_value('google_adwords_labels', $plangdata), 'style="width:100%"'); ?></td>
            </tr>
            <tr>
              <td><span class="main"><?php echo AGI_GOOGLE_ADWORDS_REDIRECT ?></span></td>
              <td colspan="4"><?php echo xtc_draw_input_field('agi_google_adwords_redirect_'.$langdata['id'], agi_get_value('google_adwords_redirect', $plangdata), 'style="width:100%"'); ?></td>
            </tr>
            <tr>
              <td><span class="main"><?php echo AGI_GOOGLE_MOBILE_LINK ?></span></td>
              <td colspan="4"><?php echo xtc_draw_input_field('agi_google_mobile_link_'.$langdata['id'], agi_get_value('google_mobile_link', $plangdata), 'style="width:100%"'); ?></td>
            </tr>
            <tr>
              <td><span class="main"><?php echo AGI_GOOGLE_ALTERNATIVE_TITLE ?></span></td>
              <td colspan="4"><?php echo xtc_draw_input_field('agi_google_alternative_title_'.$langdata['id'], agi_get_value('google_alternative_title', $plangdata), 'style="width:100%"'); ?></td>
            </tr>
            <tr>
              <td><span class="main"><?php echo AGI_GOOGLE_CUSTOM_LABEL ?></span></td>
              <td colspan="4">
                <table style="width: 100%;" cellspacing="0" cellpadding="1" >
                  <tr> 
                  <?php for ($i=0; $i<=4; $i++) { ?>
                    <th><span class="main"><?php echo $google_cl_title[$i]; ?></span></th>
                  <?php } ?>
                  </tr>
                  <tr>
                  <?php for ($i=0; $i<=4; $i++) { ?>
                    <td><?php echo xtc_draw_input_field('agi_google_custom_label'.$i.'_'.$langdata['id'], agi_get_value('google_custom_label'.$i, $plangdata), 'style="width:90%"'); ?></td>
                  <?php } ?>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td><span class="main"><?php echo AGI_GOOGLE_CATEGORY; ?></span>
              <td colspan="4">
              <span class="main"><small><?php echo AGI_GOOGLE_CATEGORY_DESC; ?></small></span><br />
              <?php echo xtc_draw_input_field('google_category_'.$langdata['id'], agi_get_value('google_category', $plangdata), 'size="50" style="width: 100%"'); ?></td>
            </tr>
            <tr>
              <td colspan="5"><div id="g_taxonomie_select_<?php echo $langdata['id']; ?>" class="g_taxonomie_select"></div></td>
            </tr>
          </table>
          <script type="text/javascript" src="../export/google_taxonomie.<?php echo $langdata['code']; ?>.json.js"></script>
          <script type="text/javascript">
          /* <![CDATA[ */
            if (g_taxonimie_<?php echo $langdata['code']; ?> && document.getElementById('g_taxonomie_select_<?php echo $langdata['id']; ?>') && document.getElementsByName('google_category_<?php echo $langdata['id']; ?>'))
              create_agi_google_taxonomie(<?php echo $langdata['id'].",'".$langdata['code']."'"; ?>);
          /* ]]> */
          </script>
        </li>
<?php } ?>
      </ul>
      <script type="text/javascript">
      /* <![CDATA[ */
        var target_elements = new Array('google_category');
      /* ]]> */
      </script>
    </td>
  </tr>
  <tr>
    <td colspan="5"><span class="main"><a href="https://support.google.com/merchants/answer/188494" target="_blank">https://support.google.com/merchants/answer/188494</a></span></td>
  </tr>
</table>