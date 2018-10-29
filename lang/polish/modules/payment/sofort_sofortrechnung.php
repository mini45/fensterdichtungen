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

define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS_WITH_LIGHTBOX', '<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">Przeczyta�em uwagi na temat ochrony danych.</a>');
define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS', '
	<script type="text/javascript">
		function showSrConditions() {
			srOverlay = new sofortOverlay(jQuery(".srOverlay"), "callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/de/sr/privacy_de");
			srOverlay.trigger();
		}
	</script>
	<noscript>
		<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">Przeczyta�em uwagi na temat ochrony danych.</a>
	</noscript>
	<!-- comSeo-Ajax-Checkout-Bugfix: show also div, when buyer doesnt use JS -->
	<div>
		<a id="srNotice" href="javascript:void(0)" onclick="showSrConditions();">Przeczyta�em uwagi na temat ochrony danych.</a>
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
		srOverlay = new sofortOverlay(jQuery("#srExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/rbs/shopinfo/pl");
	</script>
');

define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_TEXT_TITLE_ADMIN', 'Rechnung by SOFORT <br /><img src="https://images.sofort.com/pl/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_TEXT_TITLE', 'Kauf auf Rechnung <br /><img src="https://images.sofort.com/pl/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_TITLE', 'Kauf auf Rechnung');
define('MODULE_PAYMENT_SOFORT_SR_LOGO_HTML', '<img src="https://images.sofort.com/pl/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_ERROR_MESSAGE', 'Wybrana metoda p�atnicza nie jest niestety mo�liwa lub zosta�a przerwana na �yczenie klienta. Prosimy o wybranie innej metody p�atniczej.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_SR', 'Wybrana metoda p�atnicza nie jest niestety mo�liwa lub zosta�a przerwana na �yczenie klienta. Prosimy o wybranie innej metody p�atniczej.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_SR_CHECKOUT_TEXT', '');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_CONFIRM_SR', 'Potwierd� faktur�:');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_TITLE', 'Kolejno�� wy�wietlania');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_DESC', 'Kolejno�� wy�wietlania. Najni�sze cyfry zostaj� wy�wietlone jako pierwsze.');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_TITLE', 'Aktywacja modu�u sofort.de');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_DESC', 'Aktywacja/deaktywacja ca�ego modu�u');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_DESCRIPTION', 'Kauf auf Rechnung z gwarancj� p�atno�ci');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_TITLE', 'Dozwolone strefy');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_DESC', 'Prosimy o podanie <b>pojedynczo</b> stref, kt�re b�d� dozwolone do u�ytkowania przez ten modu�. (np. AT, DE (pusto pole oznacza uruchomienie wszystkich stref))');
define('MODULE_PAYMENT_SOFORT_SR_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_SR_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_TITLE', 'Niepotwierdzony status zam�wienia');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_DESC', 'Status zam�wienia po dokonanej p�atno�ci. Faktura nie zosta�a jeszcze udost�pniona przez sprzedawc�.'); // (pending-confirm_invoice)
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_TITLE', 'Status zam�wienia przy pe�nym anulowaniu');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_DESC', 'Anulowany status zam�wienia<br />Status zam�wienia po pe�nym anulowaniu faktury.');  //(loss-canceled, loss-confirmation_period_expired)
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Potwierdzony status zam�wienia');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Status zam�wienia po pomy�lnej i potwierdzonej transakcji i autoryzacji faktury przez sprzedawc�.'); //(pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_TITLE', 'Anulowanie po potwierdzeniu (zaksi�gowanie na dobro rachunku)');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_DESC', 'Status zam�wie�, kt�re po potwierdzeniu zosta�y zupe�nie anulowane (zaksi�gowanie na dobro rachunku).'); // (refunded_refunded)
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT', 'Kauf auf Rechnung wybrany jako metoda p�atnicza. Transakcja nie jest zako�czona.');
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT_SELLER', 'Przekierowanie do SOFORT - p�atno�� nie mia�a jeszcze miejsca.');

define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TITLE', '"Zalecane sposoby zap�aty"');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_DESC', '"Zaznacz t� metod� p�atno�ci jako "polecana metoda p�atno�ci". Na stronie p�atno�ci ma miejsce wskazanie bezpo�rednio za metod� p�atno�ci."');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TEXT', '("Zalecane sposoby zap�aty")');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED_HISTORY', 'Polecenie potwierdzenia rachunku zosta�o przes�ane do SOFORT. Czekamy na potwierdzenie przez SOFORT.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CANCELED_HISTORY', 'Polecenie anulowania rachunku zosta�o przes�ane do SOFORT. Czekamy na potwierdzenie przez SOFORT.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_REFUNDED_HISTORY', 'Polecenie zapisania na dobro rachunku zosta�o przes�ane do SOFORT. Czekamy na potwierdzenie przez SOFORT.');

