<?php
/* admin/agi_google_xml_export.php
.---------------------------------------------------------------------------.
|    Software: GOOGLE-Shopping XML-Export for modified-eCommerce            |
|      Author: Andreas Guder                                                |
|     Version: 1                                                            |
|     Contact: info@andreas-guder.de / http://www.andreas-guder.de          |
| Copyright (c) 2014, Andreas Guder [info@andreas-guder.de]                 |
|               GNU General Public License                                  |
'--------------------------------------------------------------------------ö'
*/
  require('includes/application_top.php');
  
function agi_cfg_select_option($select_array, $key_name, $key_value) {
  reset($select_array);
  while (list ($key, $value) = each($select_array)) {
    if (is_int($key))
      $key = $value;
    $string .= '<br /><input type="radio" name="'.$key_name.'" value="'.$key.'"';
    if ($key_value == $key)
      $string .= ' checked="checked"';
    $string .= '> '.$value;
  }
  return $string;
}

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $gID = 46163; // AGIGoogleExport
  if (xtc_not_null($action)) {
    switch ($action) {
      case 'save':
        // update changed configurations
        $configuration_query = xtc_db_query("select configuration_key,configuration_id, configuration_value, use_function,set_function from " . TABLE_CONFIGURATION . " where configuration_group_id = '" . (int)$gID . "' AND `configuration_key` != 'MODULE_AGI_GOOGLE_XML_VERSION' order by sort_order");
        while ($configuration = xtc_db_fetch_array($configuration_query)) {
          $configuration['configuration_value'] = stripslashes($configuration['configuration_value']);
          if ($_POST[$configuration['configuration_key']] != $configuration['configuration_value']) {
            //value_limits min
            if (isset($value_limits[$configuration['configuration_key']]['min']) && preg_match ("/^([0-9]+)$/", $_POST[$configuration['configuration_key']]) &&  (int)$_POST[$configuration['configuration_key']] < $value_limits[$configuration['configuration_key']]['min']) {
              $configuration_key_title = constant(strtoupper($configuration['configuration_key'].'_TITLE'));
              $messageStack->add_session(sprintf(CONFIG_MIN_VALUE_WARNING,$configuration_key_title,$_POST[$configuration['configuration_key']],$value_limits[$configuration['configuration_key']]['min'] ), 'warning');
              $_POST[$configuration['configuration_key']] = (int)$configuration['configuration_value'];
            }
            //value_limits max
            if (isset($value_limits[$configuration['configuration_key']]['max']) && preg_match ("/^([0-9]+)$/", $_POST[$configuration['configuration_key']]) &&  (int)$_POST[$configuration['configuration_key']] > $value_limits[$configuration['configuration_key']]['max']) {
              $configuration_key_title = constant(strtoupper($configuration['configuration_key'].'_TITLE'));
              $messageStack->add_session(sprintf(CONFIG_MAX_VALUE_WARNING,$configuration_key_title,$_POST[$configuration['configuration_key']],$value_limits[$configuration['configuration_key']]['max'] ), 'warning');
              $_POST[$configuration['configuration_key']] = (int)$configuration['configuration_value'];
            }
            //check numeric input
            if (!preg_match ("/^([0-9]+)$/", $_POST[$configuration['configuration_key']]) && (isset($value_limits[$configuration['configuration_key']]['min']) || isset($value_limits[$configuration['configuration_key']]['max']))) {
              $_POST[$configuration['configuration_key']] = (int)$configuration['configuration_value'];
              $configuration_key_title = constant(strtoupper($configuration['configuration_key'].'_TITLE'));
              $messageStack->add_session(sprintf(CONFIG_INT_VALUE_ERROR,$configuration_key_title,$_POST[$configuration['configuration_key']],''), 'error');
            }
            xtc_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value='" . xtc_db_input($_POST[$configuration['configuration_key']]) . "', last_modified = NOW() where configuration_key='" . $configuration['configuration_key'] . "'");
          }
        }
        xtc_redirect(xtc_href_link(FILENAME_AGI_GOOGLE_XML_EXPORT));
        break;
    }
  }
  
  require (DIR_WS_INCLUDES.'head.php');
