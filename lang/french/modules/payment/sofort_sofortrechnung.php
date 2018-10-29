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

define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS_WITH_LIGHTBOX', '<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">J\'ai lu la politique de confidentialité.</a>');
define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS', '
	<script type="text/javascript">
		function showSrConditions() {
			srOverlay = new sofortOverlay(jQuery(".srOverlay"), "callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/de/sr/privacy_de");
			srOverlay.trigger();
		}
	</script>
	<noscript>
		<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">J\'ai lu la politique de confidentialité.</a>
	</noscript>
	<!-- comSeo-Ajax-Checkout-Bugfix: show also div, when buyer doesnt use JS -->
	<div>
		<a id="srNotice" href="javascript:void(0)" onclick="showSrConditions();">J\'ai lu la politique de confidentialité.</a>
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
		srOverlay = new sofortOverlay(jQuery("#srExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/rbs/shopinfo/fr");
	</script>
');

define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_TEXT_TITLE_ADMIN', 'Rechnung by SOFORT <br /><img src="https://images.sofort.com/de/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_TEXT_TITLE', 'Kauf auf Rechnung <br /><img src="https://images.sofort.com/de/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_TITLE', 'Kauf auf Rechnung');
define('MODULE_PAYMENT_SOFORT_SR_LOGO_HTML', '<img src="https://images.sofort.com/de/sr/logo_90x30.png"  alt="Logo Rechnung by SOFORT"/>');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_ERROR_MESSAGE', 'Le mode de paiement sélectionné n\'est malheureusement pas possible ou a été annulé à la demande du client. Vous êtes prié de sélectionner un autre mode de paiement.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_SR', 'Le mode de paiement sélectionné n\'est malheureusement pas possible ou a été annulé à la demande du client. Vous êtes prié de sélectionner un autre mode de paiement.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_SR_CHECKOUT_TEXT', '');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_CONFIRM_SR', 'Confirmer facture ici:');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_TITLE', 'Ordre d\'affichage');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_DESC', 'Ordre de l\'affichage. Le chiffre plus petit est affiché en premier.');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_TITLE', 'Activer module sofort.de');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_DESC', 'Active/désactive le module entier');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_DESCRIPTION', 'Kauf auf Rechnung avec garantie de paiement.');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_TITLE', 'Zones autorisées');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_DESC', 'Veuillez indiquer <b>séparément</b> les zones, lesquelles seront autorisées pour ce module. (par exemple AT,DE (si vide toutes les zones seront autorisées))');
define('MODULE_PAYMENT_SOFORT_SR_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_SR_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_TITLE', 'État de commande ne pas confirmé');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_DESC', 'État de commande après paiement réussi. La facture n\'a pas encore été validée par le commerçant.'); // (pending-confirm_invoice)
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_TITLE', 'État de commande en cas d\'une annulation complète');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_DESC', 'État de commande annulé<br />État de commande après une annulation complète de la facture.');  //(loss-canceled, loss-confirmation_period_expired)
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Confirmer état de commande');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'État de commande après transaction réussite et validation de la facture par le commerçant.'); //(pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_TITLE', 'Annulation après confirmation (crédit)');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_DESC', 'État pour commandes qui ont été annulée entièrement après la confirmation (crédit).'); // (refunded_refunded)
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT', 'Kauf auf Rechnung sélectionné comme mode de paiement. Transaction pas conclue.');
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT_SELLER', 'Redirection à SOFORT - Paiement ne pas encore effectué.');

define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TITLE', '"Mode de paiement conseillé"');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_DESC', '"Noter ce mode de paiement comme "mode de paiement recommandé". Sur la page du paiement une indication suit directement derrière le mode de paiement."');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TEXT', '("Mode de paiement conseillé")');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED_HISTORY', 'Ordre afin de confirmer la facture a été envoyé à SOFORT. Confirmation de la part de SOFORT en cours.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CANCELED_HISTORY', 'Ordre pour l\'annulation de la facture a été envoyé à SOFORT. Confirmation de la part de SOFORT en cours.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_REFUNDED_HISTORY', 'Ordre pour le crédit de la facture a été envoyé à SOFORT. Confirmation de la part de SOFORT en cours.');

/////////////////////////////////////////////////
//////// Seller-Backend and callback.php ////////
/////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_SR_CONFIRM_INVOICE', 'Confirmer facture');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE', 'Annuler facture');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE', 'Créditer facture');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE_QUESTION', 'Êtes-vous sûr de vouloir effectivement annuler la facture? Cette procédure ne peut pas être révoquée.');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE_QUESTION', 'Êtes-vous sûr de vouloir créditer la facture? Cette action ne peut pas être annulée.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED_REFUNDED', 'La facture a été annulé. Crédit créé.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED', 'La facture a été annulée.');

define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE', 'Télécharger facture');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_HINT', 'Veuillez télécharger ici le document correspondant (aperçu facture, facture, note de crédit).');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_CREDIT_MEMO', 'Télécharger crédit');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_PREVIEW', 'Télécharger aperçu de la facture');

