<?php
/**
 * @version SOFORT Gateway 5.2.0 - $Date: 2013-04-22 14:00:13 +0200 (Mon, 22 Apr 2013) $
 * @author SOFORT AG (integration@sofort.com)
 * @link http://www.sofort.com/
 *
 * Copyright (c) 2012 SOFORT AG
 *
 * Released under the GNU General Public License (Version 2)
 * [http://www.gnu.org/licenses/gpl-2.0.html]
 *
 * $Id: sofort_sofortueberweisung.php 6097 2013-04-22 12:00:13Z rotsch $
 */

//include language-constants used in all Multipay Projects
require_once 'sofort_general.php';

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_EXTRA',
	MODULE_PAYMENT_SOFORT_MULTIPAY_JS_LIBS.'
	<div id="suExtraDesc">
		<div class="content" style="display:none;"></div>
	</div>
	<script type="text/javascript">
		suOverlay = new sofortOverlay(jQuery("#suExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/sb/shopinfo/nl");
	</script>
');

define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_TEXT_TITLE', 'SOFORT Banking <br /> <img src="https://images.sofort.com/nl/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_TEXT_TITLE_ADMIN', 'SOFORT Banking <br /> <img src="https://images.sofort.com/nl/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE', 'SOFORT Banking');
define('MODULE_PAYMENT_SOFORT_SU_KS_TEXT_TITLE', 'SOFORT Banking met kopersgarantie');
define('MODULE_PAYMENT_SOFORT_SU_LOGO_HTML', '<img src="https://images.sofort.com/nl/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION', 'SOFORT Banking is de gratis, TÜV-goedgekeurde, betaalservice van SOFORT AG.');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE', '     <table border="0" cellspacing="0" cellpadding="0">      <tr>        <td valign="bottom">
	<a onclick="javascript:window.open(\'https://images.sofort.com/nl/su/landing.php\',\'Informatie voor de klant\',\'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1020, height=900\');" style="float:left; width:auto; cursor:pointer;">
		{{image}}
	</a>
	</td>      </tr>      <tr> <td class="main">{{text}}</td>      </tr>      </table>');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'SOFORT Banking');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_TEXT', '<ul><li>Betaalsysteem met TÜV-goedgekeurde privacy regels</li><li>Geen registratie nodig.</li><li>Het bestelde wordt, indien voorradig, DIRECT verstuurd</li><li>Houdt u de inlog gegevens van uw internet bankrekening (PIN/TAN) bij de hand</li></ul>');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_TEXT_KS', '<ul><li>Bij de betaling met SOFORT Banking heeft u kopersgarantie! [[link_beginn]]Verdere informatie[[link_end]]</li><li>Betaalsysteem met TÜV-goedgekeurde privacy regels</li><li>Geen registratie nodig</li><li>Het bestelde wordt, indien voorradig, DIRECT geleverd cq verstuurd</li><li>Houdt u de gegevens van uw internet bankrekening bij de hand (PIN/TAN)</li></ul>');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_INFOLINK_KS', 'https://www.sofort-bank.com/eng-DE/general/kaeuferschutz/informationen-fuer-kaeufer/');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_ALLOWED_TITLE', 'Toegestane zones');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_ALLOWED_DESC', 'Geef de <b>aparte</b> zones aan, voor welke dit moduul toegestaan is. (b.v. AT,DE,CH, NL (als hier niets ingevuld wordt, zijn alle zones toegestaan))');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_TITLE', 'sofort.de module activeren');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_DESC', 'De complete module activeren / deactiveren');
define('MODULE_PAYMENT_SOFORT_SU_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_SU_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_TITLE', 'Volgorde van aanwijzen');
define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_DESC', 'Volgorde van de mededelingen. Laagste getal wordt als eerste getoond.');
define('MODULE_PAYMENT_SOFORT_SU_KS_STATUS_TITLE', 'Kopersgarantie geactiveerd');
define('MODULE_PAYMENT_SOFORT_SU_KS_STATUS_DESC', 'Kopersgarantie voor SOFORT Banking activeren');

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Bevestigde bestelstatus');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Bevestigde bestelstatus<br />Status van de bestelling na een afgesloten transactie.'); // (pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_TITLE', 'Bestelstatus, indien er geen geld aangekomen is');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_DESC', 'Status van de bestelling indien er geen geld op uw bankrekening aangekomen is. (Voorwaarde: Bankrekening bij de Sofort Bank).'); // (loss-not_credited)
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_TITLE', 'Ontvangst van geld');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_DESC', 'Bepaal de status van bestellingen waarvoor het geld gestort is op de rekening van de SOFORT Bank.'); // (received-credited)
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_TITLE', 'Gedeeltelijke terugbetaling');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_DESC', 'Status van bestellingen waarbij een deel van het bedrag aan de koper is vergoed.');  // (refunded-compensation)
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_TITLE', 'volledige vergoeding');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_DESC', 'Status van bestellingen waarbij het volledige bedrag aan de koper vergoed werd.'); // (refunded-refunded)

define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TITLE', '"Aanbevolen betaalmethode"');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_DESC', '"Deze betaalmethode als "aanbevolen betaalmethode" markeren. Op de betaalpagina staat er een aanbeveling achter de betaalmethode."');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TEXT', '("Aanbevolen betaalmethode")');

define('MODULE_PAYMENT_SOFORT_SU_TMP_COMMENT', 'SOFORT Banking als betaalmethode gekozen. Transactie is niet afgesloten.');
define('MODULE_PAYMENT_SOFORT_SU_TMP_COMMENT_SELLER', 'Doorzending naar SOFORT - betaling heeft nog niet plaatsgevonden.');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_ERROR_MESSAGE', 'Betaling via de gekozen betaalmethode is helaas niet mogelijk of werd door de klant afgebroken. Kies een andere betaalwijze.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_SU', 'Betaling via de gekozen betaalmethode is helaas niet mogelijk of werd door de klant afgebroken. Kies een andere betaalwijze.');

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_BUYER', 'Bestelling met SOFORT Banking is succesvol doorgegeven. Uw transaktie-ID: {{transactie}}');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_BUYER', 'Het bedrag is tot op heden niet ontvangen. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_BUYER', '');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_SELLER', 'Geld ontvangen op rekening');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_BUYER', 'Het bedrag van de rekening wordt gecrediteerd. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_SELLER', 'Een deel van het factuurbedrag zal worden terugbetaald.  Het totaal van het teruggeboekte bedrag: {{refunded_amount}}. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_BUYER', 'Een deel van het bedrag zal worden terugbetaald.');

?>