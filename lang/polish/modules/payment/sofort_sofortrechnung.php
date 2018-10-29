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

define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS_WITH_LIGHTBOX', '<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">Przeczyta³em uwagi na temat ochrony danych.</a>');
define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS', '
	<script type="text/javascript">
		function showSrConditions() {
			srOverlay = new sofortOverlay(jQuery(".srOverlay"), "callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/de/sr/privacy_de");
			srOverlay.trigger();
		}
	</script>
	<noscript>
		<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">Przeczyta³em uwagi na temat ochrony danych.</a>
	</noscript>
	<!-- comSeo-Ajax-Checkout-Bugfix: show also div, when buyer doesnt use JS -->
	<div>
		<a id="srNotice" href="javascript:void(0)" onclick="showSrConditions();">Przeczyta³em uwagi na temat ochrony danych.</a>
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
define('MODULE_PAYMENT_SOFORT_SR_TEXT_ERROR_MESSAGE', 'Wybrana metoda p³atnicza nie jest niestety mo¿liwa lub zosta³a przerwana na ¿yczenie klienta. Prosimy o wybranie innej metody p³atniczej.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_SR', 'Wybrana metoda p³atnicza nie jest niestety mo¿liwa lub zosta³a przerwana na ¿yczenie klienta. Prosimy o wybranie innej metody p³atniczej.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_SR_CHECKOUT_TEXT', '');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_CONFIRM_SR', 'Potwierd¼ fakturê:');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_TITLE', 'Kolejno¶æ wy¶wietlania');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_DESC', 'Kolejno¶æ wy¶wietlania. Najni¿sze cyfry zostaj± wy¶wietlone jako pierwsze.');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_TITLE', 'Aktywacja modu³u sofort.de');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_DESC', 'Aktywacja/deaktywacja ca³ego modu³u');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_DESCRIPTION', 'Kauf auf Rechnung z gwarancj± p³atno¶ci');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_TITLE', 'Dozwolone strefy');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_DESC', 'Prosimy o podanie <b>pojedynczo</b> stref, które bêd± dozwolone do u¿ytkowania przez ten modu³. (np. AT, DE (pusto pole oznacza uruchomienie wszystkich stref))');
define('MODULE_PAYMENT_SOFORT_SR_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_SR_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_TITLE', 'Niepotwierdzony status zamówienia');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_DESC', 'Status zamówienia po dokonanej p³atno¶ci. Faktura nie zosta³a jeszcze udostêpniona przez sprzedawcê.'); // (pending-confirm_invoice)
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_TITLE', 'Status zamówienia przy pe³nym anulowaniu');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_DESC', 'Anulowany status zamówienia<br />Status zamówienia po pe³nym anulowaniu faktury.');  //(loss-canceled, loss-confirmation_period_expired)
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Potwierdzony status zamówienia');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Status zamówienia po pomy¶lnej i potwierdzonej transakcji i autoryzacji faktury przez sprzedawcê.'); //(pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_TITLE', 'Anulowanie po potwierdzeniu (zaksiêgowanie na dobro rachunku)');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_DESC', 'Status zamówieñ, które po potwierdzeniu zosta³y zupe³nie anulowane (zaksiêgowanie na dobro rachunku).'); // (refunded_refunded)
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT', 'Kauf auf Rechnung wybrany jako metoda p³atnicza. Transakcja nie jest zakoñczona.');
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT_SELLER', 'Przekierowanie do SOFORT - p³atno¶æ nie mia³a jeszcze miejsca.');

define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TITLE', '"Zalecane sposoby zap³aty"');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_DESC', '"Zaznacz t± metodê p³atno¶ci jako "polecana metoda p³atno¶ci". Na stronie p³atno¶ci ma miejsce wskazanie bezpo¶rednio za metod± p³atno¶ci."');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TEXT', '("Zalecane sposoby zap³aty")');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED_HISTORY', 'Polecenie potwierdzenia rachunku zosta³o przes³ane do SOFORT. Czekamy na potwierdzenie przez SOFORT.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CANCELED_HISTORY', 'Polecenie anulowania rachunku zosta³o przes³ane do SOFORT. Czekamy na potwierdzenie przez SOFORT.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_REFUNDED_HISTORY', 'Polecenie zapisania na dobro rachunku zosta³o przes³ane do SOFORT. Czekamy na potwierdzenie przez SOFORT.');

