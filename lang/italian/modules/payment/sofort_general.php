<?php
/**
 * @version SOFORT Gateway 5.2.0 - $Date: 2013-02-21 14:07:21 +0100 (Thu, 21 Feb 2013) $
 * @author SOFORT AG (integration@sofort.com)
 * @link http://www.sofort.com/
 *
 * Copyright (c) 2012 SOFORT AG
 *
 * Released under the GNU General Public License (Version 2)
 * [http://www.gnu.org/licenses/gpl-2.0.html]
 *
 * $Id: sofort_general.php 5993 2013-02-21 13:07:21Z rotsch $
 */

define('MODULE_PAYMENT_SOFORT_MULTIPAY_JS_LIBS', '
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/jquery.min_1.8.3.js"></script>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/jquery-ui.min_1.9.1.js"></script>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/sofortbox.js"></script>
');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_APIKEY_TITLE', 'Chiave di configurazione');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_APIKEY_DESC', 'Chiave di configurazione assegnata da SOFORT AG');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_AUTH_TITLE', 'Test della chiave di configurazione/API key');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_AUTH_DESC', '<noscript>Ti preghiamo di attivare Javascript!</noscript>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/jquery.min_1.8.3.js"></script>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/testAuth.js"></script>
');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE', 'Zona di pagamento');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC', 'Se è stata selezionata una zona, il metodo di pagamento è valido solo per questa zona.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_1_TITLE', 'Causale 1');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_1_DESC', 'Nella causale 1 possono essere selezionate le seguenti opzioni');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_2_TITLE', 'Causale 2');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_2_DESC', 'Nella causale (massimo 27 caratteri) saranno sostituite le seguenti variabili:<br />{{order_date}}<br />{{customer_id}}<br />{{customer_name}}<br />{{customer_company}}<br />{{customer_email}}');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEXT_ERROR_HEADING', 'Il seguente errore è stato riscontrato durante l\'operazione:');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEXT_ERROR_MESSAGE', 'La modalità di pagamento selezionata non è disponibile o è stata annullata dall\'acquirente. Ti preghiamo di selezionare un\'altra modalità di pagamento.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_IMAGE_TITLE', 'Banner o testo nella selezione delle opzioni di pagamento');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_IMAGE_DESC', 'Banner o testo nella selezione delle opzioni di pagamento');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_PROF_SETTINGS_TITLE', '<span style="font-weight:bold; text-decoration:underline; font-size:1.4em;"><br />Impostazioni professionali</span> ');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_PROF_SETTINGS_DESC', 'Le seguenti impostazioni non richiedono di norma un\'aggiornamento e dovrebbero essere già configurate con i valori corretti.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_LOG_ENABLED_TITLE', 'Attivare registrazione');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_LOG_ENABLED_DESC', 'Attivare il logging per registrare errori, avvisi, così come richieste ai server e risposte dei server di SOFORT. Per motivi di privacy il logging deve essere attivato solo per la risoluzione di problemi. Per ulteriori informazioni, consultare il manuale.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEMP_STATUS_ID_TITLE', 'Stato dell\'ordine temporaneo');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEMP_STATUS_ID_DESC', 'Stato dell\'ordine per transazioni non concluse<br />L\'ordine è stato eseguito, ma la transazione non è stata ancora confermata da SOFORT AG.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ABORTED_STATUS_ID_TITLE', 'Stato dell\'ordine per pagamento annullato.'); //Bestellstatus bei abgebrochener/erfolgloser Zahlung
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ABORTED_STATUS_ID_DESC', 'Stato di ordini che sono stati annullati durante la procedura di pagamento.'); //Bestellstatus bei Bestellungen, die whrend des Bestellvorgangs oder im Wizard abgebrochen wurden.
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ORDER_CANCELED', 'L\'ordine è stato annullato.'); //Die Bestellung wurde abgebrochen.

define('MODULE_PAYMENT_SOFORT_MULTIPAY_TRANSACTION_ID', 'ID della transazione');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_UPDATE_NOTICE', 'Il modulo è stato aggiornato. Per un corretto funzionamento, ti preghiamo di disinstallare tutte (!) le modalità di pagamento di SOFORT e di reinstallarli (se necessario). Fino ad allora,le modalità di pagamento non saranno disponibili per l\'acquirente. Si prega di prendere nota delle impostazioni del modulo prima della disinstallazione!');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_VERSIONNUMBER', 'Numero di versione');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_FORWARDING', 'Stiamo elaborando la tua richiesta. Ti preghiamo di attendere e non interrompere l\'operazione. Questo procedimento può durare fino a 30 secondi.');

define('MODULE_PAYMENT_SOFORT_KEYTEST_SUCCESS', 'Chiave API confermata con successo!');
define('MODULE_PAYMENT_SOFORT_KEYTEST_SUCCESS_DESC', 'Test OK il');
define('MODULE_PAYMENT_SOFORT_KEYTEST_ERROR', 'Chiave API non confermata!');
define('MODULE_PAYMENT_SOFORT_KEYTEST_ERROR_DESC', 'Attenzione: API Key errata');
define('MODULE_PAYMENT_SOFORT_KEYTEST_DEFAULT', 'Chiave API non ancora confermata');

