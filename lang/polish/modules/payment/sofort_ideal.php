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
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_TITLE', 'iDEAL <br /><img src="https://images.sofort.com/nl/ideal/logo_90x30.png" alt="Logo iDEAL"/>');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_TITLE_ADMIN', 'iDEAL <br /><img src="https://images.sofort.com/nl/ideal/logo_90x30.png" alt="Logo iDEAL"/>');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TEXT', '("Zalecane sposoby zap�aty")');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION', '<b>iDEAL</b><br />Jak tylko klient wybierze t� metod� p�atnicz� i sw�j bank zostanie przekierowany przez SOFORT AG do swojego banku. Tam dokona on p�atno�ci i zostanie przekierowany z powrotem do sklepu. Podczas pomy�lnego potwierdzenia p�atno�ci ma miejsce przez SOFORT AG tak zwany callback  do sklepu, kt�ry odpowiednio zmienia status p�atno�ci  danego zam�wienia. <br />Przygotowane przez SOFORT AG.');

//all shopsystem-params
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_TITLE', 'iDEAL - Aktywacja modu�u sofort.de');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TITLE', '"Zalecane sposoby zap�aty"');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_TITLE', 'Przetestuj klucz konfiguracji/API-Key');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_DESC', "<script>function t(){k = document.getElementsByName(\"configuration[MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY]\")[0].value;window.open(\"../callback/sofort/testAuth.php?k=\"+k);}</script><input type=\"button\" onclick=\"t()\" value=\"Test\" />");  //max 255 signs
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_TITLE' , MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_TITLE' , 'Strefa p�atno�ci');
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_DESC' , 'Prosimy o podanie <b>pojedynczo</b> stref, kt�re b�d� dozwolone do u�ytkowania przez ten modu�. (np. AT, DE (pusto pole oznacza uruchomienie wszystkich stref))');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_TITLE' , 'Tymczasowy status zam�wienia');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_TITLE', 'Potwierdzony status zam�wienia');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_TITLE', 'Automatyczna anulacja z przelewem zwrotnym');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_TITLE', 'Cz�ciowy zwrot');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_TITLE', 'Pe�ny zwrot');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_TITLE', 'Status zam�wienia w przypadku przerwanej p�atno�ci.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_TITLE', 'Status zam�wienia przy pe�nym anulowaniu');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_TITLE', 'Kolejno�� wy�wietlania');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_TITLE', 'Klucz konfiguracyjny nadany przez SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_TITLE', 'Has�o projektu');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_TITLE', 'Has�o powiadomie�');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_TITLE', 'Tytu� przelewu 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_TITLE', 'Tytu� przelewu 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_TITLE', 'Logo+tekst');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_DESC', 'Aktywacja/deaktywacja ca�ego modu�u');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_DESC', 'Poleci� iDEAL jako metod� p�atno�ci');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_DESC', 'Kiedy strefa zostanie wybrana, metoda p�atnicza dotyczy tej strefy.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_DESC', 'Status zam�wienia dla niezako�czonych transakcji. Zam�wienie zosta�o z�o�one ale transakcja nie zosta�a jeszcze potwierdzona przez SOFORT AG.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_DESC', 'Potwierdzony status zam�wienia<br />Status zam�wienia po zako�czonej transkacji.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_DESC', 'Status zam�wienia w przypadku zupe�nej anulacji.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_DESC', 'Status zam�wienia w przypadku zam�wie�, kt�re zosta�y przerwane podczas procesu p�atno�ci.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_DESC', 'Status dla zam�wie�, w przypadku kt�rych �rodki pieni�ne wp�yn�y dopiero po up�ywie Timeout ustanowionego w projekcie SOFORT i z tego powodu zosta�y automatycznie anulowane. Przelew zwrotny na konto kupuj�cego r�wnie� zostanie zlecony automatycznie.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_DESC', 'Status dla zam�wie�, w przypadku kt�rych kupuj�cemu zosta�a zwr�cona cz�� sumy.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_DESC', 'Status dla zam�wie�, w przypadku kt�rych ca�a suma zosta�a zwr�cona kupuj�cemu.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_DESC', 'Kolejno�� wy�wietlania. Najni�sze cyfry zostaj� wy�wietlone jako pierwsze.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_DESC', 'Klucz konfiguracyjny nadany przez SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_DESC', 'Nadane przez SOFORT AG has�o projektu');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_DESC', 'Nadane przez SOFORT AG has�o powiadomie�');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_DESC', 'Tytu� przelewu 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_DESC', 'Tytu� przelewu 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_DESC', 'Baner lub tekst przy wyborze opcji p�atniczej');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CHECKOUT_TEXT', 'iDEAL.nl - przelewy internetowe dla elektronicznego handlu w Holandii. W celu zap�aty przy pomocy iDEAL potrzebuj� Pa�stwo konto bankowego w jednym z wymienionych bank�w. Dokonuj� Pa�stwo przelewu bezpo�rednio w Pa�stwa banku. Us�ugi/towary zostan� NATYCHMIAST wys�ane!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'iDEAL.nl - przelewy internetowe dla elektronicznego handlu w Holandii. W celu zap�aty przy pomocy iDEAL potrzebuj� Pa�stwo konto bankowego w jednym z wymienionych bank�w. Dokonuj� Pa�stwo przelewu bezpo�rednio w Pa�stwa banku. Us�ugi/towary zostan� NATYCHMIAST wys�ane!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_COMMENT', 'iDEAL jako metoda p�atnicza. Transakcja nie zosta�a zako�czona.');

