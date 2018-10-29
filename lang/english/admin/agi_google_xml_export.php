<?php
/* lang/german/admin/agi_google_xml_export.php
.---------------------------------------------------------------------------.
|    Software: GOOGLE-Shopping XML-Export for modified-eCommerce            |
|      Author: Andreas Guder                                                |
|     Version: 1                                                            |
|     Contact: info@andreas-guder.de / http://www.andreas-guder.de          |
| Copyright (c) 2014, Andreas Guder [info@andreas-guder.de]                 |
|               GNU General Public License                                  |
'--------------------------------------------------------------------------ö'
*/

define('AGI_GOOGLE_XML_EXPORT_TITLE', 'AGI Google-XML-Datenfeed');
define('MODULE_AGI_GOOGLE_XML_STATUS_TITLE', 'Modul aktiv');
define('MODULE_AGI_GOOGLE_XML_STATUS_DESC', 'Soll das Modul aktiviert werden?');
define('MODULE_AGI_GOOGLE_XML_VPE_TITLE_TITLE', 'Grundpreis im Titel');
define('MODULE_AGI_GOOGLE_XML_VPE_TITLE_DESC', 'Die Grundpreisauszeichnung wird an den Produkttitel angef&uuml;gt');
define('MODULE_AGI_GOOGLE_XML_VPE_DESCRIPTION_TITLE', 'Grundpreis in der Beschreibung');
define('MODULE_AGI_GOOGLE_XML_VPE_DESCRIPTION_DESC', 'Die Grundpreisauszeichnung wird der Beschreibung vorangestellt');
define('MODULE_AGI_GOOGLE_XML_LONG_DESCRIPTION_TITLE', 'Artikelbeschreibung exportieren');
define('MODULE_AGI_GOOGLE_XML_LONG_DESCRIPTION_DESC', 'Artikelbeschreibung anstelle der Kurzbeschreibung exportieren?');
define('MODULE_AGI_GOOGLE_XML_AVAILABILITY_FROM_TITLE', 'Verf&uuml;gbarkeit abh&auml;ngig von');
define('MODULE_AGI_GOOGLE_XML_AVAILABILITY_FROM_DESC', 'Die Verf&uuml;gbarkeit wird ermittelt aus');
define('MODULE_AGI_GOOGLE_XML_SHIPPING_LIST_TITLE', 'Versandkosten');
define('MODULE_AGI_GOOGLE_XML_SHIPPING_LIST_DESC', 'Die Versandkosten basieren auf dem Artikelpreis oder dem Artikelgewicht. Beispiel: 25:4.90,50:9.90,etc.. Bis 25 werden 4.90 verrechnet, dar&uuml;ber bis 50 werden 9.90 verrechnet, etc.<br />F&uuml;r unterschiedliche L&auml;nder schreiben Sie den L&auml;ndercode gefolgt von zwei Doppelpunkten vor den Versandkosteblock, trennen Sie die Bl&ouml;cke durch ein Semikolon. <br />Beispiel: DE::25:4.90,50:9.90;AT::25:8.90,50:15.90');
define('MODULE_AGI_GOOGLE_XML_SHIPPING_BASE_TITLE', 'Versandkosten-Basis');
define('MODULE_AGI_GOOGLE_XML_SHIPPING_BASE_DESC', 'Die Versandkosten basieren auf dem Artikelpreis oder dem Artikelgewicht.');
define('MODULE_AGI_GOOGLE_CHECK_GRADUATED_PRICE_TITLE', 'Staffelpreise beachten');
define('MODULE_AGI_GOOGLE_CHECK_GRADUATED_PRICE_DESC', 'der g&uuml;nstigste Staffelpreis wird zu Google übertragen');
define('MODULE_AGI_GOOGLE_IGNORE_FREESHIPPING_MODULES_TITLE', 'Versandkostenfrei-Einstellungen ignorieren');
define('MODULE_AGI_GOOGLE_IGNORE_FREESHIPPING_MODULES_DESC', 'Einstellungen aus den Modulen ot_shipping und freeamount, durch die Versand ab einem bestimmten Preis kostenfrei wird, werden ignoriert.');