define('MODULE_PAYMENT_SOFORT_REFRESH_INFO', 'Se hai appena confermato, modificato, annullato o accreditato l\'ordine, potrebbe essere necessario aggiornare questa pagina {{refresh}} per poter visualizzare tutte le modifiche.');
define('MODULE_PAYMENT_SOFORT_REFRESH_PAGE', 'Clicca qui per aggiornare la pagina');
define('MODULE_PAYMENT_SOFORT_TRANSLATE_TIME', 'Ora');

//definition of error-codes that can resolve by calling the SOFORT-API
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_0',		'Si è verificato un errore sconosciuto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8002',		'Si è verificato un errore durante la validazione.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010',		'I dati inseriti sono incompleti o errati. Ti preghiamo di correggerli o contattare il gestore.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8011',		'Non compreso nell\'intervallo di valori validi.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8012',		'Il valore deve essere positivo.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8013',		'Al momento vengono supportati solo ordini in Euro. Ti preghiamo di correggere il valore e riprovare di nuovo.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8015',		'L\'importo complessivo è troppo alto o troppo basso. Ti preghiamo di correggere l\'informazione o contattare il fornitore.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8017',		'Caratteri sconosciuti');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8018',		'Numero massimo di caratteri superati (max. 27).');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8019',		'L\'ordine non può essere effettuato a causa dell\'indirizzo e-mail non valido. Ti preghiamo di correggerlo e riprovare di nuovo.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8020',		'L\'ordine non può essere eseguito a causa di un numero di telefono errato. Ti preghiamo di correggere i dati e riprovare di nuovo.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8021',		'Il codice del paese non è supportato. Ti preghiamo di rivolgerti al tuo gestore.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8022',		'Il BIC indicato non è valido.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8023',		'L\'ordine non può essere eseguito a causa di un BIC (Bank Identifier Code) errato. Ti preghiamo di correggere i dati e riprovare di nuovo.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8024',		'L\'ordine non può essere eseguito a causa di un codice paese errato. L\'indirizzo di spedizione/fatturazione deve essere in Germania. Ti preghiamo di correggere i dati e riprovare di nuovo.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8029',		'Sono compatibili solo conti tedeschi. Ti preghiamo di correggere l\'informazione o selezionare un\'altra modalità di pagamento.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8033',		'L\'importo totale è troppo alto. Ti preghiamo di correggerlo e riprovare di nuovo.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8034',		'L\'importo totale è troppo basso. Ti preghiamo di correggerlo e riprovare di nuovo.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8041',		'Valore per l\'IVA errato. Valori validi: 0, 7, 19.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8046',		'La validazione del conto bancario e del codice ABI è fallita.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8047',		'È stato superato il numero massimo di 255 caratteri.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8051',		'La richiesta contiene articoli non validi. Si prega di effettuare le dovute correzioni o di contattare il proprietario del negozio.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8058',		'Inserire almeno l\'intestatario del conto e riprovate di nuovo.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8061',		'Esiste già una transazione con i dati trasmessi.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8068',		'Kauf auf Rechnung è attualmente disponibile solo per clienti privati.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10001', 	'Compilare i campi relativi al numero di conto, codice ABI e intestatario del conto.'); //LS: holder and bankdata missing
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10002',	'Ti preghiamo di accettare l\'informativa sulla tutela dei dati personali.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10003',	'Con il metodo di pagamento prescelto non possono essere pagati né download né buoni regalo.');  //RBS and virtual content is not allowed
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10007',	'Si è verificato un errore sconosciuto.');  //Rechnung by SOFORT: check of shopamount against invoiceamount failed (more than one percent difference found)
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10008',	'Si è verificato un errore durante la sincronizzazione con i server di SOFORT. Si prega di utilizzare le possibilità nell\'Area Utenti di SOFORT per poter elaborare la fattura o il carrello.');  //Rechnung by SOFORT: Sync of Articles failed

//check for empty fields failed (code 8010 = 'must not be empty')
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.EMAIL_CUSTOMER',				'Il campo relativo all\'indirizzo e-mail non deve essere vuoto');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.PHONE_CUSTOMER',				'Il campo relativo al numero di telefono non deve essere vuoto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.FIRSTNAME',	'Il campo relativo al nome e all\'indirizzo di fatturazione non deve essere vuoto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.FIRSTNAME',	'Il campo relativo al nome dell\'indirizzo di spedizione non deve essere vuoto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.LASTNAME',	'Il campo relativo al cognome dell\'indirizzo di fatturazione non deve essere vuoto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.LASTNAME',	'Il campo relativo al nome dell\'indirizzo di spedizione non deve essere vuoto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.STREET',		'Via e numero civico devono essere separati da uno spazio.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.STREET',		'Via e numero civico devono essere separati da uno spazio.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.STREET_NUMBER',	'Via e numero civico devono essere separati da uno spazio.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.STREET_NUMBER',	'Via e numero civico devono essere separati da uno spazio.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.ZIPCODE',		'Il campo relativo al codice postale dell\'indirizzo di fatturazione non deve essere vuoto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.ZIPCODE',	'Il campo relativo al codice postale dell\'indirizzo di spedizione non deve essere vuoto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.CITY',		'Il campo relativo alla città dell\'indirizzo di fatturazione non deve essere vuoto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.CITY',		'Il campo relativo alla città e l\'indirizzo di spedizione non deve essere vuoto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.COUNTRY_CODE',	'Il campo relativo al codice paese dell\'indirizzo di fatturazione non deve essere vuoto.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.COUNTRY_CODE',	'Il campo relativo al codice paese dell\'indirizzo di fatturazione non deve essere vuoto.');