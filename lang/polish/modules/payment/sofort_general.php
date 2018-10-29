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
define('MODULE_PAYMENT_SOFORT_MULTIPAY_AUTH_DESC', '<noscript>Prosimy aktywowa� Javascript!</noscript>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/jquery.min_1.8.3.js"></script>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/testAuth.js"></script>
');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE', 'Strefa p�atno�ci');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC', 'Kiedy strefa zostanie wybrana, metoda p�atnicza dotyczy tej strefy.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_1_TITLE', 'Tytu� przelewu 1');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_1_DESC', 'W 1 tytule przelewu mo�na wybra� nast�puj�ce opcje.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_2_TITLE', 'Tytu� przelewu 2');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_2_DESC', 'W tytule przelewu (maksymalnie 27 znak�w) zast�pione zostan� nast�puj�ce znaki zast�pcze:<br />{{order_date}}<br />{{customer_id}}<br />{{customer_name}}<br />{{customer_company}}<br />{{customer_email}}');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEXT_ERROR_HEADING', 'Nast�puj�cy b��d wyst�pi� podczas procesu:');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEXT_ERROR_MESSAGE', 'Wybrana metoda p�atnicza nie jest niestety mo�liwa lub zosta�a przerwana na �yczenie klienta. Prosimy o wybranie innej metody p�atniczej.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_IMAGE_TITLE', 'Baner lub tekst przy wyborze opcji p�atniczej');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_IMAGE_DESC', 'Baner lub tekst przy wyborze opcji p�atniczej');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_PROF_SETTINGS_TITLE', '<span style="font-weight:bold; text-decoration:underline; font-size:1.4em;"><br />Ustawienia profesjonalne</span> ');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_PROF_SETTINGS_DESC', 'Nast�puj�ce ustawienia z regu�y nie wymagaj� dopasowania i powinny zawiera� ju� prawid�owe warto�ci.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_LOG_ENABLED_TITLE', 'Uaktywnij logging');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_LOG_ENABLED_DESC', 'Prosz� uaktywni� logging, aby b��dy, ostrze�enia, jak r�wnie� zapytania i odpowiedzi mog�y by� zapisywane na serwerach SOFORT. Z przyczyn zwi�zanych z ochron� danych logging powinien by� w��czony jedynie  w celu wyszukiwania b��d�w. Dalsze informacje znajdziesz w instrukcji obs�ugi.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEMP_STATUS_ID_TITLE', 'Tymczasowy status zam�wienia');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEMP_STATUS_ID_DESC', 'Status zam�wienia dla niezako�czonych transakcji. Zam�wienie zosta�o z�o�one ale transakcja nie zosta�a jeszcze potwierdzona przez SOFORT AG.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ABORTED_STATUS_ID_TITLE', 'Status zam�wienia w przypadku przerwanej p�atno�ci.'); //Bestellstatus bei abgebrochener/erfolgloser Zahlung
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ABORTED_STATUS_ID_DESC', 'Status zam�wienia w przypadku zam�wie�, kt�re zosta�y przerwane podczas procesu p�atno�ci.'); //Bestellstatus bei Bestellungen, die whrend des Bestellvorgangs oder im Wizard abgebrochen wurden.
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ORDER_CANCELED', 'Die Bestellung wurde abgebrochen.'); //Die Bestellung wurde abgebrochen.

define('MODULE_PAYMENT_SOFORT_MULTIPAY_TRANSACTION_ID', 'ID transakcji');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_UPDATE_NOTICE', 'Modu� zosta� zaktualizowany. W celu prawid�owego funkcjonowania, wszystkie(!) istniej�ce metody p�atnicze SOFORT musz� zosta� odinstalowane i (w razie potrzeby) zainstalowane na nowo. Do tego czasu metody p�atnicze nie b�d� proponowane klientowi. Przed odinstalowaniem koniecznie zanotuj ustawienia modu�u!');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_VERSIONNUMBER', 'Versionsnummer');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_FORWARDING', 'Twoje zapytanie jest opracowywane, prosimy o chwil� cierpliwo�ci i prosimy nie przerywa� procesu. Proces ten mo�e potrwa� oko�o 30 sekund.');

define('MODULE_PAYMENT_SOFORT_KEYTEST_SUCCESS', 'Weryfikacja klucza API zako�czona sukcesem!');
define('MODULE_PAYMENT_SOFORT_KEYTEST_SUCCESS_DESC', 'Test OK dnia');
define('MODULE_PAYMENT_SOFORT_KEYTEST_ERROR', 'Klucz API nie m�g� zosta� zweryfikowany!');
define('MODULE_PAYMENT_SOFORT_KEYTEST_ERROR_DESC', 'Uwaga: nieprawid�owy klucz API');
define('MODULE_PAYMENT_SOFORT_KEYTEST_DEFAULT', 'Klucz API nie zosta� jeszcze przetestowany');

define('MODULE_PAYMENT_SOFORT_REFRESH_INFO', 'Je�li w�a�nie potwierdzi�e�, zmieni�e�, anulowa�e� lub zapisa�e� na dobro rachunku to zam�wienie, mo�e by� konieczne {{relLink}} strony, aby wszystkie zmiany by�y widoczne.');
define('MODULE_PAYMENT_SOFORT_REFRESH_PAGE', 'Kliknij tutaj, aby na nowo wczyta� stron�');
define('MODULE_PAYMENT_SOFORT_TRANSLATE_TIME', 'Czas');