define('MODULE_AGI_GOOGLE_XML_GENDER_WORDS_MALE_TITLE', 'Attributwerte f&uuml;r &quot;Herren&quot;');
define('MODULE_AGI_GOOGLE_XML_GENDER_WORDS_MALE_DESC', 'Geben Sie die verwendeten Optionswerte der Artikelmerkmale an, die f&uuml;r &quot;m&auml;nnlich&quot; stehen. (klein, mit Komma hintereinander)<br /><small>Arbeiten Sie mehrsprachig, geben Sie die Werte wiefolgt an: 2stelligerSprachcode:Wert1,Wert2;2stelligerSprachcode:Wert1,Wert2</small><br /><small>(Beispiel: de:wert1,wert2,wert3;en:value1,value2,value3)</small>');
define('MODULE_AGI_GOOGLE_XML_GENDER_WORDS_FEMALE_TITLE', 'Attributwerte f&uuml;r &quot;Damen&quot;');
define('MODULE_AGI_GOOGLE_XML_GENDER_WORDS_FEMALE_DESC', 'Geben Sie die verwendeten Optionswerte der Artikelmerkmale an, die f&uuml;r &quot;weiblich&quot; stehen. (klein, mit Komma hintereinander)<br /><small>Arbeiten Sie mehrsprachig, geben Sie die Werte wiefolgt an: 2stelligerSprachcode:Wert1,Wert2;2stelligerSprachcode:Wert1,Wert2</small><br /><small>(Beispiel: de:wert1,wert2,wert3;en:value1,value2,value3)</small>');
define('MODULE_AGI_GOOGLE_XML_GENDER_WORDS_UNISEX_TITLE', 'Attributwerte f&uuml;r &quot;Unisex&quot;');
define('MODULE_AGI_GOOGLE_XML_GENDER_WORDS_UNISEX_DESC', 'Geben Sie die verwendeten Optionswerte der Artikelmerkmale an, die f&uuml;r &quot;geschlechtsneutral&quot; stehen. (klein, mit Komma hintereinander)<br /><small>Arbeiten Sie mehrsprachig, geben Sie die Werte wiefolgt an: 2stelligerSprachcode:Wert1,Wert2;2stelligerSprachcode:Wert1,Wert2</small><br /><small>(Beispiel: de:wert1,wert2,wert3;en:value1,value2,value3)</small>');
define('MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_NEWBORN_TITLE', 'Attributwerte f&uuml;r &quot;Neugeborene bis 3 Monate&quot;');
define('MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_NEWBORN_DESC', 'Geben Sie die verwendeten Optionswerte der Artikelmerkmale an, die f&uuml;r &quot;Neugeborene&quot; stehen. (klein, mit Komma hintereinander)<br /><small>Arbeiten Sie mehrsprachig, geben Sie die Werte wiefolgt an: 2stelligerSprachcode:Wert1,Wert2;2stelligerSprachcode:Wert1,Wert2</small><br /><small>(Beispiel: de:wert1,wert2,wert3;en:value1,value2,value3)</small>');
define('MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_INFANT_TITLE', 'Attributwerte f&uuml;r &quot;S&auml;uglinge bis 12 Monate&quot;');
define('MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_INFANT_DESC', 'Geben Sie die verwendeten Optionswerte der Artikelmerkmale an, die f&uuml;r &quot;S&auml;uglinge&quot; stehen. (klein, mit Komma hintereinander)<br /><small>Arbeiten Sie mehrsprachig, geben Sie die Werte wiefolgt an: 2stelligerSprachcode:Wert1,Wert2;2stelligerSprachcode:Wert1,Wert2</small><br /><small>(Beispiel: de:wert1,wert2,wert3;en:value1,value2,value3)</small>');
define('MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_TODDLER_TITLE', 'Attributwerte f&uuml;r &quot;Kleinkinder bis 5 Jahre&quot;');
define('MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_TODDLER_DESC', 'Geben Sie die verwendeten Optionswerte der Artikelmerkmale an, die f&uuml;r &quot;Kleinkinder&quot; stehen. (klein, mit Komma hintereinander)<br /><small>Arbeiten Sie mehrsprachig, geben Sie die Werte wiefolgt an: 2stelligerSprachcode:Wert1,Wert2;2stelligerSprachcode:Wert1,Wert2</small><br /><small>(Beispiel: de:wert1,wert2,wert3;en:value1,value2,value3)</small>');
define('MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_KIDS_TITLE', 'Attributwerte f&uuml;r &quot;Kinder&quot;');
define('MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_KIDS_DESC', 'Geben Sie die verwendeten Optionswerte der Artikelmerkmale an, die f&uuml;r &quot;Kinder&quot; stehen. (klein, mit Komma hintereinander)<br /><small>Arbeiten Sie mehrsprachig, geben Sie die Werte wiefolgt an: 2stelligerSprachcode:Wert1,Wert2;2stelligerSprachcode:Wert1,Wert2</small><br /><small>(Beispiel: de:wert1,wert2,wert3;en:value1,value2,value3)</small>');
define('MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_ADULT_TITLE', 'Attributwerte f&uuml;r &quot;Erwachsen&quot;');
define('MODULE_AGI_GOOGLE_XML_AGE_GROUP_WORDS_ADULT_DESC', 'Geben Sie die verwendeten Optionswerte der Artikelmerkmale an, die f&uuml;r &quot;Erwachsene&quot; stehen. (klein, mit Komma hintereinander)<br /><small>Arbeiten Sie mehrsprachig, geben Sie die Werte wiefolgt an: 2stelligerSprachcode:Wert1,Wert2;2stelligerSprachcode:Wert1,Wert2</small><br /><small>(Beispiel: de:wert1,wert2,wert3;en:value1,value2,value3)</small>');
define('MODULE_AGI_GOOGLE_XML_DEFAULT_CATEGORY_TITLE', 'Standard Google-Kategorie');
define('MODULE_AGI_GOOGLE_XML_DEFAULT_CATEGORY_DESC', 'Diese Google-Kategorie wird ausgegeben, wenn dem Produkt keine Google-Kategorie zugeordnet werden kann.Geben Sie leesbare zeichen ein, keine HTML-Kodierung.<br /><small>Arbeiten Sie mehrsprachig, geben Sie die Kategorie wiefolgt an: 2stelligerSprachcode:Google-Kategorie;2stelligerSprachcode:Google-Kategorie</small><br /><small>(Beispiel: de:google_kategorie;en:google_kategorie)</small>');
define('MODULE_AGI_GOOGLE_XML_CAMPAIGN_TITLE', 'Kampagnen-Parameter');
define('MODULE_AGI_GOOGLE_XML_CAMPAIGN_DESC', 'Diese Parameter werden jedem Produktlink angef&uuml;gt. Bspl: pk_campaign=google_shopping');

