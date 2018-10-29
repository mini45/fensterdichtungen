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
 * $Id: sofort_lastschrift.php 6097 2013-04-22 12:00:13Z rotsch $
 */

//include language-constants used in all Multipay Projects
require_once 'sofort_general.php';

define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_CONDITIONS_WITH_LIGHTBOX', '<a href="https://documents.sofort.com/de/ls/privacy_de" target="_blank">Ik heb de privacy regels gelezen.</a>');
define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_CONDITIONS', '
	<script type="text/javascript">
		function showLsConditions() {
			lsOverlay = new sofortOverlay(jQuery(".lsOverlay"), "callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/de/ls/privacy_de");
			lsOverlay.trigger();
		}
	</script>
	<noscript>
		<div>
			<a href="https://documents.sofort.com/de/ls/privacy_de" target="_blank">Ik heb de privacy regels gelezen.</a>
		</div>
	</noscript>
	<!-- comSeo-Ajax-Checkout-Bugfix: show also div, when buyer doesnt use JS -->
	<div>
		<a id="lsNotice" href="javascript:void(0)" onclick="showLsConditions()">Ik heb de privacy regels gelezen.</a>
	</div>
	<div style="display:none; z-index: 1001;filter: alpha(opacity=92);filter: progid :DXImageTransform.Microsoft.Alpha(opacity=92);-moz-opacity: .92;-khtml-opacity: 0.92;opacity: 0.92;background-color: black;position: fixed;top: 0px;left: 0px;width: 100%;height: 100%;text-align: center;vertical-align: middle;" class="lsOverlay">
		<div class="loader" style="z-index: 1002; position: relative;background-color: #fff;border: 5px solid #C0C0C0;top: 40px;overflow: scroll;padding: 4px;border-radius: 7px;-moz-border-radius: 7px;-webkit-border-radius: 7px;margin: auto;width: 620px;height: 400px;overflow: scroll; overflow-x: hidden;">
			<div class="closeButton" style="position: fixed; top: 54px; background: url(callback/sofort/ressources/images/close.png) right top no-repeat;cursor:pointer;height: 30px;width: 30px;"></div>
			<div class="content"></div>
		</div>
	</div>
');

define('MODULE_PAYMENT_SOFORT_LS_TEXT_DESCRIPTION_EXTRA',
	MODULE_PAYMENT_SOFORT_MULTIPAY_JS_LIBS.'
	<div id="lsExtraDesc">
		<div class="content" style="display:none;"></div>
	</div>
	<script type="text/javascript">
		lsOverlay = new sofortOverlay(jQuery("#lsExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/ls/shopinfo/nl");
	</script>
');

define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_TEXT_TITLE', 'Automatische incasso <br /><img src="https://images.sofort.com/nl/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_TEXT_TITLE_ADMIN', 'Lastschrift by SOFORT <br /><img src="https://images.sofort.com/nl/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_TITLE', 'Automatische incasso');
define('MODULE_PAYMENT_SOFORT_LS_LOGO_HTML', '<img src="https://images.sofort.com/nl/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ERROR_MESSAGE', 'Betaling via de gekozen betaalmethode is helaas niet mogelijk of werd door de klant afgebroken. Kies een andere betaalwijze.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_LS', 'Betaling via de gekozen betaalmethode is helaas niet mogelijk of werd door de klant afgebroken. Kies een andere betaalwijze.');
define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_TEXT', '');
define('MODULE_PAYMENT_SOFORT_LS_SORT_ORDER_TITLE', 'Volgorde van aanwijzen');
define('MODULE_PAYMENT_SOFORT_LS_SORT_ORDER_DESC', 'Volgorde van de mededelingen. Laagste getal wordt als eerste getoond.');
define('MODULE_PAYMENT_SOFORT_LS_STATUS_TITLE', 'sofort.de module activeren');
define('MODULE_PAYMENT_SOFORT_LS_STATUS_DESC', 'De complete module activeren / deactiveren');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_DESCRIPTION', 'Betaalmodule voor Lastschrift by SOFORT');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ERROR_HEADING', 'Er is een fout bij de bestelling opgetreden.');

define('MODULE_PAYMENT_SOFORT_LS_TEXT_HOLDER', 'Bankrekeninghouder: ');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ACCOUNT_NUMBER', 'Bankrekeningnummer: ');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_BANK_CODE', 'Bankleitzahl: ');

define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_ALLOWED_TITLE', 'Toegestane zones');
define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_ALLOWED_DESC', 'Geef de <b>aparte</b> zones aan, voor welke dit moduul toegestaan is. (b.v. AT,DE,CH, NL (als hier niets ingevuld wordt, zijn alle zones toegestaan))');
define('MODULE_PAYMENT_SOFORT_LS_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_LS_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Bevestigde bestelstatus');
define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Bevestigde bestelstatus<br />Status van de bestelling na een afgesloten transactie.'); //(pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_STATUS_ID_TITLE', 'Debet nota / terugboeking');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_STATUS_ID_DESC', 'Status voor bestellingen waar een terugboeking voor klaar ligt.'); // (loss-rejected)
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_STATUS_ID_TITLE', 'Ontvangst van geld');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_STATUS_ID_DESC', 'Bepaal de status van bestellingen waarvoor het geld gestort is op de rekening van de SOFORT Bank.'); // (received-credited)
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_STATUS_ID_TITLE', 'Gedeeltelijke terugbetaling');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_STATUS_ID_DESC', 'Status van bestellingen waarbij een deel van het bedrag aan de koper is vergoed.'); // (refunded-compensation)
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_STATUS_ID_TITLE', 'volledige vergoeding');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_STATUS_ID_DESC', 'Status van bestellingen waarbij het volledige bedrag aan de koper vergoed werd.'); // (refunded-refunded)

define('MODULE_PAYMENT_SOFORT_LS_LOGO', 'logo_155x50.png');
define('MODULE_PAYMENT_SOFORT_LS_BANNER', 'banner_300x100.png');

define('MODULE_PAYMENT_SOFORT_LS_TMP_COMMENT', 'Als wijze van betaling werd gekozen voor de automatische incasso door SOFORT. Transactie niet voltooid.');
define('MODULE_PAYMENT_SOFORT_LS_TMP_COMMENT_SELLER', 'Doorzending naar SOFORT - betaling heeft nog niet plaatsgevonden.');

define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_TITLE', '"Aanbevolen betaalmethode"');
define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_DESC', '"Deze betaalmethode als "aanbevolen betaalmethode" markeren. Op de betaalpagina staat er een aanbeveling achter de betaalmethode."');
define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_TEXT', '("Aanbevolen betaalmethode")');

define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_SELLER', 'Bestelling voltooid - automatische incasso wordt uitgevoerd. Uw transactie-ID: {{tId}}');
define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_BUYER', 'Bestelling succesvol');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_SELLER', 'Geld ontvangen op rekening');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_BUYER', '');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_SELLER', '');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_BUYER', 'Bij deze transactie werd een terugboeking voorgenomen. {{time}}');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_SELLER', 'Een deel van het factuurbedrag zal worden terugbetaald.  Het totaal van het teruggeboekte bedrag: {{refunded_amount}}. {{time}}');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_BUYER', 'Een deel van het bedrag zal worden terugbetaald.');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_SELLER', '');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_BUYER', 'Het bedrag van de rekening wordt gecrediteerd. {{time}}');
