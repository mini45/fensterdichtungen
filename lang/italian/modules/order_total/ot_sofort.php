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

define('MODULE_ORDER_TOTAL_SOFORT_TITLE', 'Moldulo di sconto di sofort.de');
define('MODULE_ORDER_TOTAL_SOFORT_DESCRIPTION', 'Sconto per modalità di pagamento con sofort.com');

define('MODULE_ORDER_TOTAL_SOFORT_STATUS_TITLE', 'Mostrare sconto');
define('MODULE_ORDER_TOTAL_SOFORT_STATUS_DESC', 'Desideri attivare lo sconto per i sistemi di pagamento?');

define('MODULE_ORDER_TOTAL_SOFORT_SORT_ORDER_TITLE', 'Ordine di visualizzazione');
define('MODULE_ORDER_TOTAL_SOFORT_SORT_ORDER_DESC', 'Ordine di visualizzazione. Il numero più piccolo sarà visualizzato per prima.');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SU_TITLE', 'Scala sconti per SOFORT Banking');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SU_DESC', 'Sconto (valore minimo:percentuale&importo fisso)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SL_TITLE', 'Scala sconti per SOFORT Lastschrift');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SL_DESC', 'Sconto (valore minimo:percentuale&importo fisso)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SR_TITLE', 'Scala sconti per SOFORT Rechnung');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SR_DESC', 'Sconto (valore minimo:percentuale&importo fisso)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SV_TITLE', 'Scala sconti per Vorkasse by SOFORT');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SV_DESC', 'Sconto (valore minimo:percentuale&importo fisso)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_LS_TITLE', 'Scala sconti per Lastschrift by SOFORT');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_LS_DESC', 'Sconto (valore minimo:percentuale&importo fisso)');

define('MODULE_ORDER_TOTAL_SOFORT_INC_SHIPPING_TITLE', 'Compresi costi di spedizione');
define('MODULE_ORDER_TOTAL_SOFORT_INC_SHIPPING_DESC', 'Le spese di spedizione verranno scontate');

define('MODULE_ORDER_TOTAL_SOFORT_INC_TAX_TITLE', 'Inclusa imposta sul fatturato');
define('MODULE_ORDER_TOTAL_SOFORT_INC_TAX_DESC', 'L\'IVA verrà scontata');

define('MODULE_ORDER_TOTAL_SOFORT_CALC_TAX_TITLE', 'Calcolo dell\'imposta sul fatturato');
define('MODULE_ORDER_TOTAL_SOFORT_CALC_TAX_DESC', 'ricalcolare l\'importo dell\'IVA');

define('MODULE_ORDER_TOTAL_SOFORT_ALLOWED_TITLE', 'Zone consentite');
define('MODULE_ORDER_TOTAL_SOFORT_ALLOWED_DESC' , 'Indicare<b>singolarmente</b> le zone autorizzate per questo modulo. (ad es. AT, DE (se vuoto, vengono autorizzate tutte le zone))');

define('MODULE_ORDER_TOTAL_SOFORT_DISCOUNT', 'Sconto');
define('MODULE_ORDER_TOTAL_SOFORT_FEE', 'Supplemento');

define('MODULE_ORDER_TOTAL_SOFORT_TAX_CLASS_TITLE','Fascia di reddito');
define('MODULE_ORDER_TOTAL_SOFORT_TAX_CLASS_DESC','La classe d\'imposta è irrilevante e serve solo ad evitare un errore.');

define('MODULE_ORDER_TOTAL_SOFORT_BREAK_TITLE','Calcolo multiplo');
define('MODULE_ORDER_TOTAL_SOFORT_BREAK_DESC','Vuoi rendere possibile più calcoli contemporaneamente? In caso contrario, l\'operazione verrà annullata dopo il primo sconto.');
?>