define('MODULE_AGI_GOOGLE_XML_USE_PRODUCT_IMAGE_TITLE', 'Bilder verwenden');
define('MODULE_AGI_GOOGLE_XML_USE_PRODUCT_IMAGE_DESC', 'Diese Produktbilder werden exportiert.');

define('MODULE_AGI_GOOGLE_XML_IS_GZIP_TITLE', 'Feed-Komprimierung');
define('MODULE_AGI_GOOGLE_XML_IS_GZIP_DESC', 'Soll der Feed gzip-Komprimiert gespeichert und ausgegeben werden?');
define('MODULE_AGI_GOOGLE_XML_SHOP_IS_UTF8_TITLE', 'UTF-8');
define('MODULE_AGI_GOOGLE_XML_SHOP_IS_UTF8_DESC', 'Ihr Shop ist auf UTF-8 eingestellt?');

define('MODULE_AGI_GOOGLE_XML_VPE_VALUES_TITLE', 'Verpackungseinheiten zuordnen');
define('MODULE_AGI_GOOGLE_XML_VPE_VALUES_DESC', 'Google akzeptiert nur bestimmte Preisberechnungseinheiten. Eventuell m&uuml;ssen Sie Ihre Verpackungseinheiten entsprechend &uuml;bersetzen lassen: <em>Meter=m,Kilo=kg...</em> Ordnen Sie Ihren Werten hier dien richtigen Google-Wert zu.<br /><small>Arbeiten Sie mehrsprachig, geben Sie die Werte wiefolgt an: 2stelligerSprachcode:IhrWert1=GoogleWert1,IhrWert2=GoogleWert2;2stelligerSprachcode:IhrWert1=GoogleWert1,IhrWert2=GoogleWert2</small><br /><small>(Beispiel: de:Meter=m,Kilo=kg;en:meter=m,kilo=kg)</small>');
define('MODULE_AGI_GOOGLE_XML_IGNORE_VPE_VALUES_TITLE', 'Verpackungseinheiten ignorieren');
define('MODULE_AGI_GOOGLE_XML_IGNORE_VPE_VALUES_DESC', 'Bei Produkten mit dieser Verpackungseinheit wird keine Grundpreisangabe an Google übergeben.<br /><small>Arbeiten Sie mehrsprachig, geben Sie die Kategorie wiefolgt an: 2stelligerSprachcode:Wert1,Wert2;2stelligerSprachcode:Wert1,Wert2</small><br /><small>(Beispiel: de:St&uuml;ck,Teil;en:piece,part)</small>');

