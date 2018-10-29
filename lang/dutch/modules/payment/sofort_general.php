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

define('MODULE_PAYMENT_SOFORT_MULTIPAY_APIKEY_TITLE', 'Configuratiesleutel');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_APIKEY_DESC', 'Van SOFORT AG toegewezen configuratiesleutel');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_AUTH_TITLE', 'Configuratie sleutel / API-Key testen');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_AUTH_DESC', '<noscript>Javascript activeren!</noscript>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/jquery.min_1.8.3.js"></script>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/testAuth.js"></script>
');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE', 'Betaalzone');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC', 'Als bepaalde landen zone uitgekozen zyn, geldt de betaalmethode alleen voor deze landen.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_1_TITLE', 'Betalingskenmerk 1');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_1_DESC', 'Voor betalingskenmerk 1 kunnen de volgende opties gekozen worden');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_2_TITLE', 'Betalingskenmerk 2');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_2_DESC', 'In het onderwerp (maximaal 27 tekens) worden de volgende tekenparen vervangen:<br />{{order_date}}<br />{{customer_id}}<br />{{customer_name}}<br />{{customer_company}}<br />{{customer_email}}');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEXT_ERROR_HEADING', 'De volgende fout werd gedurende het proces gemeld:');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEXT_ERROR_MESSAGE', 'Betaling via de gekozen betaalmethode is helaas niet mogelijk of werd door de klant afgebroken. Kies een andere betaalwijze.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_IMAGE_TITLE', 'Banner of tekst bij de keuze van de betaalopties');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_IMAGE_DESC', 'Banner of tekst bij de keuze van de betaalopties');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_PROF_SETTINGS_TITLE', '<span style="font-weight:bold; text-decoration:underline; font-size:1.4em;"><br />Professionele instellingen</span> ');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_PROF_SETTINGS_DESC', 'De volgende instellingen behoeven doorgaans geen aanpassingen en zijn meestal al van de juiste waarden voorzien.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_LOG_ENABLED_TITLE', 'Activeer logboek');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_LOG_ENABLED_DESC', 'Activeer het logboek om fouten, waarschuwingen, aanvragen en antwoorden van SOFORT servers te registreren. Ter bescherming van persoonsgegevens moet het logboek alleen ingeschakeld worden voor het zoeken naar fouten. Meer informatie vindt u in de handleiding.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEMP_STATUS_ID_TITLE', 'Tijdelijke bestelstatus');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEMP_STATUS_ID_DESC', 'Bestelstatus van de niet afgesloten transacties. De bestelling werd uitgevoerd maar de transactie van SOFORT AG werd nog niet bevestigd.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ABORTED_STATUS_ID_TITLE', 'Bestelstatus na afgebroken betaling'); //Bestellstatus bei abgebrochener/erfolgloser Zahlung
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ABORTED_STATUS_ID_DESC', 'Bestelstatus van bestellingen waarbij de betaling afgebroken werd.'); //Bestellstatus bei Bestellungen, die whrend des Bestellvorgangs oder im Wizard abgebrochen wurden.
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ORDER_CANCELED', 'De bestelling werd afgebroken.'); //Die Bestellung wurde abgebrochen.

define('MODULE_PAYMENT_SOFORT_MULTIPAY_TRANSACTION_ID', 'Transactie-ID');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_UPDATE_NOTICE', 'De module is geactualiseerd. Voor een correctie functionering moeten alle(!) nog bestaande  SOFORT wijze van betalingen worden verwijderd en (indien nodig) opnieuw geïnstalleerd worden. Tot die tijd kan de koper geen keuze maken voor de wijze van betaling. Noteer voor het verwijderen, de instellingen van de module!');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_VERSIONNUMBER', 'Leveringsnummer');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_FORWARDING', 'Voor de betaling wordt u binnen enige seconden door SOFORT AG doorverbonden <br />. Dit kan tot 30 seconden duren.');

define('MODULE_PAYMENT_SOFORT_KEYTEST_SUCCESS', 'API-sleutel met succes  gevalideerd!');
define('MODULE_PAYMENT_SOFORT_KEYTEST_SUCCESS_DESC', 'Test OK op');
define('MODULE_PAYMENT_SOFORT_KEYTEST_ERROR', 'API-sleutel kon niet gevalideerd worden!');
define('MODULE_PAYMENT_SOFORT_KEYTEST_ERROR_DESC', 'Let op: foutieve API-sleutel');
define('MODULE_PAYMENT_SOFORT_KEYTEST_DEFAULT', 'API-sleutel nog niet getest');

define('MODULE_PAYMENT_SOFORT_REFRESH_INFO', 'Als u deze bestelling zojuist heeft bevestigd, aangepast, gestorneerd of gecrediteerd dan dient u deze  pagina te hernieuwen {{refresh}} zodat alle wijzigingen zichtbaar worden.');
define('MODULE_PAYMENT_SOFORT_REFRESH_PAGE', 'Klik hier om de pagina opnieuw te laden');
define('MODULE_PAYMENT_SOFORT_TRANSLATE_TIME', 'Tijdstip');

