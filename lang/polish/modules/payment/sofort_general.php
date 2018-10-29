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

define('MODULE_PAYMENT_SOFORT_MULTIPAY_APIKEY_TITLE', 'Klucz konfiguracyjny');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_APIKEY_DESC', 'Klucz konfiguracyjny nadany przez SOFORT AG');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_AUTH_TITLE', 'Przetestuj klucz konfiguracji/API-Key');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_AUTH_DESC', '<noscript>Prosimy aktywowaæ Javascript!</noscript>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/jquery.min_1.8.3.js"></script>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/testAuth.js"></script>
');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE', 'Strefa p³atno¶ci');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC', 'Kiedy strefa zostanie wybrana, metoda p³atnicza dotyczy tej strefy.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_1_TITLE', 'Tytu³ przelewu 1');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_1_DESC', 'W 1 tytule przelewu mo¿na wybraæ nastêpuj±ce opcje.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_2_TITLE', 'Tytu³ przelewu 2');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_2_DESC', 'W tytule przelewu (maksymalnie 27 znaków) zast±pione zostan± nastêpuj±ce znaki zastêpcze:<br />{{order_date}}<br />{{customer_id}}<br />{{customer_name}}<br />{{customer_company}}<br />{{customer_email}}');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEXT_ERROR_HEADING', 'Nastêpuj±cy b³±d wyst±pi³ podczas procesu:');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEXT_ERROR_MESSAGE', 'Wybrana metoda p³atnicza nie jest niestety mo¿liwa lub zosta³a przerwana na ¿yczenie klienta. Prosimy o wybranie innej metody p³atniczej.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_IMAGE_TITLE', 'Baner lub tekst przy wyborze opcji p³atniczej');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_IMAGE_DESC', 'Baner lub tekst przy wyborze opcji p³atniczej');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_PROF_SETTINGS_TITLE', '<span style="font-weight:bold; text-decoration:underline; font-size:1.4em;"><br />Ustawienia profesjonalne</span> ');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_PROF_SETTINGS_DESC', 'Nastêpuj±ce ustawienia z regu³y nie wymagaj± dopasowania i powinny zawieraæ ju¿ prawid³owe warto¶ci.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_LOG_ENABLED_TITLE', 'Uaktywnij logging');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_LOG_ENABLED_DESC', 'Proszê uaktywniæ logging, aby b³êdy, ostrze¿enia, jak równie¿ zapytania i odpowiedzi mog³y byæ zapisywane na serwerach SOFORT. Z przyczyn zwi±zanych z ochron± danych logging powinien byæ w³±czony jedynie  w celu wyszukiwania b³êdów. Dalsze informacje znajdziesz w instrukcji obs³ugi.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEMP_STATUS_ID_TITLE', 'Tymczasowy status zamówienia');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEMP_STATUS_ID_DESC', 'Status zamówienia dla niezakoñczonych transakcji. Zamówienie zosta³o z³o¿one ale transakcja nie zosta³a jeszcze potwierdzona przez SOFORT AG.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ABORTED_STATUS_ID_TITLE', 'Status zamówienia w przypadku przerwanej p³atno¶ci.'); //Bestellstatus bei abgebrochener/erfolgloser Zahlung
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ABORTED_STATUS_ID_DESC', 'Status zamówienia w przypadku zamówieñ, które zosta³y przerwane podczas procesu p³atno¶ci.'); //Bestellstatus bei Bestellungen, die whrend des Bestellvorgangs oder im Wizard abgebrochen wurden.
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ORDER_CANCELED', 'Die Bestellung wurde abgebrochen.'); //Die Bestellung wurde abgebrochen.

