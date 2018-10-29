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
		suOverlay = new sofortOverlay(jQuery("#suExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/sb/shopinfo/it");
	</script>
');

define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_TEXT_TITLE', 'SOFORT Banking <br /> <img src="https://images.sofort.com/it/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_TEXT_TITLE_ADMIN', 'SOFORT Banking <br /> <img src="https://images.sofort.com/it/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE', 'SOFORT Banking');
define('MODULE_PAYMENT_SOFORT_SU_KS_TEXT_TITLE', 'SOFORT Banking con protezione acquirenti');
define('MODULE_PAYMENT_SOFORT_SU_LOGO_HTML', '<img src="https://images.sofort.com/it/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION', 'SOFORT Banking è il servizio di pagamento gratuito e certificato TÜV di SOFORT AG.');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE', '     <table border="0" cellspacing="0" cellpadding="0">      <tr>        <td valign="bottom">
	<a onclick="javascript:window.open(\'https://images.sofort.com/it/su/landing.php\',\'Informazioni per i clienti\',\'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1020, height=900\');" style="float:left; width:auto; cursor:pointer;">
		{{image}}
	</a>
	</td>      </tr>      <tr> <td class="main">{{text}}</td>      </tr>      </table>');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'SOFORT Banking');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_TEXT', '<ul><li>Sistema di pagamento con protezione dei dati certificata TÜV</li><li>Registrazione non necessaria</li><li>Merce/servizio può essere spedita/o SUBITO</li><li>Ti preghiamo di avere a disposizione i dati per l\'online banking (PIN/password dispositiva)</li></ul>');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_TEXT_KS', '<ul><li>Per pagamenti con SOFORT Banking disponete della protezione acquirenti! [[link_beginn]]Maggiori informazioni[[link_end]]</li><li>Sistema di pagamento con protezione dei dati certificati TÜV</li><li>Registrazione non necessaria</li><li>Merce/servizio viene spedita/o SUBITO se disponibile</li><li>Ti preghiamo di avere a disposizione i dati per l\'online banking (PIN/password dispositiva)</li></ul>');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_INFOLINK_KS', 'https://www.sofort-bank.com/eng-DE/general/kaeuferschutz/informationen-fuer-kaeufer/');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_ALLOWED_TITLE', 'Zone consentite');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_ALLOWED_DESC', 'Indicare<b>singolarmente</b> le zone autorizzate per questo modulo. (ad es. AT, DE (se vuoto, vengono autorizzate tutte le zone))');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_TITLE', 'Attivare modulo di sofort.de');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_DESC', 'Attivare/disattivare l\'intero modulo');
define('MODULE_PAYMENT_SOFORT_SU_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_SU_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_TITLE', 'Ordine di visualizzazione');
define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_DESC', 'Ordine di visualizzazione. Il numero più piccolo sarà visualizzato per prima.');
define('MODULE_PAYMENT_SOFORT_SU_KS_STATUS_TITLE', 'Protezione acquirenti attivata');
define('MODULE_PAYMENT_SOFORT_SU_KS_STATUS_DESC', 'Attivare protezione acquirenti per SOFORT Banking');

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Stato dell\'ordine confermato');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Stato dell\'ordine confermato<br />Stato dell\'ordine dopo l\'avvenuta transazione.'); // (pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_TITLE', 'Stato dell\'ordine, se non è stato ricevuto il denaro');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_DESC', 'Stato dell\'ordine in caso non sia stato effettuato alcun accredito sul tuo conto corrente. (Requisito: Conto presso Sofort Bank).'); // (loss-not_credited)
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_TITLE', 'Accredito');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_DESC', 'Stato per ordini, per cui l\'importo è stato accreditato sul conto di SOFORT Bank.'); // (received-credited)
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_TITLE', 'Rimborso parziale');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_DESC', 'Stato per ordini, per cui un importo parziale viene rimborsato all\'acquirente.');  // (refunded-compensation)
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_TITLE', 'Rimborso completo');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_DESC', 'Stato per ordini, per cui l\'intero importo viene rimborsato all\'acquirente.'); // (refunded-refunded)

define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TITLE', '"Modalità di pagamento consigliata"');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_DESC', '"Segnare questa modalità di pagamento come "modalità di pagamento consigliata". Sulla pagina di pagamento un avviso potrà essere visualizzato direttamente dietro la modalità di pagamento".');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TEXT', '("Modalità di pagamento consigliata")');

define('MODULE_PAYMENT_SOFORT_SU_TMP_COMMENT', 'SOFORT Banking selezionata come modalità di pagamento. Transazione non conclusa.');
define('MODULE_PAYMENT_SOFORT_SU_TMP_COMMENT_SELLER', 'Inoltro a SOFORT - pagamento non ancora effettuato.');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_ERROR_MESSAGE', 'La modalità di pagamento selezionata non è disponibile o è stata annullata dall\'acquirente. Ti preghiamo di selezionare un\'altra modalità di pagamento.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_SU', 'La modalità di pagamento selezionata non è disponibile o è stata annullata dall\'acquirente. Ti preghiamo di selezionare un\'altra modalità di pagamento.');

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_BUYER', 'Ordine con SOFORT Banking trasmesso con successo. Il tuo ID della transazione: {{transaction}}');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_BUYER', 'Non è stato ancora possibile riscontare l\'accredito. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_BUYER', '');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_SELLER', 'Accredito sul conto');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_BUYER', 'L\'importo della fattura verrà rimborsato. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_SELLER', 'Una parte dell\'importo della fattura verrà rimborsato. Importo totale rimborsato: {{refunded_amount}}. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_BUYER', 'Una parte dell\'importo verrà rimborsata.');

?>