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
 * $Id: sofort_ideal.php 6097 2013-04-22 12:00:13Z rotsch $
 */

//include language-constants for used in all Multipay Projects - NOTICE: iDEAL is not Multipay
require_once 'sofort_general.php';

define('MODULE_PAYMENT_SOFORT_IDEAL_TEXT_TITLE', 'iDEAL'); //needed by core
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_TITLE', 'iDEAL <br /><img src="https://images.sofort.com/it/ideal/logo_90x30.png" alt="Logo iDEAL"/>');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_TITLE_ADMIN', 'iDEAL <br /><img src="https://images.sofort.com/it/ideal/logo_90x30.png" alt="Logo iDEAL"/>');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TEXT', '("Modalità di pagamento consigliata")');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION', '<b>iDEAL</b><br />Appena il cliente avrà selezionato la modalità di pagamento e la sua banca, verrà reindirizzato alla sua banca mediante Payment SOFORT AG. In seguito effettuerà il pagamento e verrà reindirizzato alla sua piattaforma. Se il pagamento è avvenuto con successo verrà avviato un callback al sistema del negozio online attraverso SOFORT AG, che modificherà di conseguenza lo stato di pagamento dell\'ordine.<br />Messo a disposizione da SOFORT AG');

//all shopsystem-params
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_TITLE', 'iDEAL - Attivare modulo di sofort.de');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TITLE', '"Modalità di pagamento consigliata"');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_TITLE', 'Test della chiave di configurazione/API key');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_DESC', "<script>function t(){k = document.getElementsByName(\"configuration[MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY]\")[0].value;window.open(\"../callback/sofort/testAuth.php?k=\"+k);}</script><input type=\"button\" onclick=\"t()\" value=\"Test\" />");  //max 255 signs
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_TITLE' , MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_TITLE' , 'Zona di pagamento');
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_DESC' , 'Indicare<b>singolarmente</b> le zone autorizzate per questo modulo. (ad es. AT, DE (se vuoto, vengono autorizzate tutte le zone))');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_TITLE' , 'Stato dell\'ordine temporaneo');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_TITLE', 'Stato dell\'ordine confermato');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_TITLE', 'Annullamento automatico con storno');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_TITLE', 'Rimborso parziale');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_TITLE', 'Rimborso completo');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_TITLE', 'Stato dell\'ordine per pagamento annullato.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_TITLE', 'Stato dell\'ordine in caso di annullamento totale');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_TITLE', 'Ordine di visualizzazione');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_TITLE', 'Chiave di configurazione assegnata da SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_TITLE', 'Password di progetto');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_TITLE', 'Password di notifica');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_TITLE', 'Causale 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_TITLE', 'Causale 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_TITLE', 'Logo+Testo');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_DESC', 'Attivare/disattivare l\'intero modulo');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_DESC', 'Selezionare iDEAL come modalità di pagamento consigliata');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_DESC', 'Se è stata selezionata una zona, il metodo di pagamento è valido solo per questa zona.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_DESC', 'Stato dell\'ordine per transazioni non concluse<br />L\'ordine è stato eseguito, ma la transazione non è stata ancora confermata da SOFORT AG.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_DESC', 'Stato dell\'ordine confermato<br />Stato dell\'ordine dopo l\'avvenuta transazione.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_DESC', 'Stato dell\'ordine in caso di annullamento totale.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_DESC', 'Stato di ordini che sono stati annullati durante la procedura di pagamento.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_DESC', 'Stato per ordini, per cui l\'accredito è stato riscontrato dopo la scadenza del timout definito nel progetto di SOFORT e annullato di conseguenza automaticamente per questo motivo. Lo storno sul conto dell\'acquirente viene effettuato automaticamente.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_DESC', 'Stato per ordini, per cui un importo parziale viene rimborsato all\'acquirente.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_DESC', 'Stato per ordini, per cui l\'intero importo viene rimborsato all\'acquirente.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_DESC', 'Ordine di visualizzazione. Il numero più piccolo sarà visualizzato per prima.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_DESC', 'Chiave di configurazione assegnata da SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_DESC', 'Password di progetto assegnata da SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_DESC', 'Password di notifica assegnata da SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_DESC', 'Causale 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_DESC', 'Causale 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_DESC', 'Banner o testo nella selezione delle opzioni di pagamento');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CHECKOUT_TEXT', 'iDEAL.nl - bonifici online per l\'e-commerce con i Paesi Bassi. Per il pagamento con iDEAL hai bisogno di un conto presso una delle banche indicate. Il bonifico viene effettuato direttamente presso la tua banca. Se disponibili i servizi/la merce vengono consegnati o spediti SUBITO!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'iDEAL.nl - bonifici online per l\'e-commerce con i Paesi Bassi. Per il pagamento con iDEAL hai bisogno di un conto presso una delle banche indicate. Il bonifico viene effettuato direttamente presso la tua banca. Se disponibili i servizi/la merce vengono consegnati o spediti SUBITO!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_COMMENT', 'iDEAL selezionata come modalità di pagamento. Transazione non conclusa.');

define('MODULE_PAYMENT_SOFORT_IDEAL_PEN_NOT_CRE_YET_BUYER', 'Ordine trasmesso con successo. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_REC_CRE_BUYER', '{{paymentMethodStr}} - Accredito ricevuto. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_LOS_NOT_CRE_YET_BUYER', 'Il pagamento è stato annullato.');
define('MODULE_PAYMENT_SOFORT_IDEAL_LAT_SUC_AUT_BUYER', 'La transazione è stata annullata. Lo storno sul conto dell?acquirente è stato impostato.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_COM_BUYER', 'Una parte dell\'importo verrà rimborsata.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_REF_BUYER', 'L\'importo della fattura verrà rimborsato. {{time}}');

//////////////////////////////////////////////////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10000', 'Selezionare una banca prima dell\'invio!');

define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_TEXT', 'iDEAL.nl - bonifici online per l\'e-commerce con i Paesi Bassi. Per il pagamento con iDEAL hai bisogno di un conto presso una delle banche indicate. Il bonifico viene effettuato direttamente presso la tua banca. Se disponibili i servizi/la merce vengono consegnati o spediti SUBITO!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_ERROR_HEADING', 'Il seguente errore è stato riscontrato durante l\'operazione:');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_ALL_CODES', 'Errore durante la trasmissione dei dati. Selezionare un\'altra modalità di pagamento o contattare il gestore.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_DEFAULT', 'Errore durante la trasmissione dei dati. Selezionare un\'altra modalità di pagamento o contattare il gestore.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IDEALSELECTED_PENDING' , 'iDEAL selezionata come modalità di pagamento. Transazione non conclusa.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_SELECTBOX_TITLE', 'Seleziona la tua banca.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE', '
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><a href="http://www.ideal.nl" target="_blank">{{image}}</a></td>
        <td style="padding-left: 20px;">{{text}}</td>
      </tr>
    </table>');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CHECKOUT_CONFIRMATION', '
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="main">
      	<p>Dopo la conferma dell\'ordine verrai reindirizzato al sistema di pagamento della banca selezionata e potrai effettuare il bonifico online.</p><p>A tal fine avrai bisogno dei dati di accesso al servizio di online banking, ovvero delle coordinate bancarie, numero di conto, PIN e password dispositiva. Per maggiori informazioni vai su: <a href="http://www.ideal.nl" target="_blank">iDEAL.nl</a></p>
      </td>
    </tr>
  </table>');