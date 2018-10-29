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

define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS_WITH_LIGHTBOX', '<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">Ho letto l\'Informativa sulla protezione dei dati personali.</a>');
define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS', '
	<script type="text/javascript">
		function showSrConditions() {
			srOverlay = new sofortOverlay(jQuery(".srOverlay"), "callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/de/sr/privacy_de");
			srOverlay.trigger();
		}
	</script>
	<noscript>
		<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">Ho letto l\'Informativa sulla protezione dei dati personali.</a>
	</noscript>
	<!-- comSeo-Ajax-Checkout-Bugfix: show also div, when buyer doesnt use JS -->
	<div>
		<a id="srNotice" href="javascript:void(0)" onclick="showSrConditions();">Ho letto l\'Informativa sulla protezione dei dati personali.</a>
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
		srOverlay = new sofortOverlay(jQuery("#srExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/rbs/shopinfo/it");
	</script>
');

define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_TEXT_TITLE_ADMIN', 'Rechnung by SOFORT <br /><img src="https://images.sofort.com/it/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_TEXT_TITLE', 'Acquisto su fattura <br /><img src="https://images.sofort.com/it/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_TITLE', 'Acquisto su fattura');
define('MODULE_PAYMENT_SOFORT_SR_LOGO_HTML', '<img src="https://images.sofort.com/it/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_ERROR_MESSAGE', 'La modalità di pagamento selezionata non è disponibile o è stata annullata dall\'acquirente. Ti preghiamo di selezionare un\'altra modalità di pagamento.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_SR', 'La modalità di pagamento selezionata non è disponibile o è stata annullata dall\'acquirente. Ti preghiamo di selezionare un\'altra modalità di pagamento.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_SR_CHECKOUT_TEXT', '');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_CONFIRM_SR', 'Confermare la fattura qui:');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_TITLE', 'Ordine di visualizzazione');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_DESC', 'Ordine di visualizzazione. Il numero più piccolo sarà visualizzato per prima.');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_TITLE', 'Attivare modulo di sofort.de');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_DESC', 'Attivare/disattivare l\'intero modulo');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_DESCRIPTION', 'Acquisto su fattura con garanzia di pagamento.');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_TITLE', 'Zone consentite');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_DESC', 'Indicare<b>singolarmente</b> le zone autorizzate per questo modulo. (ad es. AT, DE (se vuoto, vengono autorizzate tutte le zone))');
define('MODULE_PAYMENT_SOFORT_SR_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_SR_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_TITLE', 'Stato dell\'ordine non confermato');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_DESC', 'Stato dell\'ordine dopo un pagamento avvenuto con successo. La fattura non è ancora stata ancora approvata dal venditore.'); // (pending-confirm_invoice)
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_TITLE', 'Stato dell\'ordine in caso di annullamento totale');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_DESC', 'Stato dell\'ordine annullato<br />Stato dell\'ordine dopo un annullamento della fattura.');  //(loss-canceled, loss-confirmation_period_expired)
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Stato dell\'ordine confermato');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Stato dell\'ordine dopo il completamento della transazione con successo e approvazione della fattura da parte del venditore.'); //(pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_TITLE', 'Cancellazione dopo conferma (accredito)');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_DESC', 'Stato per ordini, che sono stati annullati completamente dopo la conferma (accredito).'); // (refunded_refunded)
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT', 'Acquisto su fattura selezionato come metodo di pagamento. Transazione non conclusa.');
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT_SELLER', 'Inoltro a SOFORT - pagamento non ancora effettuato.');

define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TITLE', '"Modalità di pagamento consigliata"');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_DESC', '"Segnare questa modalità di pagamento come "modalità di pagamento consigliata". Sulla pagina di pagamento un avviso potrà essere visualizzato direttamente dietro la modalità di pagamento".');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TEXT', '("Modalità di pagamento consigliata")');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED_HISTORY', 'L\'ordine per confermare la fattura è stato inviato a SOFORT. Conferma di SOFORT in sospeso.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CANCELED_HISTORY', 'L\'ordine per annullare la fattura è stato inviato a SOFORT. Conferma di SOFORT in sospeso.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_REFUNDED_HISTORY', 'L\'ordine per accreditare la fattura è stato inviato a SOFORT. Conferma di SOFORT in sospeso.');

/////////////////////////////////////////////////
//////// Seller-Backend and callback.php ////////
/////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_SR_CONFIRM_INVOICE', 'Confermare fattura');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE', 'Stornare la fattura');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE', 'Accredita l\'importo');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE_QUESTION', 'Sei sicuro di voler annullare la fattura? Questa operazione non potrà più essere annullata.');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE_QUESTION', 'Sei sicuro di voler accreditare l\'importo? Questa procedura non può essere annullata.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED_REFUNDED', 'La fattura è stata annullata. Importo accreditato.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED', 'La fattura è stata annullata.');

define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE', 'Scaricare la fattura');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_HINT', 'È possibile scaricare il documento corrispondente (anteprima fattura, fattura, nota di credito).');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_CREDIT_MEMO', 'Scaricare la nota di credito');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_PREVIEW', 'Scaricare l\'anteprima della fattura');

