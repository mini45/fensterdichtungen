<?php
/**
 * @version SOFORT Gateway 5.2.0 - $Date: 2012-11-21 12:09:39 +0100 (Wed, 21 Nov 2012) $
 * @author SOFORT AG (integration@sofort.com)
 * @link http://www.sofort.com/
 *
 * Copyright (c) 2012 SOFORT AG
 * 
 * Released under the GNU General Public License (Version 2)
 * [http://www.gnu.org/licenses/gpl-2.0.html]
 *
 * $Id: ot_sofort.php 5725 2012-11-21 11:09:39Z rotsch $
 */

$num = 3;

define('MODULE_ORDER_TOTAL_SOFORT_TITLE', 'sofort.de Module voor de bewerking van kortingen');
define('MODULE_ORDER_TOTAL_SOFORT_DESCRIPTION', 'Korting voor de betaalmethoden van sofort.com');

define('MODULE_ORDER_TOTAL_SOFORT_STATUS_TITLE', 'Korting laten zien');
define('MODULE_ORDER_TOTAL_SOFORT_STATUS_DESC', 'Wilt u de korting voor de verschillende betaalmethoden aanzetten?');

define('MODULE_ORDER_TOTAL_SOFORT_SORT_ORDER_TITLE', 'Volgorde van aanwijzen');
define('MODULE_ORDER_TOTAL_SOFORT_SORT_ORDER_DESC', 'Volgorde van de mededelingen. Laagste getal wordt als eerste getoond.');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SU_TITLE', 'Lijst met kortingen voor SOFORT Banking');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SU_DESC', 'Kortingen (minimale waarden: procent&vast bedrag)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SL_TITLE', 'Lijst met kortingen voor SOFORT Lastschrift');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SL_DESC', 'Kortingen (minimale waarden: procent&vast bedrag)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SR_TITLE', 'Lijst met kortingen voor Rechnung by SOFORT');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SR_DESC', 'Kortingen (minimale waarden: procent&vast bedrag)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SV_TITLE', 'Lijst met kortingen voor Vorkasse by SOFORT');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SV_DESC', 'Kortingen (minimale waarden: procent&vast bedrag)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_LS_TITLE', 'Lijst met kortingen voor Lastschrift by SOFORT');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_LS_DESC', 'Kortingen (minimale waarden: procent&vast bedrag)');

define('MODULE_ORDER_TOTAL_SOFORT_INC_SHIPPING_TITLE', 'Inclusief verzendkosten');
define('MODULE_ORDER_TOTAL_SOFORT_INC_SHIPPING_DESC', 'De verzendkosten worden ook gekort.');

define('MODULE_ORDER_TOTAL_SOFORT_INC_TAX_TITLE', 'inclusief omzetbelasting');
define('MODULE_ORDER_TOTAL_SOFORT_INC_TAX_DESC', 'De omzetbelasting wordt ook gekort.');

define('MODULE_ORDER_TOTAL_SOFORT_CALC_TAX_TITLE', 'Berekening van de omzetbelasting');
define('MODULE_ORDER_TOTAL_SOFORT_CALC_TAX_DESC', 'opnieuw berekenen van de omzetbelasting');

define('MODULE_ORDER_TOTAL_SOFORT_ALLOWED_TITLE', 'Toegestane zones');
define('MODULE_ORDER_TOTAL_SOFORT_ALLOWED_DESC' , 'Geef de <b>aparte</b> zones aan, voor welke dit moduul toegestaan is. (b.v. AT,DE,CH, NL (als hier niets ingevuld wordt, zijn alle zones toegestaan))');

define('MODULE_ORDER_TOTAL_SOFORT_DISCOUNT', 'Korting');
define('MODULE_ORDER_TOTAL_SOFORT_FEE', 'Toeslag');

define('MODULE_ORDER_TOTAL_SOFORT_TAX_CLASS_TITLE','Belastingschaal');
define('MODULE_ORDER_TOTAL_SOFORT_TAX_CLASS_DESC','De belastingschaal speelt geen rol en dient alleen ter voorkoming van een foutmelding.');

define('MODULE_ORDER_TOTAL_SOFORT_BREAK_TITLE','Meervoudige berekening');
define('MODULE_ORDER_TOTAL_SOFORT_BREAK_DESC','Wilt u de mogelijkheid tot het maken van meervoudige berekeningen? Indien niet, wordt de berekening na de eerste korting afgesloten.');
?>