?>
    <script type="text/javascript" src="includes/general.js"></script>
  </head>
  <body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">
    <!-- header //-->
    <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
    <!-- header_eof //-->
    <!-- body //-->
    <table border="0" width="100%" cellspacing="2" cellpadding="2">
      <tr>
        <td class="columnLeft2" width="<?php echo BOX_WIDTH; ?>" valign="top">
          <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
            <!-- left_navigation //-->
            <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
            <!-- left_navigation_eof //-->
          </table>
        </td>
        <!-- body_text //-->
        <td class="boxCenter" width="100%" valign="top">
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td>
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="80" rowspan="2"><?php echo xtc_image(DIR_WS_ICONS.'heading_configuration.gif'); ?></td>
                    <td width="300" class="pageHeading">
                      <?php echo AGI_GOOGLE_XML_EXPORT_TITLE; ?>
                    </td>
                    <td rowspan="2" class="pageHeading">
                      <?php if (defined('MODULE_AGI_GOOGLE_XML_VERSION')) echo 'V '.number_format((MODULE_AGI_GOOGLE_XML_VERSION/100),2,'.',''); ?>
                      <br /><a href="http://www.andreas-guder.de" target="_blank">by AGI Internetagentur Andreas Guder | www.andreas-guder.de</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="main" valign="top"><?php echo CONFIGURATION; ?></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="border-top: 3px solid; border-color: #cccccc;" class="main">
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top" align="right">
                      <?php echo xtc_draw_form('configuration', FILENAME_AGI_GOOGLE_XML_EXPORT, 'gID=' . (int)$gID . '&action=save'); ?>
                        <table width="100%"  border="0" cellspacing="0" cellpadding="8">
                          <?php
                            $configuration_query = xtc_db_query("select configuration_key,configuration_id, configuration_value, use_function,set_function from " . TABLE_CONFIGURATION . " where configuration_group_id = '" . (int)$gID . "' AND `configuration_key` != 'MODULE_AGI_GOOGLE_XML_VERSION' order by sort_order");
                            while ($configuration = xtc_db_fetch_array($configuration_query)) {
                              $configuration['configuration_value'] = stripslashes($configuration['configuration_value']); //Web28 - 2012-08-09 - fix slashes
                              if (xtc_not_null($configuration['use_function'])) {
                                $use_function = $configuration['use_function'];
                                if (preg_match('/->/', $use_function)) { // Hetfield - 2009-08-19 - replaced deprecated function ereg with preg_match to be ready for PHP >= 5.3
                                  $class_method = explode('->', $use_function);
                                  if (!is_object(${$class_method[0]})) {
                                    include(DIR_WS_CLASSES . $class_method[0] . '.php');
                                    ${$class_method[0]} = new $class_method[0]();
                                  }
                                  $cfgValue = xtc_call_function($class_method[1], $configuration['configuration_value'], ${$class_method[0]});
                                } else {
                                  $cfgValue = xtc_call_function($use_function, $configuration['configuration_value']);
                                }
                              } else {
                                $cfgValue = $configuration['configuration_value'];
                              }
                              if ($configuration['set_function']) {
                                eval('$value_field = ' . $configuration['set_function'] . '"' . encode_htmlspecialchars($configuration['configuration_value']) . '");');
                              } else {
                                $value_field = xtc_draw_input_field($configuration['configuration_key'], $configuration['configuration_value'],'style="width:380px;"');
                              }
                              if (strstr($value_field,'configuration_value')) {
                                $value_field=str_replace('configuration_value',$configuration['configuration_key'],$value_field);
                              }

                              // catch up warnings if no language-text defined for configuration-key
                              $configuration_key_title = strtoupper($configuration['configuration_key'].'_TITLE');
                              $configuration_key_desc  = strtoupper($configuration['configuration_key'].'_DESC');
                              if( defined($configuration_key_title) ) {                                          // if language definition
                                $configuration_key_title = constant($configuration_key_title);
                                $configuration_key_desc  = constant($configuration_key_desc);
                              } else {                                                                          // if no language
                                $configuration_key_title = $configuration['configuration_key'];                 // name = key
                                $configuration_key_desc  = '&nbsp;';                                            // description = empty
                              }
                              if ($configuration_key_desc!=str_replace("<meta ","",$configuration_key_desc)) {
                                $configuration_key_desc = encode_htmlentities($configuration_key_desc);
                              }
                              echo '
                                    <tr>
                                      <td style="min-width:20%; border-bottom: 1px solid #aaaaaa;" class="dataTableContent"><b>'.$configuration_key_title.'</b></td>
                                      <td style="min-width:20%; border-bottom: 1px solid #aaaaaa; background-color:#e8e8e8;" class="dataTableContent">'.$value_field.'</td>
                                      <td style="min-width:60%; border-bottom: 1px solid #aaaaaa;empty-cells: show;" class="dataTableContent">'.$configuration_key_desc.'</td>
                                    </tr>
                                   ';

                            }
                          ?>
                        </table>
                        <?php echo '<input type="submit" class="button" onclick="this.blur();" value="' . BUTTON_SAVE . '"/>'; ?>
                      </form>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