define('MODULE_PAYMENT_SOFORT_SR_EDIT_CART', 'Aggiornare il carrello');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART', 'Salvare il carrello');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_QUESTION', 'Vuoi veramente modificare il carrello?');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_HINT', 'Salvare qui le modifiche al carrello. In caso di fattura già confermata, la riduzione della quantità di un articolo o la sua eliminazione avrà come conseguenza la creazione di una nota di credito.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_HINT', 'Puoi modificare gli sconti o i sovrapprezzi. I sovrapprezzi non possono essere aumentati e gli sconti non possono contenere importi superiori a zero. L\'importo totale della fattura non può essere aumentato per mezzo di una modifica.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_GTZERO_HINT', 'Gli sconti non possono contenere un importo superiore a 0.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY', 'Modificare la quantità');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_HINT', 'È possibile modificare la quantità degli articoli per ogni posizione. La quantità si può solo ridurre, non aumentare.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_TOTAL_GTZERO', 'Il numero degli articoli non può essere ridotto, poiché l\'importo complessivo della fattura non può essere negativo.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_ZERO_HINT', 'La quantità deve essere maggiore di 0. Per cancellare l\'articolo, si prega di contrassegnarlo alla fine della riga.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE', 'Modificare il prezzo');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_HINT', 'È possibile modificare il prezzo dei singoli articoli per posizione. I prezzi si possono solo ridurre, non aumentare.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_TOTAL_GTZERO', 'Il prezzo non può essere ridotto, poiché l\'importo complessivo della fattura non può essere negativo.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_HINT', 'Non si possono modificare contemporaneamente sia prezzo che quantità.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_NAN', 'Hai inserito caratteri non validi. Sono ammessi solo numeri per queste modifiche.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_VALUE_LTZERO_HINT', 'Il valore non può essere minore di 0.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE', 'Inserire un commento');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE_HINT', 'Se si modifica una fattura già confermata va inserita una motivazione per il cambiamento effettuato. Questa apparirà sulla nota di credito come commento al relativo articolo.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_HINT', 'Puoi adattare il prezzo ai costi di spedizione. Il prezzo può solo essere ridotto, non può essere aumentato.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_TOTAL_GTZERO', 'I costi di spedizione non possono essere ridotti, poiché l\'importo complessivo della fattura non può essere negativo.');
define('MODULE_PAYMENT_SOFORT_SR_RECALCULATION', 'verrà ricalcolata');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_TOTAL_GTZERO','Questo articolo non può essere cancellato, poiché l\'importo complessivo della fattura non può essere negativo.');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_ARTICLE_FROM_INVOICE', 'Rimuovi articolo');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE', 'Eliminare la posizione');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_QUESTION', 'Sei sicuro di voler eliminare i seguenti articoli: %s ?');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_HINT', 'Selezionare gli articoli che si desiderano eliminare. In caso di fattura già confermata, l\'eliminazione di un articolo ha come conseguenza la creazione di una nota di credito.');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_LAST_ARTICLE_HINT', 'Riducendo il numero di tutti gli articoli o rimuovendo l\'ultimo articolo, la fattura verrà completamente stornata.');
define('MODULE_PAYMENT_SOFORT_SR_SYNC_FAILED_SELLER', 'Questo ordine contiene degli articoli che potrebbero creare problemi nella sincronizzazione con il server SOFORT. In caso di modifiche di spedizione, sconti o articoli effettuate successivamente, al fine d\'evitare una spedizione sbagliata, confronta i dati indicati nella fattura pdf di SOFORT con quelli inseriti nel negozio online. Eventuali modifiche del carrello possono essere eseguite solo nell\'area utenti di SOFORT.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_GX_CUSTOMIZER_AFFECTED', 'In genere si tratta solo di articoli che usano le funzioni GX-Customizers.');

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_BUYER', 'Ordine inviato con successo. Conferma non ancora avvenuta.');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_SELLER', 'Ordine concluso con successo - la fattura può essere confermata - ID di transazione:');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_BUYER', 'Ordine annullato.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_BUYER', 'Ordine confermato e in elaborazione.');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_SELLER', 'La fattura è stata confermata e creata.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_BUYER', 'L\'importo è stato accreditato.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_SELLER', 'L\'importo è stato accreditato. L\'accredito è stato creato.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_REANIMATED', 'Lo storno della fattura è stato annullato.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_BUYER', 'Ordine annullato.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_SELLER', 'L\'ordine è stato annullato. Il termine di conferma è scaduto.');

define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CURRENT_TOTAL', 'Importo attuale della fattura:');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED', 'La fattura è stata confermata');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_TRANSACTION_ID', 'ID della transazione');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CANCELED_REFUNDED', 'La fattura è stata annullata. Importo accreditato. {{time}}');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_EDITED', 'Il carrello è stato modificato.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_RESET', 'Il carrello è stato ripristinato.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9000', 'Non è stata trovata la transazione della fattura.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9001', 'Non è stato possibile confermare la fattura.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9002', 'La somma inserita supera il limite di credito.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9003', 'Non è stato possibile annullare la fattura.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9004', 'La richiesta contiene voci del carrello non valide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9005', 'Non è stato possibile aggiornare il carrello.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9006', 'L\'accesso all\'interfaccia non è più possibile dopo 30 giorni dal ricevimento del pagamento.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9007', 'La fattura è stata già annullata.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9008', 'L\'importo dell\'IVA inserito è troppo alto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9009', 'Gli importi delle aliquote IVA indicati negli articoli sono in conflitto tra loro.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9010', 'Non è stato possibile attualizzare il carrello.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9011', 'Non è stato indicato alcun commento relativo alla modifica del carrello.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9012', 'Non può essere aggiunta alcuna posizione nel carrello. Analogamente non si può aumentare la quantità delle singole voci.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9013', 'Nel carrello si trovano solamente articoli non fatturabili.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9014', 'Il numero di fattura inserito viene già utilizzato.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9015', 'Il numero di nota di credito inserito è stato già utilizzato.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9016', 'Il numero d\'ordine inserito viene già utilizzato.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9017', 'La fattura è stata già confermata.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9018', 'Non è stato modificato alcun dato della fattura.');