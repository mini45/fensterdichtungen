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
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TEXT', '("Zalecane sposoby zap³aty")');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION', '<b>iDEAL</b><br />Jak tylko klient wybierze t± metodê p³atnicz± i swój bank zostanie przekierowany przez SOFORT AG do swojego banku. Tam dokona on p³atno¶ci i zostanie przekierowany z powrotem do sklepu. Podczas pomy¶lnego potwierdzenia p³atno¶ci ma miejsce przez SOFORT AG tak zwany callback  do sklepu, który odpowiednio zmienia status p³atno¶ci  danego zamówienia. <br />Przygotowane przez SOFORT AG.');

//all shopsystem-params
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_TITLE', 'iDEAL - Aktywacja modu³u sofort.de');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TITLE', '"Zalecane sposoby zap³aty"');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_TITLE', 'Przetestuj klucz konfiguracji/API-Key');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_DESC', "<script>function t(){k = document.getElementsByName(\"configuration[MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY]\")[0].value;window.open(\"../callback/sofort/testAuth.php?k=\"+k);}</script><input type=\"button\" onclick=\"t()\" value=\"Test\" />");  //max 255 signs
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_TITLE' , MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_TITLE' , 'Strefa p³atno¶ci');
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_DESC' , 'Prosimy o podanie <b>pojedynczo</b> stref, które bêd± dozwolone do u¿ytkowania przez ten modu³. (np. AT, DE (pusto pole oznacza uruchomienie wszystkich stref))');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_TITLE' , 'Tymczasowy status zamówienia');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_TITLE', 'Potwierdzony status zamówienia');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_TITLE', 'Automatyczna anulacja z przelewem zwrotnym');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_TITLE', 'Czê¶ciowy zwrot');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_TITLE', 'Pe³ny zwrot');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_TITLE', 'Status zamówienia w przypadku przerwanej p³atno¶ci.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_TITLE', 'Status zamówienia przy pe³nym anulowaniu');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_TITLE', 'Kolejno¶æ wy¶wietlania');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_TITLE', 'Klucz konfiguracyjny nadany przez SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_TITLE', 'Has³o projektu');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_TITLE', 'Has³o powiadomieñ');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_TITLE', 'Tytu³ przelewu 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_TITLE', 'Tytu³ przelewu 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_TITLE', 'Logo+tekst');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_DESC', 'Aktywacja/deaktywacja ca³ego modu³u');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_DESC', 'Poleciæ iDEAL jako metodê p³atno¶ci');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_DESC', 'Kiedy strefa zostanie wybrana, metoda p³atnicza dotyczy tej strefy.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_DESC', 'Status zamówienia dla niezakoñczonych transakcji. Zamówienie zosta³o z³o¿one ale transakcja nie zosta³a jeszcze potwierdzona przez SOFORT AG.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_DESC', 'Potwierdzony status zamówienia<br />Status zamówienia po zakoñczonej transkacji.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_DESC', 'Status zamówienia w przypadku zupe³nej anulacji.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_DESC', 'Status zamówienia w przypadku zamówieñ, które zosta³y przerwane podczas procesu p³atno¶ci.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_DESC', 'Status dla zamówieñ, w przypadku których ¶rodki pieniê¿ne wp³ynê³y dopiero po up³ywie Timeout ustanowionego w projekcie SOFORT i z tego powodu zosta³y automatycznie anulowane. Przelew zwrotny na konto kupuj±cego równie¿ zostanie zlecony automatycznie.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_DESC', 'Status dla zamówieñ, w przypadku których kupuj±cemu zosta³a zwrócona czê¶æ sumy.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_DESC', 'Status dla zamówieñ, w przypadku których ca³a suma zosta³a zwrócona kupuj±cemu.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_DESC', 'Kolejno¶æ wy¶wietlania. Najni¿sze cyfry zostaj± wy¶wietlone jako pierwsze.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_DESC', 'Klucz konfiguracyjny nadany przez SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_DESC', 'Nadane przez SOFORT AG has³o projektu');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_DESC', 'Nadane przez SOFORT AG has³o powiadomieñ');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_DESC', 'Tytu³ przelewu 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_DESC', 'Tytu³ przelewu 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_DESC', 'Baner lub tekst przy wyborze opcji p³atniczej');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CHECKOUT_TEXT', 'iDEAL.nl - przelewy internetowe dla elektronicznego handlu w Holandii. W celu zap³aty przy pomocy iDEAL potrzebuj± Pañstwo konto bankowego w jednym z wymienionych banków. Dokonuj± Pañstwo przelewu bezpo¶rednio w Pañstwa banku. Us³ugi/towary zostan± NATYCHMIAST wys³ane!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'iDEAL.nl - przelewy internetowe dla elektronicznego handlu w Holandii. W celu zap³aty przy pomocy iDEAL potrzebuj± Pañstwo konto bankowego w jednym z wymienionych banków. Dokonuj± Pañstwo przelewu bezpo¶rednio w Pañstwa banku. Us³ugi/towary zostan± NATYCHMIAST wys³ane!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_COMMENT', 'iDEAL jako metoda p³atnicza. Transakcja nie zosta³a zakoñczona.');

define('MODULE_PAYMENT_SOFORT_IDEAL_PEN_NOT_CRE_YET_BUYER', 'Zamównienie zosta³o skutecznie przekazane. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_REC_CRE_BUYER', '{{paymentMethodStr}} - Pieni±dze nadesz³y. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_LOS_NOT_CRE_YET_BUYER', 'P³atno¶æ zosta³a anulowana.');
define('MODULE_PAYMENT_SOFORT_IDEAL_LAT_SUC_AUT_BUYER', 'Transakcja zosta³a automatycznie anulowana. Przelew zwrotny na rachunek klienta koñcowego zosta³o przyjête do realizacji.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_COM_BUYER', 'Czê¶æ sumy zostanie zwrócony.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_REF_BUYER', 'Kwota faktury zostanie zwrócona. {{time}}');

//////////////////////////////////////////////////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10000', 'Prosimy o wybranie innego banku przed wys³aniem!');

define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_TEXT', 'iDEAL.nl - przelewy internetowe dla elektronicznego handlu w Holandii. W celu zap³aty przy pomocy iDEAL potrzebuj± Pañstwo konto bankowego w jednym z wymienionych banków. Dokonuj± Pañstwo przelewu bezpo¶rednio w Pañstwa banku. Us³ugi/towary zostan± NATYCHMIAST wys³ane!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_ERROR_HEADING', 'Nastêpuj±cy b³±d wyst±pi³ podczas procesu:');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_ALL_CODES', 'B³±d podczas przesy³ania danych, prosimy o wybranie innej metody p³atniczej lub o kontakt ze sprzedawc±.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_DEFAULT', 'B³±d podczas przesy³ania danych, prosimy o wybranie innej metody p³atniczej lub o kontakt ze sprzedawc±.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IDEALSELECTED_PENDING' , 'iDEAL jako metoda p³atnicza. Transakcja nie zosta³a zakoñczona.');
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
      	<p>Po potwierdzeniu zamówienia zostan± Pañstwo przekierowani do systemu p³atniczego wybranego przez Pañstwa banku i tam mog± Pañstwo dokonaæ przelewu internetowego.</p><p>Do tego celu potrzebuj± Pañstwo danych dostêpowych Pañstwa bankowo¶ci internetowej: po³±czenie bankowe, numer konta, PIN i kod weryfikacyjny TAN. Wiêcej informacji znajd± Pañstwo tutaj:  <a href="http://www.ideal.nl" target="_blank">iDEAL.nl</a></p>
      </td>
    </tr>
  </table>');