/////////////////////////////////////////////////
//////// Seller-Backend and callback.php ////////
/////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_SR_CONFIRM_INVOICE', 'Zatwierdziæ fakturê');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE', 'Anulowaæ fakturê');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE', 'Zapisaæ fakturê na dobro rachunku');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE_QUESTION', 'Czy rzeczywi¶cie chc± Pañstwo anulowaæ fakturê?  Proces ten nie mo¿e byæ cofniêty.');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE_QUESTION', 'Jeste¶ pewien, ¿e rzeczywi¶cie chcesz zapisaæ fakturê na dobro rachunku? Tej operacji nie da siê wycofaæ.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED_REFUNDED', 'Faktura zosta³a cofniêta. Zapis na koncie zosta³ przeprowadzony.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED', 'Rachunek zosta³ anulowany.');

define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE', 'Pobraæ fakturê');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_HINT', 'Pobierz tu odpowiedni dokument (podgl±d faktury, fakturê, zapis na koncie).');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_CREDIT_MEMO', 'Pobraæ zapis na koncie');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_PREVIEW', 'Pobierz podgl±d faktury');

define('MODULE_PAYMENT_SOFORT_SR_EDIT_CART', 'Dopasowaæ koszyk');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART', 'Zapisaæ koszyk');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_QUESTION', 'Czy rzeczywi¶cie chcesz dopasowaæ koszyk?');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_HINT', 'Zapisz tutaj Twoje zmiany koszyka. W przypadku potwierdzonej faktury artyku³ o mniejszej ilo¶ci lub artyku³ anulowany prowadzi do zapisania na dobro rachunku.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_HINT', 'Mo¿esz dostosowaæ zni¿ki i dop³aty. Dop³aty nie mog± byæ zwiêkszone a zni¿ki nie mog± mieæ warto¶ci wiêkszej od zera. Na skutek dostosowania ³±czna suma faktury nie mo¿e zostaæ podwy¿szona.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_GTZERO_HINT', 'Zni¿ki nie mog± otrzymaæ sum wiêkszych od zera.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY', 'Dopasowaæ ilo¶æ');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_HINT', 'Mo¿esz dopasowaæ liczbê artyku³ów do ka¿dej pozycji. Ilo¶æ jednak¿e mo¿na zmniejszyæ, ale nie da siê jej zwiêkszyæ.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_TOTAL_GTZERO', 'Ilo¶æ artyku³u nie mo¿e byæ zmniejszona, gdy¿ ³±czna kwota faktury nie mo¿e byæ ujemna.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_ZERO_HINT', 'Ilo¶æ musi byæ wiêksza od 0. Aby usun±æ proszê zaznaczyæ artyku³ na koñcu linijki.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE', 'Dopasowaæ cenê');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_HINT', 'Mo¿esz dopasowaæ cenê do poszczególnach artyku³ów. Ceny jednak¿e mog± zostaæ obni¿one, ale nie da siê ich podwy¿szyæ.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_TOTAL_GTZERO', 'Cena nie mo¿e byæ obni¿ona, gdy¿ ³±czna kwota faktury nie mo¿e byæ ujemna.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_HINT', 'Nie mo¿e zostaæ równocze¶nie dopasowana cena i ilo¶æ.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_NAN', 'Wpisa³e¶ nieprawid³owe znaki. W przypadku tych dostosowañ s± dopuszczalne tylko liczby.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_VALUE_LTZERO_HINT', 'Warto¶æ nie mo¿e by¶ mniejsza ni¿ 0.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE', 'Proszê wpisaæ komentarz');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE_HINT', 'Dopasowuj±c ju¿ zatwierdzon± fakturê nale¿y do³±czyæ odpowiednie uzasadnienie. Pojawi siê ono pó¼niej przy zapisie na koncie jako komentarz do danego artyku³u.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_HINT', 'Mo¿esz dopasowaæ cenê kosztów wysy³ki. Cena mo¿e zostaæ jedynie obni¿ona, ale nie podwy¿szona.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_TOTAL_GTZERO', 'Koszty wysy³ki nie mog± zostaæ obni¿one, gdy¿ suma faktury nie mo¿e byæ negatywna.');
define('MODULE_PAYMENT_SOFORT_SR_RECALCULATION', 'jest na nowo naliczany');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_TOTAL_GTZERO','Ten artyku³ nie mo¿e zostaæ usuniêty, gdy¿ ³±czna kwota faktury nie mo¿e byæ ujemna.');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_ARTICLE_FROM_INVOICE', 'Usun±æ artyku³');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE', 'Usuñ pozycjê');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_QUESTION', 'Czy naprawdê chcesz anulowaæ nastêpuj±ce artyku³y: %s ?');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_HINT', 'Proszê zaznaczyæ arktyku³y do wykasowania. W przypadku potwierdzonej faktury wykasowanie artyku³u prowadzi do zapisania na dobro rachunku.');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_LAST_ARTICLE_HINT', 'Na skutek zmniejszenia ilo¶ci wszystkich artyku³ów lub usuniêcie ostatniego artyku³u faktura zostanie ca³kowicie anulowana.');
define('MODULE_PAYMENT_SOFORT_SR_SYNC_FAILED_SELLER', 'To zamówienie zawiera artyku³y, które mog± stwarzaæ problemy podczas synchronizacji z serwerami SOFORT. Pamiêtaj, aby w przypadku pó¼niejszych zmian danych dotycz±cych wysy³ki, rabatu lub samego artyku³u porównaæ dane podane na rachunku w formacie PDF z danymi ze sklepu w celu unikniêcia b³êdnej wysy³ki. Niewykluczone, ¿e zmiana zawarto¶ci koszyka bêdzie mo¿liwa tylko w panelu sprzedawcy SOFORT.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_GX_CUSTOMIZER_AFFECTED', 'Z regu³y chodzi tu wy³±cznie o artyku³y, które wykorzystuj± funkcje Customizer GX.');

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_BUYER', 'Zamówienie zosta³o skutecznie przes³ane. Potwierdzenie nie mia³o jeszcze miejsca.');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_SELLER', 'Zamówienie zosta³o zakoñczone - Faktura mo¿e zostaæ potwierdzone - Twój numer transakcji:');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_BUYER', 'Zamówienie anulowane.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_BUYER', 'Zamówienie potwierdzone i w trakcie opracowywania.');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_SELLER', 'Faktura zosta³a potwierdzona i sporz±dzona.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_BUYER', 'Faktura zosta³a zapisana na dobro rachunku.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_SELLER', 'Faktura zosta³a zapisana na dobro rachunku. Kwota zosta³a zaksiêgowana.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_REANIMATED', 'Anulacja faktury zosta³a uniewa¿niona.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_BUYER', 'Zamówienie anulowane.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_SELLER', 'Zamówienie zosta³o anulowane. Min±³ czas potwierdzenia.');

