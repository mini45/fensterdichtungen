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
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TEXT', '("Aanbevolen betaalmethode")');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION', '<b>iDEAL</b><br />Zodra de klant deze betaalmetode en zijn bank heeft uitgekozen wordt hij door SOFORT AG naar zijn bank doorverbonden. Daar voert hij de betaling uit en wordt weer teruggeleidt naar het shopsysteem. Na een bevestiging van de betaling voert SOFORT AG een zogn. Callback op het shopsysteem uit. Hierdoor wordt de status van de bestelling dienovereenkomstig veranderd.<br />Ter beschikking gesteld door de SOFORT AG');

//all shopsystem-params
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_TITLE', 'iDEAL - sofort.de module activeren');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TITLE', '"Aanbevolen betaalmethode"');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_TITLE', 'Configuratie sleutel / API-Key testen');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_DESC', "<script>function t(){k = document.getElementsByName(\"configuration[MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY]\")[0].value;window.open(\"../callback/sofort/testAuth.php?k=\"+k);}</script><input type=\"button\" onclick=\"t()\" value=\"Test\" />");  //max 255 signs
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_TITLE' , MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_TITLE' , 'Betaalzone');
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_DESC' , 'Geef de <b>aparte</b> zones aan, voor welke dit moduul toegestaan is. (b.v. AT,DE,CH, NL (als hier niets ingevuld wordt, zijn alle zones toegestaan))');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_TITLE' , 'Tijdelijke bestelstatus');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_TITLE', 'Bevestigde bestelstatus');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_TITLE', 'Automatische stornering met terugboeking.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_TITLE', 'Gedeeltelijke terugbetaling');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_TITLE', 'volledige vergoeding');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_TITLE', 'Bestelstatus na afgebroken betaling');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_TITLE', 'Bestelstatus na volledige annulering');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_TITLE', 'Volgorde van aanwijzen');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_TITLE', 'Van SOFORT AG toegewezen configuratiesleutel');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_TITLE', 'Project-wachtwoord');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_TITLE', 'Berichten-wachtwoord');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_TITLE', 'Betalingskenmerk 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_TITLE', 'Betalingskenmerk 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_TITLE', 'Logo en tekst');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_DESC', 'De complete module activeren / deactiveren');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_DESC', 'iDEAL als aanbevolen betaalmethode aangeven.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_DESC', 'Als bepaalde landen zone uitgekozen zyn, geldt de betaalmethode alleen voor deze landen.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_DESC', 'Bestelstatus van de niet afgesloten transacties. De bestelling werd uitgevoerd maar de transactie van SOFORT AG werd nog niet bevestigd.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_DESC', 'Bevestigde bestelstatus<br />Status van de bestelling na een afgesloten transactie.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_DESC', 'Status van bestellingen bij een volledige annulering.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_DESC', 'Bestelstatus van bestellingen waarbij de betaling afgebroken werd.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_DESC', 'Status van bestellingen waarbij de betaling werd ontvangen na de time-out zoals vastgelegd in het SOFORT-project en daarom ook automatisch werd gestorneerd. Terugbetaling op de rekening van de koper werd tevens automatisch uitgevoerd.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_DESC', 'Status van bestellingen waarbij een deel van het bedrag aan de koper is vergoed.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_DESC', 'Status van bestellingen waarbij het volledige bedrag aan de koper vergoed werd.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_DESC', 'Volgorde van de mededelingen. Laagste getal wordt als eerste getoond.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_DESC', 'Van SOFORT AG toegewezen configuratiesleutel');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_DESC', 'Van SOFORT AG toegewezen projectwachtwoord');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_DESC', 'Van SOFORT AG toegewezen wachtwoord voor de meldingen.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_DESC', 'Betalingskenmerk 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_DESC', 'Betalingskenmerk 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_DESC', 'Banner of tekst bij de keuze van de betaalopties');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CHECKOUT_TEXT', 'iDEAL.nl - Online overschrijvingen voor de e-commerce handel in Nederland. Voor de betaling met iDEAL heeft u een internet bankrekening bij een van de genoemde banken nodig. U betaald direct via uw bankrekening. Indien voorradig wordt het bestelde DIRECT geleverd cq verstuurd.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'iDEAL.nl - Online overschrijvingen voor de e-commerce handel in Nederland. Voor de betaling met iDEAL heeft u een internet bankrekening bij een van de genoemde banken nodig. U betaald direct via uw bankrekening. Indien voorradig wordt het bestelde DIRECT geleverd cq verstuurd.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_COMMENT', 'iDEAL als betaalmethode gekozen. De transactie niet afgesloten.');

define('MODULE_PAYMENT_SOFORT_IDEAL_PEN_NOT_CRE_YET_BUYER', 'Bestelling met succes ingediend. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_REC_CRE_BUYER', '{{paymentMethodStr}} - Geld is ontvangen. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_LOS_NOT_CRE_YET_BUYER', 'De betaling is gestorneerd.');
define('MODULE_PAYMENT_SOFORT_IDEAL_LAT_SUC_AUT_BUYER', 'Transactie werd automatisch gestorneerd. De opdracht voor terugboeking op de rekening van de koper werd  gegeven.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_COM_BUYER', 'Een deel van het bedrag zal worden terugbetaald.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_REF_BUYER', 'Het bedrag van de rekening wordt gecrediteerd. {{time}}');

//////////////////////////////////////////////////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10000', 'Kiest u voor het verzenden een bank uit!');

define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_TEXT', 'iDEAL.nl - Online overschrijvingen voor de e-commerce handel in Nederland. Voor de betaling met iDEAL heeft u een internet bankrekening bij een van de genoemde banken nodig. U betaald direct via uw bankrekening. Indien voorradig wordt het bestelde DIRECT geleverd cq verstuurd.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_ERROR_HEADING', 'De volgende fout werd gedurende het proces gemeld:');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_ALL_CODES', 'Foutmelding bij het verzenden van de gegevens, kiest u een andere betaalmethode of neemt u contact op met de web-winkelier.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_DEFAULT', 'Foutmelding bij het verzenden van de gegevens, kiest u een andere betaalmethode of neemt u contact op met de web-winkelier.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IDEALSELECTED_PENDING' , 'iDEAL als betaalmethode gekozen. De transactie niet afgesloten.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_SELECTBOX_TITLE', 'Kies uw bank');
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
      	<p>Na de bevestiging van de bestelling wordt u naar uw bank doorverbonden. Daar kunt u de betaling uitvoeren.</p><p> Hiervoor heeft u uw bankgegevens nodig: bankrekeningnummer, PIN en TAN.  Verdere informatie vindt u onder: <a href="http://www.ideal.nl" target="_blank">iDEAL.nl</a></p>
      </td>
    </tr>
  </table>');