define('MODULE_PAYMENT_SOFORT_MULTIPAY_TRANSACTION_ID', 'ID transakcji');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_UPDATE_NOTICE', 'Modu³ zosta³ zaktualizowany. W celu prawid³owego funkcjonowania, wszystkie(!) istniej±ce metody p³atnicze SOFORT musz± zostaæ odinstalowane i (w razie potrzeby) zainstalowane na nowo. Do tego czasu metody p³atnicze nie bêd± proponowane klientowi. Przed odinstalowaniem koniecznie zanotuj ustawienia modu³u!');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_VERSIONNUMBER', 'Versionsnummer');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_FORWARDING', 'Twoje zapytanie jest opracowywane, prosimy o chwilê cierpliwo¶ci i prosimy nie przerywaæ procesu. Proces ten mo¿e potrwaæ oko³o 30 sekund.');

define('MODULE_PAYMENT_SOFORT_KEYTEST_SUCCESS', 'Weryfikacja klucza API zakoñczona sukcesem!');
define('MODULE_PAYMENT_SOFORT_KEYTEST_SUCCESS_DESC', 'Test OK dnia');
define('MODULE_PAYMENT_SOFORT_KEYTEST_ERROR', 'Klucz API nie móg³ zostaæ zweryfikowany!');
define('MODULE_PAYMENT_SOFORT_KEYTEST_ERROR_DESC', 'Uwaga: nieprawid³owy klucz API');
define('MODULE_PAYMENT_SOFORT_KEYTEST_DEFAULT', 'Klucz API nie zosta³ jeszcze przetestowany');

define('MODULE_PAYMENT_SOFORT_REFRESH_INFO', 'Je¶li w³a¶nie potwierdzi³e¶, zmieni³e¶, anulowa³e¶ lub zapisa³e¶ na dobro rachunku to zamówienie, mo¿e byæ konieczne {{relLink}} strony, aby wszystkie zmiany by³y widoczne.');
define('MODULE_PAYMENT_SOFORT_REFRESH_PAGE', 'Kliknij tutaj, aby na nowo wczytaæ stronê');
define('MODULE_PAYMENT_SOFORT_TRANSLATE_TIME', 'Czas');