/////////////////////////////////////////////////
//////// Seller-Backend and callback.php ////////
/////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_SR_CONFIRM_INVOICE', 'Zatwierdzi� faktur�');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE', 'Anulowa� faktur�');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE', 'Zapisa� faktur� na dobro rachunku');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE_QUESTION', 'Czy rzeczywi�cie chc� Pa�stwo anulowa� faktur�?  Proces ten nie mo�e by� cofni�ty.');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE_QUESTION', 'Jeste� pewien, �e rzeczywi�cie chcesz zapisa� faktur� na dobro rachunku? Tej operacji nie da si� wycofa�.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED_REFUNDED', 'Faktura zosta�a cofni�ta. Zapis na koncie zosta� przeprowadzony.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED', 'Rachunek zosta� anulowany.');

define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE', 'Pobra� faktur�');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_HINT', 'Pobierz tu odpowiedni dokument (podgl�d faktury, faktur�, zapis na koncie).');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_CREDIT_MEMO', 'Pobra� zapis na koncie');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_PREVIEW', 'Pobierz podgl�d faktury');

define('MODULE_PAYMENT_SOFORT_SR_EDIT_CART', 'Dopasowa� koszyk');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART', 'Zapisa� koszyk');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_QUESTION', 'Czy rzeczywi�cie chcesz dopasowa� koszyk?');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_HINT', 'Zapisz tutaj Twoje zmiany koszyka. W przypadku potwierdzonej faktury artyku� o mniejszej ilo�ci lub artyku� anulowany prowadzi do zapisania na dobro rachunku.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_HINT', 'Mo�esz dostosowa� zni�ki i dop�aty. Dop�aty nie mog� by� zwi�kszone a zni�ki nie mog� mie� warto�ci wi�kszej od zera. Na skutek dostosowania ��czna suma faktury nie mo�e zosta� podwy�szona.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_GTZERO_HINT', 'Zni�ki nie mog� otrzyma� sum wi�kszych od zera.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY', 'Dopasowa� ilo��');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_HINT', 'Mo�esz dopasowa� liczb� artyku��w do ka�dej pozycji. Ilo�� jednak�e mo�na zmniejszy�, ale nie da si� jej zwi�kszy�.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_TOTAL_GTZERO', 'Ilo�� artyku�u nie mo�e by� zmniejszona, gdy� ��czna kwota faktury nie mo�e by� ujemna.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_ZERO_HINT', 'Ilo�� musi by� wi�ksza od 0. Aby usun�� prosz� zaznaczy� artyku� na ko�cu linijki.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE', 'Dopasowa� cen�');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_HINT', 'Mo�esz dopasowa� cen� do poszczeg�lnach artyku��w. Ceny jednak�e mog� zosta� obni�one, ale nie da si� ich podwy�szy�.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_TOTAL_GTZERO', 'Cena nie mo�e by� obni�ona, gdy� ��czna kwota faktury nie mo�e by� ujemna.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_HINT', 'Nie mo�e zosta� r�wnocze�nie dopasowana cena i ilo��.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_NAN', 'Wpisa�e� nieprawid�owe znaki. W przypadku tych dostosowa� s� dopuszczalne tylko liczby.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_VALUE_LTZERO_HINT', 'Warto�� nie mo�e by� mniejsza ni� 0.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE', 'Prosz� wpisa� komentarz');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE_HINT', 'Dopasowuj�c ju� zatwierdzon� faktur� nale�y do��czy� odpowiednie uzasadnienie. Pojawi si� ono p�niej przy zapisie na koncie jako komentarz do danego artyku�u.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_HINT', 'Mo�esz dopasowa� cen� koszt�w wysy�ki. Cena mo�e zosta� jedynie obni�ona, ale nie podwy�szona.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_TOTAL_GTZERO', 'Koszty wysy�ki nie mog� zosta� obni�one, gdy� suma faktury nie mo�e by� negatywna.');
define('MODULE_PAYMENT_SOFORT_SR_RECALCULATION', 'jest na nowo naliczany');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_TOTAL_GTZERO','Ten artyku� nie mo�e zosta� usuni�ty, gdy� ��czna kwota faktury nie mo�e by� ujemna.');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_ARTICLE_FROM_INVOICE', 'Usun�� artyku�');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE', 'Usu� pozycj�');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_QUESTION', 'Czy naprawd� chcesz anulowa� nast�puj�ce artyku�y: %s ?');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_HINT', 'Prosz� zaznaczy� arktyku�y do wykasowania. W przypadku potwierdzonej faktury wykasowanie artyku�u prowadzi do zapisania na dobro rachunku.');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_LAST_ARTICLE_HINT', 'Na skutek zmniejszenia ilo�ci wszystkich artyku��w lub usuni�cie ostatniego artyku�u faktura zostanie ca�kowicie anulowana.');
define('MODULE_PAYMENT_SOFORT_SR_SYNC_FAILED_SELLER', 'To zam�wienie zawiera artyku�y, kt�re mog� stwarza� problemy podczas synchronizacji z serwerami SOFORT. Pami�taj, aby w przypadku p�niejszych zmian danych dotycz�cych wysy�ki, rabatu lub samego artyku�u por�wna� dane podane na rachunku w formacie PDF z danymi ze sklepu w celu unikni�cia b��dnej wysy�ki. Niewykluczone, �e zmiana zawarto�ci koszyka b�dzie mo�liwa tylko w panelu sprzedawcy SOFORT.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_GX_CUSTOMIZER_AFFECTED', 'Z regu�y chodzi tu wy��cznie o artyku�y, kt�re wykorzystuj� funkcje Customizer GX.');

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_BUYER', 'Zam�wienie zosta�o skutecznie przes�ane. Potwierdzenie nie mia�o jeszcze miejsca.');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_SELLER', 'Zam�wienie zosta�o zako�czone - Faktura mo�e zosta� potwierdzone - Tw�j numer transakcji:');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_BUYER', 'Zam�wienie anulowane.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_BUYER', 'Zam�wienie potwierdzone i w trakcie opracowywania.');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_SELLER', 'Faktura zosta�a potwierdzona i sporz�dzona.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_BUYER', 'Faktura zosta�a zapisana na dobro rachunku.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_SELLER', 'Faktura zosta�a zapisana na dobro rachunku. Kwota zosta�a zaksi�gowana.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_REANIMATED', 'Anulacja faktury zosta�a uniewa�niona.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_BUYER', 'Zam�wienie anulowane.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_SELLER', 'Zam�wienie zosta�o anulowane. Min�� czas potwierdzenia.');

