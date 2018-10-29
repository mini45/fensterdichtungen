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

define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_CONDITIONS_WITH_LIGHTBOX', '<a href="https://documents.sofort.com/de/ls/privacy_de" target="_blank">Ho letto l\'Informativa sulla protezione dei dati personali.</a>');
define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_CONDITIONS', '
	<script type="text/javascript">
		function showLsConditions() {
			lsOverlay = new sofortOverlay(jQuery(".lsOverlay"), "callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/de/ls/privacy_de");
			lsOverlay.trigger();
		}
	</script>
	<noscript>
		<div>
			<a href="https://documents.sofort.com/de/ls/privacy_de" target="_blank">Ho letto l\'Informativa sulla protezione dei dati personali.</a>
		</div>
	</noscript>
	<!-- comSeo-Ajax-Checkout-Bugfix: show also div, when buyer doesnt use JS -->
	<div>
		<a id="lsNotice" href="javascript:void(0)" onclick="showLsConditions()">Ho letto l\'Informativa sulla protezione dei dati personali.</a>
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
		lsOverlay = new sofortOverlay(jQuery("#lsExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/ls/shopinfo/it");
	</script>
');

define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_TEXT_TITLE', 'Prelievo bancario (addebito) <br /><img src="https://images.sofort.com/it/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_TEXT_TITLE_ADMIN', 'Lastschrift by SOFORT <br /><img src="https://images.sofort.com/it/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_TITLE', 'Prelievo bancario (addebito)');
define('MODULE_PAYMENT_SOFORT_LS_LOGO_HTML', '<img src="https://images.sofort.com/it/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ERROR_MESSAGE', 'La modalità di pagamento selezionata non è disponibile o è stata annullata dall\'acquirente. Ti preghiamo di selezionare un\'altra modalità di pagamento.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_LS', 'La modalità di pagamento selezionata non è disponibile o è stata annullata dall\'acquirente. Ti preghiamo di selezionare un\'altra modalità di pagamento.');
define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_TEXT', '');
define('MODULE_PAYMENT_SOFORT_LS_SORT_ORDER_TITLE', 'Ordine di visualizzazione');
define('MODULE_PAYMENT_SOFORT_LS_SORT_ORDER_DESC', 'Ordine di visualizzazione. Il numero più piccolo sarà visualizzato per prima.');
define('MODULE_PAYMENT_SOFORT_LS_STATUS_TITLE', 'Attivare modulo di sofort.de');
define('MODULE_PAYMENT_SOFORT_LS_STATUS_DESC', 'Attivare/disattivare l\'intero modulo');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_DESCRIPTION', 'Modulo di pagamento per Lastschrift by SOFORT');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ERROR_HEADING', 'Si è verificato un errore durante l\'ordinazione.');

define('MODULE_PAYMENT_SOFORT_LS_TEXT_HOLDER', 'Intestatario del conto: ');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ACCOUNT_NUMBER', 'Numero di conto: ');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_BANK_CODE', 'Codice ABI: ');

define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_ALLOWED_TITLE', 'Zone consentite');
define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_ALLOWED_DESC', 'Indicare<b>singolarmente</b> le zone autorizzate per questo modulo. (ad es. AT, DE (se vuoto, vengono autorizzate tutte le zone))');
define('MODULE_PAYMENT_SOFORT_LS_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_LS_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Stato dell\'ordine confermato');
define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Stato dell\'ordine confermato<br />Stato dell\'ordine dopo l\'avvenuta transazione.'); //(pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_STATUS_ID_TITLE', 'Addebito respinto');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_STATUS_ID_DESC', 'Stato per ordini, per cui vi è un addebito respinto:'); // (loss-rejected)
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_STATUS_ID_TITLE', 'Accredito');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_STATUS_ID_DESC', 'Stato per ordini, per cui l\'importo è stato accreditato sul conto di SOFORT Bank.'); // (received-credited)
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_STATUS_ID_TITLE', 'Rimborso parziale');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_STATUS_ID_DESC', 'Stato per ordini, per cui un importo parziale viene rimborsato all\'acquirente.'); // (refunded-compensation)
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_STATUS_ID_TITLE', 'Rimborso completo');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_STATUS_ID_DESC', 'Stato per ordini, per cui l\'intero importo viene rimborsato all\'acquirente.'); // (refunded-refunded)

define('MODULE_PAYMENT_SOFORT_LS_LOGO', 'logo_155x50.png');
define('MODULE_PAYMENT_SOFORT_LS_BANNER', 'banner_300x100.png');

define('MODULE_PAYMENT_SOFORT_LS_TMP_COMMENT', 'Lastschrift by SOFORT selezionato come metodo di pagamento. Transazione non conclusa.');
define('MODULE_PAYMENT_SOFORT_LS_TMP_COMMENT_SELLER', 'Inoltro a SOFORT - pagamento non ancora effettuato.');

define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_TITLE', '"Modalità di pagamento consigliata"');
define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_DESC', '"Segnare questa modalità di pagamento come "modalità di pagamento consigliata". Sulla pagina di pagamento un avviso potrà essere visualizzato direttamente dietro la modalità di pagamento".');
define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_TEXT', '("Modalità di pagamento consigliata")');

define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_SELLER', 'Ordine completato con successo - L\'addebito diretto viene effettuato. Il tuo ID della transazione: {{tId}}');
define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_BUYER', 'Ordine effettuato con successo.');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_SELLER', 'Accredito sul conto');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_BUYER', '');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_SELLER', '');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_BUYER', 'Per questa transazione vi è un addebito respinto. {{time}}');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_SELLER', 'Una parte dell\'importo della fattura verrà rimborsato. Importo totale rimborsato: {{refunded_amount}}. {{time}}');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_BUYER', 'Una parte dell\'importo verrà rimborsata.');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_SELLER', '');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_BUYER', 'L\'importo della fattura verrà rimborsato. {{time}}');
