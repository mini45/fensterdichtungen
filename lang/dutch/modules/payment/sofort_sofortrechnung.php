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
 * $Id: sofort_sofortrechnung.php 6097 2013-04-22 12:00:13Z rotsch $
 */

//include language-constants used in all Multipay Projects
require_once 'sofort_general.php';

define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS_WITH_LIGHTBOX', '<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">Ik heb de privacy regels gelezen.</a>');
define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS', '
	<script type="text/javascript">
		function showSrConditions() {
			srOverlay = new sofortOverlay(jQuery(".srOverlay"), "callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/de/sr/privacy_de");
			srOverlay.trigger();
		}
	</script>
	<noscript>
		<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">Ik heb de privacy regels gelezen.</a>
	</noscript>
	<!-- comSeo-Ajax-Checkout-Bugfix: show also div, when buyer doesnt use JS -->
	<div>
		<a id="srNotice" href="javascript:void(0)" onclick="showSrConditions();">Ik heb de privacy regels gelezen.</a>
	</div>
	<div style="display:none; z-index: 1001;filter: alpha(opacity=92);filter: progid :DXImageTransform.Microsoft.Alpha(opacity=92);-moz-opacity: .92;-khtml-opacity: 0.92;opacity: 0.92;background-color: black;position: fixed;top: 0px;left: 0px;width: 100%;height: 100%;text-align: center;vertical-align: middle;" class="srOverlay">
		<div class="loader" style="z-index: 1002;position: relative;background-color: #fff;top: 40px;overflow: scroll;padding: 4px;border-radius: 7px;-moz-border-radius: 7px;-webkit-border-radius: 7px;margin: auto;width: 620px;height: 400px;overflow: scroll; overflow-x: hidden;">
			<div class="closeButton" style="position: fixed; top: 54px; background: url(callback/sofort/ressources/images/close.png) right top no-repeat;cursor:pointer;height: 30px;width: 30px;"></div>
			<div class="content"></div>
		</div>
	</div>
');

define('MODULE_PAYMENT_SOFORT_SR_TEXT_DESCRIPTION_EXTRA',
	MODULE_PAYMENT_SOFORT_MULTIPAY_JS_LIBS.'
	<div id="srExtraDesc">
		<div class="content" style="display:none;"></div>
	</div>
	<script type="text/javascript">
		srOverlay = new sofortOverlay(jQuery("#srExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/rbs/shopinfo/nl");
	</script>
');

define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_TEXT_TITLE_ADMIN', 'Rechnung by SOFORT <br /><img src="https://images.sofort.com/nl/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_TEXT_TITLE', 'Kauf auf Rechnung <br /><img src="https://images.sofort.com/nl/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_TITLE', 'Kauf auf Rechnung');
define('MODULE_PAYMENT_SOFORT_SR_LOGO_HTML', '<img src="https://images.sofort.com/nl/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_ERROR_MESSAGE', 'Betaling via de gekozen betaalmethode is helaas niet mogelijk of werd door de klant afgebroken. Kies een andere betaalwijze.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_SR', 'Betaling via de gekozen betaalmethode is helaas niet mogelijk of werd door de klant afgebroken. Kies een andere betaalwijze.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_SR_CHECKOUT_TEXT', '');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_CONFIRM_SR', 'Rekening hier bevestigen:');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_TITLE', 'Volgorde van aanwijzen');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_DESC', 'Volgorde van de mededelingen. Laagste getal wordt als eerste getoond.');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_TITLE', 'sofort.de module activeren');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_DESC', 'De complete module activeren / deactiveren');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_DESCRIPTION', 'Koop op rekening met de garantie dat het geld uitbetaald wordt.');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_TITLE', 'Toegestane zones');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_DESC', 'Geef de <b>aparte</b> zones aan, voor welke dit moduul toegestaan is. (b.v. AT,DE,CH, NL (als hier niets ingevuld wordt, zijn alle zones toegestaan))');
define('MODULE_PAYMENT_SOFORT_SR_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_SR_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_TITLE', 'Onbevestigde status van bestelling');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_DESC', 'Status van de bestelling na een succesvolle betaling. De handelaar heeft de factuur nog niet vrijgegeven.'); // (pending-confirm_invoice)
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_TITLE', 'Bestelstatus na volledige annulering');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_DESC', 'Geannuleerde bestelstatus<br />Bestelstatus na volledige annulering van de rekening.');  //(loss-canceled, loss-confirmation_period_expired)
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Bevestigde bestelstatus');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Bestelstatus na een succesvolle en bevestigde transactie. De rekening is door de web-winkelier vrijgegeven.'); //(pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_TITLE', 'Annulering na bevestiging (credit nota)');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_DESC', 'Status van bestellingen die volledig geannuleerd zijn na bevestiging (credit nota).'); // (refunded_refunded)
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT', 'De betaalmethode Kauf auf Rechnung werd uitgekozen. De transactie is niet afgesloten.');
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT_SELLER', 'Doorzending naar SOFORT - betaling heeft nog niet plaatsgevonden.');