<div class="main">
  <p><strong>Einrichtung:</strong></p>
  <p>
    <span style="text-decoration: underline;">Google-Kategorien:</span><br /><br />
    Beim Erstellen der Exportdatei werden den Produkten die Google-Kategorien zugeordnet.<br />Ist dem Produkt in den Produktdetails keine Google-Kategorie zugeordnet, erbt es die Google-Kategorie aus der dazugeh&ouml;rigen Shop-Kategorie.<br />Shop-Kategorien erben die Google-Kategorien ebenfalls aus den jeweils &uuml;bergeordneten Shop-Kategorien, sofern diesen nicht explizit eine Google-Kategorie zugeordnet wurde.<br />Kann dem Produkt auch &uuml;ber die Shop-Kategorien keine Google-Kategorie zugeordnet werden, wird die hier festgelegte Standard-Google-Kategorie verwendet.<br />
    Ihre ben&ouml;tigten Google-Kategorien geben Sie im Men&uuml; &quot;Google-Taxonomie&quot; ein. Diese steht Ihnen eine Auswahlliste in den Produktdetails und den Kategorien zur Verf&uuml;gung.
  </p>
  <p>
    <span style="text-decoration: underline;">Attribute:</span><br /><br />
    Es werden nur die Attribute exportiert, deren Merkmalen im Men&uuml; &quot;Artikelmerkmale&quot; ein Google-Attribut zugeordnet wurde.<br />
    Da Ihre m&ouml;glichen Optionswerte nicht immer mit den zul&auml;ssigen Google-Werten &uuml;bereinstimmen, m&uuml;ssen Sie Ihre Optionswerte f&uuml;r Google &uuml;bersetzen.<br />Dazu geben Sie auf dieser Seite jeweils unter &quot;Attributwerte f&uuml;r...&quot; an, welche Ihrer verwendeten Optionswerte dem angegebene Google-Attributswert entspricht.<br />
    In den Produkteinstellungen selbst lassen sich die vorhandenen Produktattribute &uuml;berschreiben oder erg&auml;nzen, falls dies erforderlich ist.<br /><br />
    Sie k&ouml;nnen zu jedem Ihrer Produktbilder angeben, welche Attribute sie abbilden.
  </p>
  <p>
    <span style="text-decoration: underline;">Lieferstatus:</span><br /><br />
    Im Men&uuml; &quot;Konfiguration / Lieferstatus&quot; k&ouml;nnen Sie jedem Status den passenden Google-Status zuordnen.
  </p>
  <p>
    <span style="text-decoration: underline;">Google-Merchant-Center:</span>
  </p>
  <p>Legen Sie im Google-Merchant-Center einen neuen Datenfeed an:</p>
  <ol>
    <li>
      <ul>
        <li>Modus: Standard</li>
        <li>Feed-Typ: Produkte</li>
        <li>Zielland: Zielland w&auml;hlen</li>
        <li>Name: frei w&auml;hlbar</li>
      </ul>
    </li>
    <li>Klicken Sie auf &quot;weiter&quot;.</li>
    <li>W&auml;hlen Sie die Upload-Methode &quot;Automatischer Upload (geplanter Abruf)&quot;.</li>
    <li>Klicken Sie auf &quot;weiter&quot;.</li>
    <li>
      <ul>
        <li>Name der abzurufenden Datei: frei w&auml;hlbar</li>
        <li>H&auml;figkeit, Uhrzeit, Zeitzone nach Bedarf einstellen</li>
        <li>Feed-URL: <em>&quot;<?php echo HTTP_SERVER.DIR_WS_CATALOG; ?>export/google_xml.php&quot;</em></li>
      </ul>
    </li>
    <li>Klicken Sie auf &quot;Speichern&quot;.</li>
  </ol>
  <br /><br />
  <p><strong>Funktion:</strong></p>
  <p><span style="text-decoration: underline;">Caching:</span> Bei Aufruf der URL <em>&quot;<?php echo HTTP_SERVER.DIR_WS_CATALOG; ?>export/google_xml.php&quot;</em> wird der Google-Feed erstellt, gespeichert und ausgegeben.<br />Erfolgt innerhalb der n&auml;chsten 24 Stunden ein weiterer Aufruf der URL, so wird nur der zwischengespeicherte Feed ausgegeben.<br />Erst nach 24 Stunden wird ein neuer Feed erstellt.</p>
  <p>Stehen Ihnen Cronjobs zur Verf&uuml;gung, k&ouml;nnen Sie die URL &uuml;ber diese abrufen und den Feed erstellen lassen.<br />Wenn Google anschlie&szlig;end die URL abruft, erh&auml;lt es sofort die zwischengespeicherte Datei und muss nicht erst deren Erstellung abwarten.</p>
  <p>Sie k&ouml;nnen die Cache-Funktion des Feeds umgehen, indem Sie die URL mit dem Parameter <em>cache=0</em> aufrufen.<br />Damit wird sofort die neue Datei erstellt.<br /><em>&quot;<?php echo HTTP_SERVER.DIR_WS_CATALOG; ?>export/google_xml.php?cache=0&quot;</em></p>
  <p><span style="text-decoration: underline;">Pagination:</span> Ist Ihr Server aufgrund von Speicher oder Laufzeit-Begrenzungen nicht in der Lage, den kompletten Feed zu erstellen, k&ouml;nnen Sie die partielle Erstellung nutzen:<br />Legen Sie auf dieser Seite fest, wieviele Produkte maximal pro Feed ausgegeben werden sollen.<br />Anschlie&szlig;end k&ouml;nnen Sie mehrere Datenfeeds anlegen. Erg&auml;nzen Sie die URL um den Parameter <em>page=1, page=2, page=... usw.</em>. Der urspr&uuml;nglich komplette Feed wird jetzt auf mehrere Seiten aufgeteilt und die jeweils in der URL angegebene Seite wird ausgegeben.</p>
  <p><span style="text-decoration: underline;">nicht exportiert:</span> werden Produkte, die nicht aktiviert sind, oder deren Google-Export nicht erlaubt ist. Ebenso werden Produkte ohne Bild oder mit einem Preis &lt;= 0 nicht exportiert. Ob Bilder vorhanden sind, oder der Preis gr&ouml;&szlig;er 0 ist, kann jedoch erst beim Erstellen des Feeds festgestellt werden. Dadurch kann die Produktanzahl im Feed geringer sein, als die hier angegeben maximale Anzahl.</p>
  <br /><br />
  <p><strong>URL-Parameter:</strong></p>
  <p>&Uuml;ber folgende Parameter kann der Inhalt des Feeds gesteuert werden:<br /><em>Paramater sind in beliebiger Reihenfolge an die URL anzuf&uuml;gen: <?php echo HTTP_SERVER.DIR_WS_CATALOG; ?>export/google_xml.php?cache=0&amp;page=1&amp;hersteller=1&amp;lang=1</em></p>
  <table border="1" cellspacing="1" cellpadding="3">
    <tr><th>Parameter</th><th>Beschreibung</th><th>m&ouml;gliche Werte</th><th>Standard, wenn Parameter nicht angegeben</th></tr>
    <tr>
      <td>cache</td><td>Tage der Zwischenspeicherung des Feeds</td><td>Zahl: 0-x</td><td>1</td>
    </tr>
    <tr>
      <td>page</td><td>Seite des auszugebenden Feeds</td><td>Zahl: 1-x</td><td>0</td>
    </tr>
    <tr>
      <td>lang</td><td>Id der Sprache</td><td>Zahl: 1-x</td><td>2</td>
    </tr>
    <tr>
      <td>group</td><td>Id der Kundengruppe</td><td>Zahl: 1-x</td><td>1</td>
    </tr>
    <tr>
      <td>country</td><td>Id des Landes</td><td>Zahl: 1-x</td><td>0 (Shop-Standard)</td>
    </tr>
    <tr>
      <td>zone</td><td>Id der Zone</td><td>Zahl: 1-x</td><td>0 (Shop-Standard)</td>
    </tr>
    <tr>
      <td>curr</td><td>Code der W&auml;hrung</td><td>W&auml;hrungscode</td><td><em>leer</em> (Shop-Standard)</td>
    </tr>
    <tr>
      <td>add_shipping</td><td>Aufschlag auf die berechneten Versandkosten in ct</td><td>Ganzzahl</td><td>0</td>
    </tr>
    <tr>
      <td>hersteller</td><td>Id des Herstellers, mehrere IDs kommagetrennt</td><td>Zahl 1-x bzw. 1,2,x</td><td>0 (alle Hersteller)</td>
    </tr>
    <tr>
      <td>out</td><td>Wenn gesetzt, wird der Feed nur gespeichert, nicht ausgegeben</td><td>false</td><td></td>
    </tr>
  </table>
</div>
        </td>
        <!-- body_text_eof //-->
      </tr>
    </table>
    <!-- body_eof //-->
    <!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <!-- footer_eof //-->
    <br />
  </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>