//definition of error-codes that can resolve by calling the SOFORT-API
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_0',		'Wyst±pi³ nieznany b³±d.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8002',		'Wyst±pi³ b³±d podczas walidacji.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010',		'Dane s± niepe³ne lub b³êdne. Prosimy o poprawienie ich lub o kontakt ze sprzedawc±.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8011',		'Poza obszarem dostêpnych warto¶ci.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8012',		'Warto¶æ musi byæ dodatnia.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8013',		'Obecnie obs³ugujemy jedynie zamówienia w Euro. Prosimy o poprawienie ich lub o ponowienie próby.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8015',		'Kwota jest zbyt wysoka lub niska. Prosimy o jej poprawienie lub o kontakt ze sprzedawc±.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8017',		'Nieznane znaki.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8018',		'Maksymalna liczba znaków przekroczona (maks. 27).');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8019',		'Zamówienie nie mo¿e zostaæ przeprowadzone z powodu nieprawid³owego adresu e-mail.Prosimy o jego poprawienie i o ponowienie próby.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8020',		'Zamówienie nie mo¿e zostaæ przeprowadzone z powodu nieprawid³owego numeru telefonu. Prosimy o jego poprawienie i o ponowienie próby.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8021',		'Kod tych krajów nie jest wspierany. Prosimy zwróci siê do Pañstwa sprzedawcy sklepowego.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8022',		'Podany BIC jest nieprawid³owy.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8023',		'Zamówienie nie mo¿e zostaæ przeprowadzone z powodu nieprawid³owego kodu BIC (Bank Identifier Code). Prosimy o jego poprawienie i o ponowienie próby.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8024',		'Zamówienie nie mo¿e zostaæ przeprowadzone z powodu nieprawid³owego kodu kraju . Adres wysy³ki/ faktury musi znajdowaæ siê w Niemczech. Prosimy o jego poprawienie i o ponowienie próby.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8029',		'Obs³ugujemy jedynie konta niemieckie. Prosimy o poprawienie b³êdu lub wybranie innej metody p³atniczej.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8033',		'Kwota jest zbyt wysoka. Prosimy o poprawienie jej i o ponowienie próby.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8034',		'Kwota jest zbyt niska. Prosimy o poprawienie jej i o ponowienie próby.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8041',		'Warto¶æ dla podatku VAT nieprawid³owa. Warto¶ci prawid³owe: 0, 7 lub 19.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8046',		'Die Validierung des Bankkontos und der Bankleitzahl ist fehlgeschlagen.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8047',		'Maksymalna liczba znaków 255 zosta³a przekroczona.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8051',		'Zapytanie zawiera niew³a¶ciwe pozycje koszyka. Prosimy o poprawienie ich lub o kontakt ze sprzedawc±.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8058',		'Prosimy o podanie przynajmniej w³a¶ciciela konta i o ponowienie próby.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8061',		'Transakcja z podanymi przez Pañstwa danymi ju¿ istnieje.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8068',		'Zakup na fakturê obecnie jest do dyspozycji jedynie dla klientów  indywidualnych.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10001', 	'Prosimy o kompletne wype³nienie pól numer konta, numer rozliczeniowy banku i w³a¶ciciel konta.'); //LS: holder and bankdata missing
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10002',	'Prosimy o zaakceptowanie polityki prywatno¶ci.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10003',	'Wybrana metoda p³atnicza nie pozwala niestety na zakup takich artyku³ów jak pobieranie plików (downloads) lub bony prezentowe.');  //RBS and virtual content is not allowed
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10007',	'Wyst±pi³ nieznany b³±d.');  //Rechnung by SOFORT: check of shopamount against invoiceamount failed (more than one percent difference found)
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10008',	'Wyst±pi³ b³±d podczas synchronizacji z serwerami SOFORT. W celu wprowadzenia zmian w rachunku lub w koszyku wykorzystaj mo¿liwo¶ci, które daje Ci panel sprzedawcy w SOFORT.');  //Rechnung by SOFORT: Sync of Articles failed

//check for empty fields failed (code 8010 = 'must not be empty')
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.EMAIL_CUSTOMER',				'Adres E-Mail nie mo¿e byæ pusty.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.PHONE_CUSTOMER',				'Numer telefonu nie mo¿e pozostaæ pusty.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.FIRSTNAME',	'Imiê przy adresie wysy³ki nie mo¿e byæ puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.FIRSTNAME',	'Miejsce na imiê w adresie wysy³ki nie mo¿e zostaæ puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.LASTNAME',	'Nazwisko przy adresie faktury nie mo¿e byæ puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.LASTNAME',	'Miejsce na nazwisko w adresie wysy³ki nie mo¿e zostaæ puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.STREET',		'Ulica i numer mieszkania musz± byæ oddzielone.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.STREET',		'Nazwa ulicy i numer domu musz± byæ oddzielone spacj±.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.STREET_NUMBER',	'Nazwa ulicy i numer domu musz± byæ oddzielone spacj±.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.STREET_NUMBER',	'Nazwa ulicy i numer domu musz± byæ oddzielone spacj±.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.ZIPCODE',		'Miejsce na kod pocztowy w adresie nie mo¿e pozostaæ puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.ZIPCODE',	'Miejsce na kod pocztowy adresu wysy³ki nie mo¿e pozostaæ puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.CITY',		'Miejsce na nazwê miejscowo¶ci w adresie na rachunku nie mo¿e zostaæ puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.CITY',		'MIejsce na nazwê miejscowo¶ci w adresie wysy³ki nie mo¿e pozostaæ puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.COUNTRY_CODE',	'Kod kraju adresu faktury nie mo¿e byæ pusty.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.COUNTRY_CODE',	'Kod kraju adresu wysy³ki towaru nie mo¿e byæ pusty.');