define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TITLE', '"Aanbevolen betaalmethode"');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_DESC', '"Deze betaalmethode als "aanbevolen betaalmethode" markeren. Op de betaalpagina staat er een aanbeveling achter de betaalmethode."');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TEXT', '("Aanbevolen betaalmethode")');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED_HISTORY', 'De opdracht voor de bevestiging van de factuur is aan SOFORT gestuurd. De bevestiging hiervoor van SOFORT is in behandeling.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CANCELED_HISTORY', 'De opdracht om de factuur te storneren is aan SOFORT gestuurd.  De bevestiging hiervoor van SOFORT is in behandeling.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_REFUNDED_HISTORY', 'De opdracht voor een creditnota voor de factuur is aan SOFORT gestuurd. De bevestiging hiervoor van SOFORT is in behandeling.');

/////////////////////////////////////////////////
//////// Seller-Backend and callback.php ////////
/////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_SR_CONFIRM_INVOICE', 'Rekening bevestigen');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE', 'Rekening annuleren');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE', 'Rekening crediteren');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE_QUESTION', 'Weet u zeker dat u de rekening wilt annuleren? Deze handeling kan niet ongedaan gemaakt worden.');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE_QUESTION', 'Weet u zeker dat u de rekening wilt crediteren? Dit proces kan niet ongedaan gemaakt worden.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED_REFUNDED', 'De rekening werd geannuleerd en een creditnota is opgemaakt.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED', 'De rekening werd geannuleerd.');

define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE', 'Rekening downloaden');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_HINT', 'Hier het desbetreffende document downloaden (rekening voorbeeld, factuur, creditnota)');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_CREDIT_MEMO', 'Creditnota downloaden');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_PREVIEW', 'Rekening voorbeeld downloaden');

