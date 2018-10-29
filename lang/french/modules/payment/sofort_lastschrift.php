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

define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_CONDITIONS_WITH_LIGHTBOX', '<a href="https://documents.sofort.com/de/ls/privacy_de" target="_blank">J\'ai lu la politique de confidentialité.</a>');
define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_CONDITIONS', '
	<script type="text/javascript">
		function showLsConditions() {
			lsOverlay = new sofortOverlay(jQuery(".lsOverlay"), "callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/de/ls/privacy_de");
			lsOverlay.trigger();
		}
	</script>
	<noscript>
		<div>
			<a href="https://documents.sofort.com/de/ls/privacy_de" target="_blank">J\'ai lu la politique de confidentialité.</a>
		</div>
	</noscript>
	<!-- comSeo-Ajax-Checkout-Bugfix: show also div, when buyer doesnt use JS -->
	<div>
		<a id="lsNotice" href="javascript:void(0)" onclick="showLsConditions()">J\'ai lu la politique de confidentialité.</a>
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
		lsOverlay = new sofortOverlay(jQuery("#lsExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/ls/shopinfo/fr");
	</script>
');

define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_TEXT_TITLE', 'Prélèvement bancaire (prélèvement automatique) <br /><img src="https://images.sofort.com/de/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_TEXT_TITLE_ADMIN', 'Lastschrift by SOFORT (prélèvement automatique) <br /><img src="https://images.sofort.com/de/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_TITLE', 'Prélèvement bancaire (prélèvement automatique)');
define('MODULE_PAYMENT_SOFORT_LS_LOGO_HTML', '<img src="https://images.sofort.com/de/ls/logo_90x30.png" alt="Logo Lastschrift"/>');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ERROR_MESSAGE', 'Le mode de paiement sélectionné n\'est malheureusement pas possible ou a été annulé à la demande du client. Vous êtes prié de sélectionner un autre mode de paiement.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_LS', 'Le mode de paiement sélectionné n\'est malheureusement pas possible ou a été annulé à la demande du client. Vous êtes prié de sélectionner un autre mode de paiement.');
define('MODULE_PAYMENT_SOFORT_LS_CHECKOUT_TEXT', '');
define('MODULE_PAYMENT_SOFORT_LS_SORT_ORDER_TITLE', 'Ordre d\'affichage');
define('MODULE_PAYMENT_SOFORT_LS_SORT_ORDER_DESC', 'Ordre de l\'affichage. Le chiffre plus petit est affiché en premier.');
define('MODULE_PAYMENT_SOFORT_LS_STATUS_TITLE', 'Activer module sofort.de');
define('MODULE_PAYMENT_SOFORT_LS_STATUS_DESC', 'Active/désactive le module entier');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_DESCRIPTION', 'Module de paiement pour Lastschrift by SOFORT');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ERROR_HEADING', 'Un erreur s\'est produite pendant la commande.');

define('MODULE_PAYMENT_SOFORT_LS_TEXT_HOLDER', 'Titulaire du compte: ');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_ACCOUNT_NUMBER', 'Numéro de compte: ');
define('MODULE_PAYMENT_SOFORT_LS_TEXT_BANK_CODE', 'Code de banque: ');

define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_ALLOWED_TITLE', 'Zones autorisées');
define('MODULE_PAYMENT_SOFORT_LASTSCHRIFT_ALLOWED_DESC', 'Veuillez indiquer <b>séparément</b> les zones, lesquelles seront autorisées pour ce module. (par exemple AT,DE (si vide toutes les zones seront autorisées))');
define('MODULE_PAYMENT_SOFORT_LS_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_LS_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Confirmer état de commande');
define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'État de commande confirmé<br />État de commande après transaction conclue.'); //(pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_STATUS_ID_TITLE', 'Rétrofacturation');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_STATUS_ID_DESC', 'État des commandes où il y a une rétrofacturation.'); // (loss-rejected)
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_STATUS_ID_TITLE', 'Réception de paiement');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_STATUS_ID_DESC', 'État des commandes quand l\'argent est arrivé sur le compte de la banque SOFORT.'); // (received-credited)
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_STATUS_ID_TITLE', 'Remboursement partiel');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_STATUS_ID_DESC', 'État des commandes quand un montant partiel a été remboursé à l\'acheteur.'); // (refunded-compensation)
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_STATUS_ID_TITLE', 'Remboursement intégral');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_STATUS_ID_DESC', 'État des commandes quand le montant intégral a été remboursé à l\'acheteur.'); // (refunded-refunded)

define('MODULE_PAYMENT_SOFORT_LS_LOGO', 'logo_155x50.png');
define('MODULE_PAYMENT_SOFORT_LS_BANNER', 'banner_300x100.png');

define('MODULE_PAYMENT_SOFORT_LS_TMP_COMMENT', 'Lastschrift by SOFORT sélectionné comme mode de paiement. Transaction pas conclue.');
define('MODULE_PAYMENT_SOFORT_LS_TMP_COMMENT_SELLER', 'Redirection à SOFORT - Paiement ne pas encore effectué.');

define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_TITLE', '"Mode de paiement conseillé"');
define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_DESC', '"Noter ce mode de paiement comme "mode de paiement recommandé". Sur la page du paiement une indication suit directement derrière le mode de paiement."');
define('MODULE_PAYMENT_SOFORT_LS_RECOMMENDED_PAYMENT_TEXT', '("Mode de paiement conseillé")');

define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_SELLER', 'Commande terminée avec succès - prélèvement automatique est effectuée. Votre numéro d\'identification de transaction: {{tId}}');
define('MODULE_PAYMENT_SOFORT_LS_PEN_NOT_CRE_YET_BUYER', 'Commande réussie.');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_SELLER', 'Réception du paiement sur le compte');
define('MODULE_PAYMENT_SOFORT_LS_REC_CRE_BUYER', '');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_SELLER', '');
define('MODULE_PAYMENT_SOFORT_LS_LOS_REJ_BUYER', 'Un remboursement existe pour cette transaction. {{time}}');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_SELLER', 'Une partie du montant facturé sera remboursé. Montant total remboursé: {{refunded_amount}}. {{time}}');
define('MODULE_PAYMENT_SOFORT_LS_REF_COM_BUYER', 'Une partie du montant sera remboursée.');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_SELLER', '');
define('MODULE_PAYMENT_SOFORT_LS_REF_REF_BUYER', 'Le montant de la facture sera remboursé. {{time}}');