define('MODULE_PAYMENT_SOFORT_SR_EDIT_CART', 'Ajuster panier');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART', 'Sauvegarder panier');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_QUESTION', 'Êtes-vous sûr de vouloir réajuster le panier?');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_HINT', 'Veuillez sauvegarder ici vos modifications du panier. Si la facture a déjà été confirmée, l\'article réduit en quantité ainsi que supprimé de la facture, sera remboursé en forme d\'un crédit.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_HINT', 'Vous pouvez ajuster les rabais ou les augmentations. Augmentations ne peuvent pas être augmentées et rabais ne peuvent pas avoir des montants supérieurs à zéro. Le total de la facture ne peut pas être augmenté par l\'ajustement.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_GTZERO_HINT', 'Rabais ne peuvent pas contenir des montants supérieurs à zéro.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY', 'Ajuster la quantité');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_HINT', 'Vous pouvez ajuster le nombre d\'articles par position. La quantité peut être seulement réduite et ne pas ajoutée.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_TOTAL_GTZERO', 'Le nombre de l\'article ne peut pas être réduit, puisque le montant total de la facture ne peut pas être négatif.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_ZERO_HINT', 'Le nombre doit être supérieur à 0. Pour supprimer, veuillez sélectionner l\'article à la fin de la ligne.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE', 'Ajuster prix');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_HINT', 'Vous pouvez ajuster le prix de chaque article par position. Les prix peuvent seulement être réduits et ne pas augmentés.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_TOTAL_GTZERO', 'Le prix de peut pas être réduit, puisque le montant total de la facture ne peut pas être négatif.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_HINT', 'Le prix et la quantité ne peuvent pas être ajuster au même temps.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_NAN', 'Vous avez entré des caractères incorrects. Avec ces ajustements uniquement des chiffres sont autorisés.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_VALUE_LTZERO_HINT', 'La valeur ne peut pas être inférieure à 0.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE', 'Veuillez entrer un commentaire');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE_HINT', 'Si une facture déjà confirmée est modifiée, une justification respective doit être déposée. Celle-là apparaîtra plus tard sur la note de crédit comme commentaire de l\'article correspondant.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_HINT', 'Vous pouvez adapter le prix des frais d\'expédition. Le prix peut être seulement réduit, et ne pas augmenté.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_TOTAL_GTZERO', 'Les coûts d\'envoi ne peuvent pas être réduit, puisque le montant total de la facture ne peut pas être négatif.');
define('MODULE_PAYMENT_SOFORT_SR_RECALCULATION', 'sera calculé de nouveau');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_TOTAL_GTZERO','Cet article ne peut pas être supprimé, puisque le montant total de la facture ne peut pas être négatif.');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_ARTICLE_FROM_INVOICE', 'Supprimer article');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE', 'Supprimer position');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_QUESTION', 'Êtes-vous sûr de vouloir supprimer l\'article suivant: %s?');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_HINT', 'Veuillez sélectionner les articles à supprimer. Si une facture a déjà été confirmée, chaque article supprimé sera remboursé en forme de crédit.');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_LAST_ARTICLE_HINT', 'En réduisant la totalité des articles ou en supprimant le dernier, la facture sera annulée entièrement.');
define('MODULE_PAYMENT_SOFORT_SR_SYNC_FAILED_SELLER', 'Cette commande contient des articles qui peuvent créer des problèmes pendant la synchronisation avec les serveurs SOFORT. En cas de modifications ultérieures concernant expédition, rabais ou articles, veuillez comparer les données indiquées sur la facture PDF avec les données sauvegardées dans la boutique en ligne pour éviter une expédition erronée. Changements du panier peuvent être effectué seulement dans le menu commerçant de SOFORT si nécessaire.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_GX_CUSTOMIZER_AFFECTED', 'En l\'occurrence, il s\'agit d\'articles qui utilisent des fonctions de GX-Customizers.');

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_BUYER', 'Commande soumise avec succès. Confirmation n\'a pas encore eu lieu..');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_SELLER', 'Commande conclue avec succès - la facture ne peut pas être confirmé - votre identification de transaction:');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_BUYER', 'Commande annulée.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_BUYER', 'Commande confirmée et en traitement.');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_SELLER', 'La facture a été confirmée et crée.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_BUYER', 'La facture a été créditée.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_SELLER', 'La facture a été créditée. Le crédit a été créé.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_REANIMATED', 'L\'annulation de la facture a été annulé.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_BUYER', 'Commande annulée.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_SELLER', 'La commande a été annulée. Période de confirmation expiré.');

define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CURRENT_TOTAL', 'Montant de facturation courant:');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED', 'Facture a été confirmé.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_TRANSACTION_ID', 'ID de transaction');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CANCELED_REFUNDED', 'La facture a été annulé. Crédit créé. {{time}}');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_EDITED', 'Le panier a été ajusté.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_RESET', 'Le panier a été remis à l\'état initial.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9000', 'Aucune transaction de facture trouvée.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9001', 'La facture n\'a pas pu être confirmée.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9002', 'La somme de la facture transmise dépasse la limite du crédit.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9003', 'La facture n\'a pas pu être annulée.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9004', 'La demande contenait des positions de panier invalides.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9005', 'La panier n\'a pas pu être ajusté.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9006', 'L\'accès à l\'interface n\'est plus possible 30 jours après la réception du paiement.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9007', 'La facture a déjà été annulée.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9008', 'Le montant de la T.V.A. transmise est trop est trop élevé.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9009', 'Les montants de la T.V.A. transmise des articles sont en conflit les uns aux autres.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9010', 'L\'ajustement du panier n\'est pas possible.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9011', 'Aucun commentaire n\'a été transmis pour l\'ajustement du panier.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9012', 'Aucune position ne peut être ajoutée au panier. De même, le volume par position de la facture ne peut pas être augmenté. Montants de positions singuliers ne peuvent pas dépasser le montant d\'origine.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9013', 'Dans votre panier se trouvent seulement des articles qui ne peuvent pas être facturés.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9014', 'Le numéro de facture transmis est déjà e cours d\'utilisation.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9015', 'Le numéro transmis du crédit est déjà en cours d\'utilisation.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9016', 'Le numéro de commande transmis est déjà en cours d\'utilisation.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9017', 'La facture a déjà été confirmée.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9018', 'Aucune donné de la facture n\'a été ajustée.');