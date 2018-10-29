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
 * $Id: sofort_lastschrift.php 6097 2013-04-22 12:00:13Z rotsch $
 */

//include language-constants used in all Multipay Projects
require_once 'sofort_general.php';

define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_CONDITIONS_WITH_LIGHTBOX', '<a href="https://documents.sofort.com/de/ls/privacy_de" target="_blank">Przeczyta³em uwagi na temat ochrony danych.</a>');
define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_CONDITIONS', '
	<script type="text/javascript">
		function showLsConditions() {
			lsOverlay = new sofortOverlay(jQuery(".lsOverlay"), "callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/de/ls/privacy_de");
			lsOverlay.trigger();
		}
	</script>
	<noscript>
		<div>
			<a href="https://documents.sofort.com/de/ls/privacy_de" target="_blank">Przeczyta³em uwagi na temat ochrony danych.</a>
		</div>
	</noscript>
	<!-- comSeo-Ajax-Checkout-Bugfix: show also div, when buyer doesnt use JS -->
	<div>
		<a id="lsNotice" href="javascript:void(0)" onclick="showLsConditions()">Przeczyta³em uwagi na temat ochrony danych.</a>
	</div>
	<div style="display:none; z-index: 1001;filter: alpha(opacity=92);filter: progid :DXImageTransform.Microsoft.Alpha(opacity=92);-moz-opacity: .92;-khtml-opacity: 0.92;opacity: 0.92;background-color: black;position: fixed;top: 0px;left: 0px;width: 100%;height: 100%;text-align: center;vertical-align: middle;" class="lsOverlay">
		<div class="loader" style="z-index: 1002; position: relative;background-color: #fff;border: 5px solid #C0C0C0;top: 40px;overflow: scroll;padding: 4px;border-radius: 7px;-moz-border-radius: 7px;-webkit-border-radius: 7px;margin: auto;width: 620px;height: 400px;overflow: scroll; overflow-x: hidden;">
			<div class="closeButton" style="position: fixed; top: 54px; background: url(callback/sofort/ressources/images/close.png) right top no-repeat;cursor:pointer;height: 30px;width: 30px;"></div>
			<div class="content"></div>
		</div>
	</div>
');

define('MODULE_PAYMENT_SOFORT_LS_TEXT_DESCRIPTION_EXTRA',
	MODULE_PAYMENT_SOFORT_MULTIPAY_JS_LIBS.'
	<div id="lsExtraDesc">
		<div class="content" style="display:none;"></div>
	</div>
	<script type="text/javascript">
		lsOverlay = new sofortOverlay(jQuery("#lsExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/ls/shopinfo/pl");
	</script>
');

define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_TEXT_TITLE', 'Pobranie z konta (polecenie obci±¿enia konta) <br /><img src="https://images.sofort.com/pl/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_TEXT_TITLE_ADMIN', 'Lastschrift by SOFORT <br /><img src="https://images.sofort.com/pl/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_TITLE', 'Pobranie z konta (polecenie obci±¿enia konta)');
define('MODULE_PAYMENT_SOFORT_LS_LOGO_HTML', '<img src="https://images.sofort.com/pl/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ERROR_MESSAGE', 'Wybrana metoda p³atnicza nie jest niestety mo¿liwa lub zosta³a przerwana na ¿yczenie klienta. Prosimy o wybranie innej metody p³atniczej.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_LS', 'Wybrana metoda p³atnicza nie jest niestety mo¿liwa lub zosta³a przerwana na ¿yczenie klienta. Prosimy o wybranie innej metody p³atniczej.');
define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_TEXT', '');
define('MODULE_PAYMENT_SOFORT_LS_SORT_ORDER_TITLE', 'Kolejno¶æ wy¶wietlania');
define('MODULE_PAYMENT_SOFORT_LS_SORT_ORDER_DESC', 'Kolejno¶æ wy¶wietlania. Najni¿sze cyfry zostaj± wy¶wietlone jako pierwsze.');
define('MODULE_PAYMENT_SOFORT_LS_STATUS_TITLE', 'Aktywacja modu³u sofort.de');
define('MODULE_PAYMENT_SOFORT_LS_STATUS_DESC', 'Aktywacja/deaktywacja ca³ego modu³u');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_DESCRIPTION', 'Modu³ p³atniczy Lastschrift by SOFORT');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ERROR_HEADING', 'Wyst±pi³ b³±d podczas zamówienia.');

define('MODULE_PAYMENT_SOFORT_LS_TEXT_HOLDER', 'W³a¶ciciel konta: ');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ACCOUNT_NUMBER', 'Numer konta: ');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_BANK_CODE', 'Numer rozliczeniowy banku: ');

