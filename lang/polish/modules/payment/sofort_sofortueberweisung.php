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
		suOverlay = new sofortOverlay(jQuery("#suExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/sb/shopinfo/pl");
	</script>
');

define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_TEXT_TITLE', 'SOFORT Banking <br /> <img src="https://images.sofort.com/pl/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_TEXT_TITLE_ADMIN', 'SOFORT Banking <br /> <img src="https://images.sofort.com/pl/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE', 'SOFORT Banking');
define('MODULE_PAYMENT_SOFORT_SU_KS_TEXT_TITLE', 'SOFORT Banking z ochron� kupuj�cgo');
define('MODULE_PAYMENT_SOFORT_SU_LOGO_HTML', '<img src="https://images.sofort.com/pl/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION', 'SOFORT Banking jest bezp�atn�, sprawdzon� przez T�V us�ug� p�atno�ci firmy SOFORT AG.');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE', '     <table border="0" cellspacing="0" cellpadding="0">      <tr>        <td valign="bottom">
	<a onclick="javascript:window.open(\'https://images.sofort.com/pl/su/landing.php\',\'Informacje klient�w\',\'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1020, height=900\');" style="float:left; width:auto; cursor:pointer;">
		{{image}}
	</a>
	</td>      </tr>      <tr> <td class="main">{{text}}</td>      </tr>      </table>');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'SOFORT Banking');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_TEXT', '<ul><li>System p�atniczy ze sprawdzon� przez T�V ochron� danych</li><li>Rejestracja nie jest konieczna</li><li>Towar/us�uga zostanie NATYCHMIAST wys�ana</li><li>Prosimy o przygotowanie danych bankowo�ci internetowej(PIN/TAN)</li></ul>');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_TEXT_KS', '<ul><li>Poczas zap�aty z SOFORT Banking korzystaj� Pa�stwo z ochrony kupuj�cego! [[link_beginn]]Wi�cej informacji[[link_end]]</li><li>System p�atniczy ze sprawdzon� przez T�V ochron� danych </li><li>Brak konieczno�ci rejestracji</li><li>Towar/us�uga jest NATYCHMIAST wysy�ana</li><li>Prosimy o przygotowanie danych bankowo�ci internetowej (PIN/TAN)</li></ul>');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_INFOLINK_KS', 'https://www.sofort-bank.com/eng-DE/general/kaeuferschutz/informationen-fuer-kaeufer/');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_ALLOWED_TITLE', 'Dozwolone strefy');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_ALLOWED_DESC', 'Prosimy o podanie <b>pojedynczo</b> stref, kt�re b�d� dozwolone do u�ytkowania przez ten modu�. (np. AT, DE (pusto pole oznacza uruchomienie wszystkich stref))');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_TITLE', 'Aktywacja modu�u sofort.de');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_DESC', 'Aktywacja/deaktywacja ca�ego modu�u');
define('MODULE_PAYMENT_SOFORT_SU_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_SU_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_TITLE', 'Kolejno�� wy�wietlania');
define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_DESC', 'Kolejno�� wy�wietlania. Najni�sze cyfry zostaj� wy�wietlone jako pierwsze.');
define('MODULE_PAYMENT_SOFORT_SU_KS_STATUS_TITLE', 'Ochrona kupuj�cego aktywowana');
define('MODULE_PAYMENT_SOFORT_SU_KS_STATUS_DESC', 'Aktywacja ochrony kupuj�cego dla SOFORT Banking.');

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Potwierdzony status zam�wienia');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Potwierdzony status zam�wienia<br />Status zam�wienia po zako�czonej transkacji.'); // (pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_TITLE', 'Status zam�wienia, gdy nie stwierdzono wp�ywu �rodk�w');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_DESC', 'Status zam�wienia w przypadku braku wp�ywu pieni�dzy na koncie. (Wymagania: konto w Sofort Bank).'); // (loss-not_credited)
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_TITLE', 'Wp�yw pieni�dzy');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_DESC', 'Status dla zam�wie�, gdy dosz�y pieni�dze na konto SOFORT Bank.'); // (received-credited)
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_TITLE', 'Cz�ciowy zwrot');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_DESC', 'Status dla zam�wie�, w przypadku kt�rych kupuj�cemu zosta�a zwr�cona cz�� sumy.');  // (refunded-compensation)
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_TITLE', 'Pe�ny zwrot');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_DESC', 'Status dla zam�wie�, w przypadku kt�rych ca�a suma zosta�a zwr�cona kupuj�cemu.'); // (refunded-refunded)

define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TITLE', '"Zalecane sposoby zap�aty"');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_DESC', '"Zaznacz t� metod� p�atno�ci jako "polecana metoda p�atno�ci". Na stronie p�atno�ci ma miejsce wskazanie bezpo�rednio za metod� p�atno�ci."');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TEXT', '("Zalecane sposoby zap�aty")');

define('MODULE_PAYMENT_SOFORT_SU_TMP_COMMENT', 'SOFORT Banking wybrany jako metoda p�atnicza. Transakcja nie zosta�a zako�czona.');
define('MODULE_PAYMENT_SOFORT_SU_TMP_COMMENT_SELLER', 'Przekierowanie do SOFORT - p�atno�� nie mia�a jeszcze miejsca.');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_ERROR_MESSAGE', 'Wybrana metoda p�atnicza nie jest niestety mo�liwa lub zosta�a przerwana na �yczenie klienta. Prosimy o wybranie innej metody p�atniczej.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_SU', 'Wybrana metoda p�atnicza nie jest niestety mo�liwa lub zosta�a przerwana na �yczenie klienta. Prosimy o wybranie innej metody p�atniczej.');

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_BUYER', 'Zam�wienie z SOFORT Banking zosta�o pomy�lnie przes�ane. Pa�stwa numer ID: {{transaction}}');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_BUYER', 'Jak do tej pory nie stwierdzono nadej�cia pieni�dzy. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_BUYER', '');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_SELLER', 'Wp�yni�cie p�atno�ci na konto');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_BUYER', 'Kwota faktury zostanie zwr�cona. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_SELLER', 'Cz�� kwoty z rachunku zosta�a zwr�cona. Ca�kowita zwr�cona kwota: {{refunded_amount}}. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_BUYER', 'Cz�� sumy zostanie zwr�cony.');

?>