define('MODULE_PAYMENT_SOFORT_IDEAL_PEN_NOT_CRE_YET_BUYER', 'Zam�wnienie zosta�o skutecznie przekazane. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_REC_CRE_BUYER', '{{paymentMethodStr}} - Pieni�dze nadesz�y. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_LOS_NOT_CRE_YET_BUYER', 'P�atno�� zosta�a anulowana.');
define('MODULE_PAYMENT_SOFORT_IDEAL_LAT_SUC_AUT_BUYER', 'Transakcja zosta�a automatycznie anulowana. Przelew zwrotny na rachunek klienta ko�cowego zosta�o przyj�te do realizacji.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_COM_BUYER', 'Cz�� sumy zostanie zwr�cony.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_REF_BUYER', 'Kwota faktury zostanie zwr�cona. {{time}}');

//////////////////////////////////////////////////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10000', 'Prosimy o wybranie innego banku przed wys�aniem!');

define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_TEXT', 'iDEAL.nl - przelewy internetowe dla elektronicznego handlu w Holandii. W celu zap�aty przy pomocy iDEAL potrzebuj� Pa�stwo konto bankowego w jednym z wymienionych bank�w. Dokonuj� Pa�stwo przelewu bezpo�rednio w Pa�stwa banku. Us�ugi/towary zostan� NATYCHMIAST wys�ane!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_ERROR_HEADING', 'Nast�puj�cy b��d wyst�pi� podczas procesu:');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_ALL_CODES', 'B��d podczas przesy�ania danych, prosimy o wybranie innej metody p�atniczej lub o kontakt ze sprzedawc�.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_DEFAULT', 'B��d podczas przesy�ania danych, prosimy o wybranie innej metody p�atniczej lub o kontakt ze sprzedawc�.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IDEALSELECTED_PENDING' , 'iDEAL jako metoda p�atnicza. Transakcja nie zosta�a zako�czona.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_SELECTBOX_TITLE', 'Prosimy o wybranie banku');
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
      	<p>Po potwierdzeniu zam�wienia zostan� Pa�stwo przekierowani do systemu p�atniczego wybranego przez Pa�stwa banku i tam mog� Pa�stwo dokona� przelewu internetowego.</p><p>Do tego celu potrzebuj� Pa�stwo danych dost�powych Pa�stwa bankowo�ci internetowej: po��czenie bankowe, numer konta, PIN i kod weryfikacyjny TAN. Wi�cej informacji znajd� Pa�stwo tutaj:  <a href="http://www.ideal.nl" target="_blank">iDEAL.nl</a></p>
      </td>
    </tr>
  </table>');