define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_ALLOWED_TITLE', 'Dozwolone strefy');
define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_ALLOWED_DESC', 'Prosimy o podanie <b>pojedynczo</b> stref, które bêd± dozwolone do u¿ytkowania przez ten modu³. (np. AT, DE (pusto pole oznacza uruchomienie wszystkich stref))');
define('MODULE_PAYMENT_SOFORT_LS_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_LS_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Potwierdzony status zamówienia');
define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Potwierdzony status zamówienia<br />Status zamówienia po zakoñczonej transkacji.'); //(pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_STATUS_ID_TITLE', 'Obci±¿enie zwrotne');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_STATUS_ID_DESC', 'Status dla zamówieñ w przypadku przelewu zwrotnego.'); // (loss-rejected)
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_STATUS_ID_TITLE', 'Wp³yw pieniêdzy');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_STATUS_ID_DESC', 'Status dla zamówieñ, gdy dosz³y pieni±dze na konto SOFORT Bank.'); // (received-credited)
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_STATUS_ID_TITLE', 'Czê¶ciowy zwrot');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_STATUS_ID_DESC', 'Status dla zamówieñ, w przypadku których kupuj±cemu zosta³a zwrócona czê¶æ sumy.'); // (refunded-compensation)
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_STATUS_ID_TITLE', 'Pe³ny zwrot');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_STATUS_ID_DESC', 'Status dla zamówieñ, w przypadku których ca³a suma zosta³a zwrócona kupuj±cemu.'); // (refunded-refunded)

define('MODULE_PAYMENT_SOFORT_LS_LOGO', 'logo_155x50.png');
define('MODULE_PAYMENT_SOFORT_LS_BANNER', 'banner_300x100.png');

define('MODULE_PAYMENT_SOFORT_LS_TMP_COMMENT', 'Lastschrift by SOFORT jako metoda p³atnicza wybrane. Transakcja nie jest zakoñczona.');
define('MODULE_PAYMENT_SOFORT_LS_TMP_COMMENT_SELLER', 'Przekierowanie do SOFORT - p³atno¶æ nie mia³a jeszcze miejsca.');

define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_TITLE', '"Zalecane sposoby zap³aty"');
define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_DESC', '"Zaznacz t± metodê p³atno¶ci jako "polecana metoda p³atno¶ci". Na stronie p³atno¶ci ma miejsce wskazanie bezpo¶rednio za metod± p³atno¶ci."');
define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_TEXT', '("Zalecane sposoby zap³aty")');

define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_SELLER', 'Zamówienie zosta³o zakoñczone pomy¶lnie - Twój rachunek zostanie obci±¿ony. ID twojej transakcji: {{tId}}');
define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_BUYER', 'Zamówienie skuteczne.');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_SELLER', 'Wp³yniêcie p³atno¶ci na konto');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_BUYER', '');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_SELLER', '');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_BUYER', 'Odno¶nie tej transakcji nie stiwerdzono obci±¿enia zwrotnego. {{time}}');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_SELLER', 'Czê¶æ kwoty z rachunku zosta³a zwrócona. Ca³kowita zwrócona kwota: {{refunded_amount}}. {{time}}');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_BUYER', 'Czê¶æ sumy zostanie zwrócony.');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_SELLER', '');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_BUYER', 'Kwota faktury zostanie zwrócona. {{time}}');