define('MODULE_AGI_GOOGLE_XML_FEED_NB_ARTICLE_TITLE', 'Produkte pro Feed');
define('MODULE_AGI_GOOGLE_XML_FEED_NB_ARTICLE_DESC', 'maximale Anzahl an Produkten pro Feed, sofern Sie den page-Parameter nutzen');

define('MODULE_AGI_GOOGLE_XML_DEFAULT_CL_SIZESYSTEM_TITLE', 'standard Gr&ouml;&szlig;ensystem');
define('MODULE_AGI_GOOGLE_XML_DEFAULT_CL_SIZESYSTEM_DESC', 'F&uuml;r alle Bekleidungsprodukte wird dieses Gr&ouml;&szlig;ensystem exportiert, sofern nicht am Produkt selbst ein Anderes gew&auml;hlt ist.');

define('MODULE_AGI_GOOGLE_XML_PRESELECT_EXPORT_ALLOWED_TITLE', 'Vorbelegung: &quot;Google-Export erlaubt&quot;');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_EXPORT_ALLOWED_DESC', 'Das Feld wird f&uuml;r neue Produkte standardm&auml;&szlig aktiviert.');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_CLOTHING_PRODUCT_TITLE', 'Vorbelegung: &quot;Bekleidungsprodukt&quot;');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_CLOTHING_PRODUCT_DESC', 'Das Feld wird f&uuml;r neue Produkte standardm&auml;&szlig aktiviert.');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_ONLY_ONLINE_TITLE', 'Vorbelegung: &quot;nur online verf&uuml;gbar&quot;');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_ONLY_ONLINE_DESC', 'Das Feld wird f&uuml;r neue Produkte standardm&auml;&szlig aktiviert.');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_IDENTIFIER_EXISTS_TITLE', 'Vorbelegung: &quot;Kennzeichnung existiert&quot;');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_IDENTIFIER_EXISTS_DESC', 'Das Feld wird f&uuml;r neue Produkte standardm&auml;&szlig aktiviert.');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_CONDITION_TITLE', 'Vorbelegung: &quot;Zustand&quot;');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_CONDITION_DESC', 'Der Wert wird f&uuml;r neue Produkte standardm&auml;&szlig gesetzt.');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_GENDER_TITLE', 'Vorbelegung: &quot;Geschlecht&quot;');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_GENDER_DESC', 'Der Wert wird f&uuml;r neue Produkte standardm&auml;&szlig gesetzt.');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_AGEGROUP_TITLE', 'Vorbelegung: &quot;Altersgruppe&quot;');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_AGEGROUP_DESC', 'Der Wert wird f&uuml;r neue Produkte standardm&auml;&szlig gesetzt.');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_SIZETYPE_TITLE', 'Vorbelegung: &quot;Gr&ouml;&szlig;entyp&quot;');
define('MODULE_AGI_GOOGLE_XML_PRESELECT_SIZETYPE_DESC', 'Der Wert wird f&uuml;r neue Produkte standardm&auml;&szlig gesetzt.');
define('MODULE_AGI_GOOGLE_XML_MOBILE_LINK_TITLE', 'URL f&uuml;r moblie Seiten');
define('MODULE_AGI_GOOGLE_XML_MOBILE_LINK_DESC', 'Woher sollen die URLs f&uuml;r mobile Seiten bezogen werden?');
define('MODULE_AGI_GOOGLE_XML_MOBILE_LINK_PARAMETER_TITLE', 'Parameter f&uuml;r mobile Seiten URLs');
define('MODULE_AGI_GOOGLE_XML_MOBILE_LINK_PARAMETER_DESC', 'Diese Parameter werden an die Links zu mobilen Seiten angef&uuml;gt.<br />Kampagnen-Parameter werden &uuml;berschrieben.');
?>