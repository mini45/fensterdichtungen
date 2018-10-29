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
define('MODULE_PAYMENT_SOFORT_SU_KS_TEXT_TITLE', 'SOFORT Banking z ochron± kupuj±cgo');
define('MODULE_PAYMENT_SOFORT_SU_LOGO_HTML', '<img src="https://images.sofort.com/pl/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION', 'SOFORT Banking jest bezp³atn±, sprawdzon± przez TÜV us³ug± p³atno¶ci firmy SOFORT AG.');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE', '     <table border="0" cellspacing="0" cellpadding="0">      <tr>        <td valign="bottom">
	<a onclick="javascript:window.open(\'https://images.sofort.com/pl/su/landing.php\',\'Informacje klientów\',\'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1020, height=900\');" style="float:left; width:auto; cursor:pointer;">
		{{image}}
	</a>
	</td>      </tr>      <tr> <td class="main">{{text}}</td>      </tr>      </table>');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'SOFORT Banking');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_TEXT', '<ul><li>System p³atniczy ze sprawdzon± przez TÜV ochron± danych</li><li>Rejestracja nie jest konieczna</li><li>Towar/us³uga zostanie NATYCHMIAST wys³ana</li><li>Prosimy o przygotowanie danych bankowo¶ci internetowej(PIN/TAN)</li></ul>');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_TEXT_KS', '<ul><li>Poczas zap³aty z SOFORT Banking korzystaj± Pañstwo z ochrony kupuj±cego! [[link_beginn]]Wiêcej informacji[[link_end]]</li><li>System p³atniczy ze sprawdzon± przez TÜV ochron± danych </li><li>Brak konieczno¶ci rejestracji</li><li>Towar/us³uga jest NATYCHMIAST wysy³ana</li><li>Prosimy o przygotowanie danych bankowo¶ci internetowej (PIN/TAN)</li></ul>');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_INFOLINK_KS', 'https://www.sofort-bank.com/eng-DE/general/kaeuferschutz/informationen-fuer-kaeufer/');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_ALLOWED_TITLE', 'Dozwolone strefy');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_ALLOWED_DESC', 'Prosimy o podanie <b>pojedynczo</b> stref, które bêd± dozwolone do u¿ytkowania przez ten modu³. (np. AT, DE (pusto pole oznacza uruchomienie wszystkich stref))');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_TITLE', 'Aktywacja modu³u sofort.de');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_DESC', 'Aktywacja/deaktywacja ca³ego modu³u');
define('MODULE_PAYMENT_SOFORT_SU_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_SU_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_TITLE', 'Kolejno¶æ wy¶wietlania');
define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_DESC', 'Kolejno¶æ wy¶wietlania. Najni¿sze cyfry zostaj± wy¶wietlone jako pierwsze.');
define('MODULE_PAYMENT_SOFORT_SU_KS_STATUS_TITLE', 'Ochrona kupuj±cego aktywowana');
define('MODULE_PAYMENT_SOFORT_SU_KS_STATUS_DESC', 'Aktywacja ochrony kupuj±cego dla SOFORT Banking.');

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Potwierdzony status zamówienia');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Potwierdzony status zamówienia<br />Status zamówienia po zakoñczonej transkacji.'); // (pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_TITLE', 'Status zamówienia, gdy nie stwierdzono wp³ywu ¶rodków');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_DESC', 'Status zamówienia w przypadku braku wp³ywu pieniêdzy na koncie. (Wymagania: konto w Sofort Bank).'); // (loss-not_credited)
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_TITLE', 'Wp³yw pieniêdzy');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_DESC', 'Status dla zamówieñ, gdy dosz³y pieni±dze na konto SOFORT Bank.'); // (received-credited)
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_TITLE', 'Czê¶ciowy zwrot');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_DESC', 'Status dla zamówieñ, w przypadku których kupuj±cemu zosta³a zwrócona czê¶æ sumy.');  // (refunded-compensation)
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_TITLE', 'Pe³ny zwrot');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_DESC', 'Status dla zamówieñ, w przypadku których ca³a suma zosta³a zwrócona kupuj±cemu.'); // (refunded-refunded)

define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TITLE', '"Zalecane sposoby zap³aty"');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_DESC', '"Zaznacz t± metodê p³atno¶ci jako "polecana metoda p³atno¶ci". Na stronie p³atno¶ci ma miejsce wskazanie bezpo¶rednio za metod± p³atno¶ci."');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TEXT', '("Zalecane sposoby zap³aty")');

define('MODULE_PAYMENT_SOFORT_SU_TMP_COMMENT', 'SOFORT Banking wybrany jako metoda p³atnicza. Transakcja nie zosta³a zakoñczona.');
define('MODULE_PAYMENT_SOFORT_SU_TMP_COMMENT_SELLER', 'Przekierowanie do SOFORT - p³atno¶æ nie mia³a jeszcze miejsca.');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_ERROR_MESSAGE', 'Wybrana metoda p³atnicza nie jest niestety mo¿liwa lub zosta³a przerwana na ¿yczenie klienta. Prosimy o wybranie innej metody p³atniczej.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_SU', 'Wybrana metoda p³atnicza nie jest niestety mo¿liwa lub zosta³a przerwana na ¿yczenie klienta. Prosimy o wybranie innej metody p³atniczej.');

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_BUYER', 'Zamówienie z SOFORT Banking zosta³o pomy¶lnie przes³ane. Pañstwa numer ID: {{transaction}}');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_BUYER', 'Jak do tej pory nie stwierdzono nadej¶cia pieniêdzy. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_BUYER', '');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_SELLER', 'Wp³yniêcie p³atno¶ci na konto');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_BUYER', 'Kwota faktury zostanie zwrócona. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_SELLER', 'Czê¶æ kwoty z rachunku zosta³a zwrócona. Ca³kowita zwrócona kwota: {{refunded_amount}}. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_BUYER', 'Czê¶æ sumy zostanie zwrócony.');

?>