//definition of error-codes that can resolve by calling the SOFORT-API
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_0',		'Wyst�pi� nieznany b��d.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8002',		'Wyst�pi� b��d podczas walidacji.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010',		'Dane s� niepe�ne lub b��dne. Prosimy o poprawienie ich lub o kontakt ze sprzedawc�.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8011',		'Poza obszarem dost�pnych warto�ci.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8012',		'Warto�� musi by� dodatnia.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8013',		'Obecnie obs�ugujemy jedynie zam�wienia w Euro. Prosimy o poprawienie ich lub o ponowienie pr�by.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8015',		'Kwota jest zbyt wysoka lub niska. Prosimy o jej poprawienie lub o kontakt ze sprzedawc�.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8017',		'Nieznane znaki.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8018',		'Maksymalna liczba znak�w przekroczona (maks. 27).');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8019',		'Zam�wienie nie mo�e zosta� przeprowadzone z powodu nieprawid�owego adresu e-mail.Prosimy o jego poprawienie i o ponowienie pr�by.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8020',		'Zam�wienie nie mo�e zosta� przeprowadzone z powodu nieprawid�owego numeru telefonu. Prosimy o jego poprawienie i o ponowienie pr�by.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8021',		'Kod tych kraj�w nie jest wspierany. Prosimy zwr�ci si� do Pa�stwa sprzedawcy sklepowego.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8022',		'Podany BIC jest nieprawid�owy.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8023',		'Zam�wienie nie mo�e zosta� przeprowadzone z powodu nieprawid�owego kodu BIC (Bank Identifier Code). Prosimy o jego poprawienie i o ponowienie pr�by.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8024',		'Zam�wienie nie mo�e zosta� przeprowadzone z powodu nieprawid�owego kodu kraju . Adres wysy�ki/ faktury musi znajdowa� si� w Niemczech. Prosimy o jego poprawienie i o ponowienie pr�by.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8029',		'Obs�ugujemy jedynie konta niemieckie. Prosimy o poprawienie b��du lub wybranie innej metody p�atniczej.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8033',		'Kwota jest zbyt wysoka. Prosimy o poprawienie jej i o ponowienie pr�by.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8034',		'Kwota jest zbyt niska. Prosimy o poprawienie jej i o ponowienie pr�by.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8041',		'Warto�� dla podatku VAT nieprawid�owa. Warto�ci prawid�owe: 0, 7 lub 19.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8046',		'Die Validierung des Bankkontos und der Bankleitzahl ist fehlgeschlagen.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8047',		'Maksymalna liczba znak�w 255 zosta�a przekroczona.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8051',		'Zapytanie zawiera niew�a�ciwe pozycje koszyka. Prosimy o poprawienie ich lub o kontakt ze sprzedawc�.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8058',		'Prosimy o podanie przynajmniej w�a�ciciela konta i o ponowienie pr�by.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8061',		'Transakcja z podanymi przez Pa�stwa danymi ju� istnieje.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8068',		'Zakup na faktur� obecnie jest do dyspozycji jedynie dla klient�w  indywidualnych.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10001', 	'Prosimy o kompletne wype�nienie p�l numer konta, numer rozliczeniowy banku i w�a�ciciel konta.'); //LS: holder and bankdata missing
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10002',	'Prosimy o zaakceptowanie polityki prywatno�ci.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10003',	'Wybrana metoda p�atnicza nie pozwala niestety na zakup takich artyku��w jak pobieranie plik�w (downloads) lub bony prezentowe.');  //RBS and virtual content is not allowed
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10007',	'Wyst�pi� nieznany b��d.');  //Rechnung by SOFORT: check of shopamount against invoiceamount failed (more than one percent difference found)
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10008',	'Wyst�pi� b��d podczas synchronizacji z serwerami SOFORT. W celu wprowadzenia zmian w rachunku lub w koszyku wykorzystaj mo�liwo�ci, kt�re daje Ci panel sprzedawcy w SOFORT.');  //Rechnung by SOFORT: Sync of Articles failed

//check for empty fields failed (code 8010 = 'must not be empty')
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.EMAIL_CUSTOMER',				'Adres E-Mail nie mo�e by� pusty.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.PHONE_CUSTOMER',				'Numer telefonu nie mo�e pozosta� pusty.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.FIRSTNAME',	'Imi� przy adresie wysy�ki nie mo�e by� puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.FIRSTNAME',	'Miejsce na imi� w adresie wysy�ki nie mo�e zosta� puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.LASTNAME',	'Nazwisko przy adresie faktury nie mo�e by� puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.LASTNAME',	'Miejsce na nazwisko w adresie wysy�ki nie mo�e zosta� puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.STREET',		'Ulica i numer mieszkania musz� by� oddzielone.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.STREET',		'Nazwa ulicy i numer domu musz� by� oddzielone spacj�.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.STREET_NUMBER',	'Nazwa ulicy i numer domu musz� by� oddzielone spacj�.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.STREET_NUMBER',	'Nazwa ulicy i numer domu musz� by� oddzielone spacj�.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.ZIPCODE',		'Miejsce na kod pocztowy w adresie nie mo�e pozosta� puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.ZIPCODE',	'Miejsce na kod pocztowy adresu wysy�ki nie mo�e pozosta� puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.CITY',		'Miejsce na nazw� miejscowo�ci w adresie na rachunku nie mo�e zosta� puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.CITY',		'MIejsce na nazw� miejscowo�ci w adresie wysy�ki nie mo�e pozosta� puste.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.COUNTRY_CODE',	'Kod kraju adresu faktury nie mo�e by� pusty.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.COUNTRY_CODE',	'Kod kraju adresu wysy�ki towaru nie mo�e by� pusty.');