//definition of error-codes that can resolve by calling the SOFORT-API
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_0',		'Er is een onbekende fout opgetreden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8002',		'Er is een fout bij de validering opgetreden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010',		'De gegevens zijn onvolledig of foutief. Corrigeert u deze of neemt u contact op met de web-winkelier.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8011',		'Niet in het bereik van geldige waarden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8012',		'Waarde moet positief zijn.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8013',		'Het is momenteel alleen mogelijk met euro\'s te betalen. Corrigeert u dit en probeert u het opnieuw.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8015',		'Het totale bedrag is te groot of te klein. Corrigeert u deze of neemt u contact op met de web winkelier.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8017',		'Onbekende tekens.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8018',		'Het maximale aantal tekens is overschreden (max. 27).');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8019',		'De bestelling kan niet uitgevoerd worden vanwege een foutief e-mail adres. Corrigeert u deze en probeert u het opnieuw.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8020',		'Vanwege een foutief telefoonnummer kan de bestelling niet uitgevoerd worden. Corrigeert u deze en probeert u het opnieuw.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8021',		'Betaling in het door u aangegeven land wordt is niet mogelijk. Neemt  u contact op met de web-winkelier.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8022',		'De aangegeven BIC is ongeldig.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8023',		'Vanwege een ongeldig BIC (Bank Identifier Code) kan de bestelling niet uitgevoerd worden. Corrigeert u deze en probeert u het opnieuw.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8024',		'Vanwege een ongeldig verzendland kan de bestelling niet uitgevoerd worden. Het factuur- en verzendadres moeten in Duitsland liggen. Corrigeert u deze en probeert u het opnieuw.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8029',		'Betaling is alleen mogelijk met een Duitse bankrekening. Corrigeer deze indien mogelijk of kiest u voor een andere betaalmethode.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8033',		'Het totale bedrag is te hoog. Corrigeert u deze en probeert u het opnieuw.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8034',		'Het totale bedrag is te laag. Corrigeert u deze en probeert u het opnieuw.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8041',		'Foutieve waarde voor de BTW. Geldige waarde: 0,7 of 19.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8046',		'De validering van het bankrekeningnummer is mislukt.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8047',		'Het maximale aantal van 255 tekens is overschreden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8051',		'De aanvraag bevat ongeldige winkelwagen posities. Corrigeert u deze of neemt u contact op met de web-winkelier.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8058',		'Geeft u tenminste een rekeninghouder aan en probeert u het opnieuw.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8061',		'Een transactie met deze gegevens bestaat al.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8068',		'Het kopen op rekening is alleen beschikbaar voor particuliere klanten.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10001', 	'Vult u de volgende velden volledig in: bankrekeningnummer en rekeninghouder.'); //LS: holder and bankdata missing
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10002',	'De privacy regels moeten geaccepteerd worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10003',	'Met de gekozen wijze van betaling, kunnen producten zoals downloads of cadeaubonnen helaas niet betaald worden.');  //RBS and virtual content is not allowed
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10007',	'Er is een onbekende fout opgetreden.');  //Rechnung by SOFORT: check of shopamount against invoiceamount failed (more than one percent difference found)
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10008',	'Er is een fout opgetreden gedurende het synchroniseren met de SOFORT server. Gebruik de mogelijkheden die aangegeven zijn in het klanten menu van SOFORT om de factuur of de winkelwagen te bewerken.');  //Rechnung by SOFORT: Sync of Articles failed

//check for empty fields failed (code 8010 = 'must not be empty')
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.EMAIL_CUSTOMER',				'Er dient een e-mailadres aangegeven te worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.PHONE_CUSTOMER',				'Er dient een telefoonnummer aangegeven te worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.FIRSTNAME',	'Er dient een voornaam van de factuurontvanger aangegeven te worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.FIRSTNAME',	'Er dient een voornaam van de ontvanger aangegeven te worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.LASTNAME',	'Er dient een achternaam van de factuurontvanger aangegeven te worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.LASTNAME',	'Er dient een achternaam van de ontvanger aangegeven te worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.STREET',		'Tussen straat en huisnummer moet een spatie staan.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.STREET',		'Tussen de straatnaam en het huisnummer moet een spatie staan.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.STREET_NUMBER',	'Tussen de straatnaam en het huisnummer moet een spatie staan.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.STREET_NUMBER',	'Tussen de straatnaam en het huisnummer moet een spatie staan.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.ZIPCODE',		'Er dient een postcode van het factuuradres aangegeven te worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.ZIPCODE',	'Er dient een postcode van het verzendadres aangegeven te worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.CITY',		'Er dient een plaatsnaam bij het verzendadres aangegeven te worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.CITY',		'Er dient een plaats bij het verzendadres aangegeven te worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.COUNTRY_CODE',	'Er dient een land bij het faktuuradres aangegeven te worden.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.COUNTRY_CODE',	'Er dient een land bij het verzendadres aangegeven te worden.');