define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CURRENT_TOTAL', 'Aktualna kwota faktury:');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED', 'Rachunek zosta³ potwierdzony.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_TRANSACTION_ID', 'ID transakcji');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CANCELED_REFUNDED', 'Faktura zosta³a cofniêta. Zapis na koncie zosta³ przeprowadzony. {{time}}');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_EDITED', 'Koszyk zosta³ dopasowany.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_RESET', 'Koszyk zosta³ przywrócony do stanu wyj¶ciowego.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9000', 'Nie znaleziono faktury- transakcji.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9001', 'Faktura nie mog³a zostaæ zatwierdzona.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9002', 'Podana kwota rachunku przekracza limit kredytowy.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9003', 'Faktura nie mog³a zostaæ anulowana.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9004', 'Zapytanie zawiera³o nieprawid³owe pozycje w koszyku.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9005', 'Koszyk nie móg³ zostaæ dopasowany.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9006', 'Dostêp do interfejsu traci wa¿no¶æ po 30 dniach od wp³yniêcia p³atno¶ci.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9007', 'Faktura ju¿ zosta³a anulowana.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9008', 'Suma przekazanego podatku VAT jest zbyt wysoka.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9009', 'Kwoty stawek podatku VAT przekazanych dla artyku³ów s± ze sob± sprzeczne.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9010', 'Dostosowanie koszyka nie jest mo¿liwe.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9011', 'Nie przekazano komentarza dotycz±cego dopasowania zawarto¶ci koszyka.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9012', 'Nie mo¿na dodaæ pozycji do koszyka. Nie jest równie¿ mo¿liwe podwy¿szenie ilo¶ci dla danej pozycji rachunku. Kwoty pojedynczych pozycji nie mog± przekroczyæ kwoty pierwotnej.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9013', 'W koszyku znajduj± siê wy³±cznie artyku³y niefakturowane.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9014', 'Podany numer faktury ju¿ znajduje siê w u¿yciu.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9015', 'Podany numer dotycz±cy zapisania na dobro konta jest ju¿ w u¿yciu.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9016', 'Podany numer zamówienia jest ju¿ w u¿yciu.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9017', 'Faktura ju¿ zosta³a zatwierdzona.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9018', 'Nie zosta³y dostosowane ¿adne dane faktury.');