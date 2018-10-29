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

define('MODULE_ORDER_TOTAL_SOFORT_TITLE', 'Modu� rabatowy sofort.de');
define('MODULE_ORDER_TOTAL_SOFORT_DESCRIPTION', 'Rabat dla metod p�atniczych sofort.com');

define('MODULE_ORDER_TOTAL_SOFORT_STATUS_TITLE', 'Poka� rabat');
define('MODULE_ORDER_TOTAL_SOFORT_STATUS_DESC', 'Pragn� Pa�stwo uruchomi� rabat metod p�atno�ci?');

define('MODULE_ORDER_TOTAL_SOFORT_SORT_ORDER_TITLE', 'Kolejno�� wy�wietlania');
define('MODULE_ORDER_TOTAL_SOFORT_SORT_ORDER_DESC', 'Kolejno�� wy�wietlania. Najni�sze cyfry zostaj� wy�wietlone jako pierwsze.');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SU_TITLE', 'Zni�ki dla SOFORT Banking');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SU_DESC', 'Podstawa rabatu (Najni�sza warto��:procent&kwota sta�a)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SL_TITLE', 'Zni�ki dla SOFORT Lastschrift');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SL_DESC', 'Podstawa rabatu (Minimalna warto��:procent&kwota sta�a)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SR_TITLE', 'Zni�ki dla Rechnung by SOFORT');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SR_DESC', 'Udzielenie rabatu (Minimalna warto��:procent&kwota sta�a)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SV_TITLE', 'Zni�ki dla Vorkasse by SOFORT');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SV_DESC', 'Udzielenie rabatu (Najni�sza warto��:procent&kwota sta�a)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_LS_TITLE', 'Zni�ki dla Lastschrift by SOFORT');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_LS_DESC', 'Podstawa rabatu (minimalna warto��:procent&kwota sta�a)');

define('MODULE_ORDER_TOTAL_SOFORT_INC_SHIPPING_TITLE', 'Bez koszt�w wysy�ki');
define('MODULE_ORDER_TOTAL_SOFORT_INC_SHIPPING_DESC', 'Koszty wysy�ki zostaj� r�wnie� obj�te rabatem');

define('MODULE_ORDER_TOTAL_SOFORT_INC_TAX_TITLE', 'Z podatkiem VAT');
define('MODULE_ORDER_TOTAL_SOFORT_INC_TAX_DESC', 'VAT zostaje obj�ty rabatem');

define('MODULE_ORDER_TOTAL_SOFORT_CALC_TAX_TITLE', 'Obliczenie VATu');
define('MODULE_ORDER_TOTAL_SOFORT_CALC_TAX_DESC', 'ponowne obliczenie kwoty podatku VAT');

define('MODULE_ORDER_TOTAL_SOFORT_ALLOWED_TITLE', 'Dozwolone strefy');
define('MODULE_ORDER_TOTAL_SOFORT_ALLOWED_DESC' , 'Prosimy o podanie <b>pojedynczo</b> stref, kt�re b�d� dozwolone do u�ytkowania przez ten modu�. (np. AT, DE (pusto pole oznacza uruchomienie wszystkich stref))');

define('MODULE_ORDER_TOTAL_SOFORT_DISCOUNT', 'Rabat');
define('MODULE_ORDER_TOTAL_SOFORT_FEE', 'Dop�ata');

define('MODULE_ORDER_TOTAL_SOFORT_TAX_CLASS_TITLE','Klasa podatkowa');
define('MODULE_ORDER_TOTAL_SOFORT_TAX_CLASS_DESC','Klasa podatkowa nie ma znaczenia i slu�y jedynie zapobieganiu komunikatu b��du.');

define('MODULE_ORDER_TOTAL_SOFORT_BREAK_TITLE','Wielokrotne obliczanie');
define('MODULE_ORDER_TOTAL_SOFORT_BREAK_DESC','Czy powinno by� mo�liwe wielokrotne obliczanie? Je�li nie zostanie przerwane po pierwszym pasuj�cym rabacie.');
?>