define('MODULE_PAYMENT_SOFORT_SR_EDIT_CART', 'Winkelwagen aanpassen');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART', 'Winkelwagen opslaan');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_QUESTION', 'Wilt u de winkelwagen echt bijwerken?');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_HINT', 'Hier kunt u veranderingen in uw winkelwagen opslaan. Bij een reeds bevestigde factuur, heeft  het verwijderen  van een artikel of het verminderen qua aantal  een creditnota tot gevolg.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_HINT', 'U kunt kortingen of toeslagen aanpassen. Toeslagen mogen niet verhoogd worden en kortingen mogen geen bedrag groter dan nul bezitten. Het totale bedrag van een factuur mag niet door aanpassingen worden verhoogd.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_GTZERO_HINT', 'Kortingen mogen geen bedrag groter dan nul bevatten.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY', 'Hoeveelheid aanpassen');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_HINT', 'U kunt het aantal artikelen per positie aanpassen. Alleen het aantal mag reduceerd worden maar kan niet worden vermeerderd.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_TOTAL_GTZERO', 'Het artikel kan niet gereduceerd worden omdat het totale bedrag van de rekening niet negatief mag zijn.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_ZERO_HINT', 'Aantal moet groter dan 0 zijn. Om te verwijderen, markeer het artikel aan het einde van de regel.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE', 'Prijs aanpassen');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_HINT', 'U kunt de prijs van elk artikel per positie aanpassen. Prijzen kunnen alleen verminderd maar niet verhoogd worden.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_TOTAL_GTZERO', 'De prijs kan niet gereduceerd worden omdat  de totale som van de rekening niet negatief mag zijn.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_HINT', 'Prijs en hoeveelheid kunnen niet tegelijkertijd worden aangepast.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_NAN', 'U heeft ongeldige tekens ingetikt. Bij deze aanpassingen zijn alleen cijfers toegestaan.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_VALUE_LTZERO_HINT', 'De waarde mag niet kleiner dan 0 zijn.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE', 'Tik uw reactie in');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE_HINT', 'Bij het aanpassen van een reeds bevestigde rekening moet een gegronde reden worden aangegeven. De reden verschijnt later op de creditnota als opmerking voor het betreffende artikel.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_HINT', 'U kunt de prijs voor verzendkosten aanpassen. De prijs kan alleen verminderd en niet verhoogd worden.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_TOTAL_GTZERO', 'De verzendkosten kunnen niet gereduceerd worden omdat het totaal van de factuur niet negatief mag zijn.');
define('MODULE_PAYMENT_SOFORT_SR_RECALCULATION', 'wordt opnieuw berekend');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_TOTAL_GTZERO','Dit artikel kan niet worden verwijderd omdat de totale som van de factuur niet negatief mag zijn..');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_ARTICLE_FROM_INVOICE', 'Artikel verwijderen');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE', 'Artikel verwijderen');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_QUESTION', 'Bent u zeker dat u de volgende artikelen wilt verwijderen: %s ?');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_HINT', 'Selecteer artikelen om ze te verwijderen. Het verwijderen van een artikel in een reeds bevestigde rekening, heeft een creditnota tot gevolg.');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_LAST_ARTICLE_HINT', 'Door het reduceren van het aantal artikelen of het verwijderen van het laatste artikel wordt de rekening volledig geannuleerd.');
define('MODULE_PAYMENT_SOFORT_SR_SYNC_FAILED_SELLER', 'Deze bestelling bevat items die zouden kunnen leiden tot problemen met de synchronisatie van het SOFORT netwerk. Om een toekomstige foutieve verzending te vermijden, controleer en vergelijk de verzending-, korting- of product gegevens die opgeslagen zijn op de pdf-factuur van SOFORT met die in uw winkel. Veranderingen m.b.t. de winkelwagen zijn alleen mogelijk via het klantenmenu van SOFORT.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_GX_CUSTOMIZER_AFFECTED', 'Het betreft meestal alleen artikelen die gebruik maken van de GX-customizers functies.');

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_BUYER', 'Bestelling met succes ingediend. Bevestiging nog niet verstuurd.');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_SELLER', 'Bestelling voltooid - rekening kan bevestigd worden - uw transactie-ID:');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_BUYER', 'Bestelling geannuleerd.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_BUYER', 'Bestelling bevestigd en in behandeling.');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_SELLER', 'De factuur is bevestigd en gemaakt.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_BUYER', 'De factuur is gecrediteerd.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_SELLER', 'De rekening is gecrediteerd. Credit nota is gemaakt.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_REANIMATED', 'Het storneren van de rekening is geannuleerd.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_BUYER', 'Bestelling geannuleerd.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_SELLER', 'Bestelling is geannuleerd. Bevestigingstermijn is verstreken.');

define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CURRENT_TOTAL', 'Actuele hoogte van de rekening:');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED', 'De rekening werd bevestigd.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_TRANSACTION_ID', 'Transactie-ID');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CANCELED_REFUNDED', 'De rekening is geannuleerd, een creditnota is opgemaakt. {time}}');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_EDITED', 'De winkelwagen werd veranderd');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_RESET', 'De winkelwagen opnieuw instellen.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9000', 'Geen rekenings transactie gevonden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9001', 'De rekening kon niet worden bevestigd.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9002', 'Het gegeven factuurbedrag is hoger dan de krediet limiet.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9003', 'De rekening kon niet gestorneerd worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9004', 'De aanvraag bevatte ongeldige winkelwagen posities.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9005', 'De winkelwagen kon niet aangepast worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9006', 'De toegang tot interface is, 30 dagen na ontvangst van betaling, niet meer mogelijk.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9007', 'De factuur is reeds geannuleerd.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9008', 'Het bedrag van de opgegeven btw is te hoog.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9009', 'De bedragen van de opgegeven btw-tarieven van de artikelen komen niet overeen.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9010', 'Het aanpassen van de winkelwagen is niet mogelijk.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9011', 'Er is geen commentaar voor aanpassing van de winkelwagen opgegeven.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9012', 'Er kunnen geen posities toegevoegd worden aan uw winkelwagen. Ook kan het aantal posten op de factuur niet verhoogd worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9013', 'Er zijn uitsluitend artikelen in de winkelwagen waarvoor geen rekening gemaakt kan worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9014', 'Het opgegeven rekeningsnummer is reeds in gebruik.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9015', 'Het opgegeven nummer van de credit nota is reeds in gebruik.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9016', 'Het opgegeven nummer voor de bestelling is reeds in gebruik.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9017', 'De factuur is al bevestigd.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9018', 'Voor de factuur zijn geen gegevens aangepast.');