define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CURRENT_TOTAL', 'Aktualna kwota faktury:');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED', 'Rachunek zosta� potwierdzony.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_TRANSACTION_ID', 'ID transakcji');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CANCELED_REFUNDED', 'Faktura zosta�a cofni�ta. Zapis na koncie zosta� przeprowadzony. {{time}}');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_EDITED', 'Koszyk zosta� dopasowany.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_RESET', 'Koszyk zosta� przywr�cony do stanu wyj�ciowego.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9000', 'Nie znaleziono faktury- transakcji.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9001', 'Faktura nie mog�a zosta� zatwierdzona.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9002', 'Podana kwota rachunku przekracza limit kredytowy.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9003', 'Faktura nie mog�a zosta� anulowana.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9004', 'Zapytanie zawiera�o nieprawid�owe pozycje w koszyku.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9005', 'Koszyk nie m�g� zosta� dopasowany.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9006', 'Dost�p do interfejsu traci wa�no�� po 30 dniach od wp�yni�cia p�atno�ci.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9007', 'Faktura ju� zosta�a anulowana.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9008', 'Suma przekazanego podatku VAT jest zbyt wysoka.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9009', 'Kwoty stawek podatku VAT przekazanych dla artyku��w s� ze sob� sprzeczne.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9010', 'Dostosowanie koszyka nie jest mo�liwe.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9011', 'Nie przekazano komentarza dotycz�cego dopasowania zawarto�ci koszyka.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9012', 'Nie mo�na doda� pozycji do koszyka. Nie jest r�wnie� mo�liwe podwy�szenie ilo�ci dla danej pozycji rachunku. Kwoty pojedynczych pozycji nie mog� przekroczy� kwoty pierwotnej.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9013', 'W koszyku znajduj� si� wy��cznie artyku�y niefakturowane.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9014', 'Podany numer faktury ju� znajduje si� w u�yciu.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9015', 'Podany numer dotycz�cy zapisania na dobro konta jest ju� w u�yciu.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9016', 'Podany numer zam�wienia jest ju� w u�yciu.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9017', 'Faktura ju� zosta�a zatwierdzona.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9018', 'Nie zosta�y dostosowane �adne dane faktury.');