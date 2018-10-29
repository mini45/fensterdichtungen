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

define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS_WITH_LIGHTBOX', '<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">J\'ai lu la politique de confidentialit�.</a>');
define('MODULE_PAYMENT_SOFORT_SR_CHECKOUT_CONDITIONS', '
	<script type="text/javascript">
		function showSrConditions() {
			srOverlay = new sofortOverlay(jQuery(".srOverlay"), "callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/de/sr/privacy_de");
			srOverlay.trigger();
		}
	</script>
	<noscript>
		<a href="https://documents.sofort.com/de/sr/privacy_de" target="_blank">J\'ai lu la politique de confidentialit�.</a>
	</noscript>
	<!-- comSeo-Ajax-Checkout-Bugfix: show also div, when buyer doesnt use JS -->
	<div>
		<a id="srNotice" href="javascript:void(0)" onclick="showSrConditions();">J\'ai lu la politique de confidentialit�.</a>
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
define('MODULE_PAYMENT_SOFORT_SR_TEXT_ERROR_MESSAGE', 'Le mode de paiement s�lectionn� n\'est malheureusement pas possible ou a �t� annul� � la demande du client. Vous �tes pri� de s�lectionner un autre mode de paiement.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_SR', 'Le mode de paiement s�lectionn� n\'est malheureusement pas possible ou a �t� annul� � la demande du client. Vous �tes pri� de s�lectionner un autre mode de paiement.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_SR_CHECKOUT_TEXT', '');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_CONFIRM_SR', 'Confirmer facture ici:');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_TITLE', 'Ordre d\'affichage');
define('MODULE_PAYMENT_SOFORT_SR_SORT_ORDER_DESC', 'Ordre de l\'affichage. Le chiffre plus petit est affich� en premier.');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_TITLE', 'Activer module sofort.de');
define('MODULE_PAYMENT_SOFORT_SR_STATUS_DESC', 'Active/d�sactive le module entier');
define('MODULE_PAYMENT_SOFORT_SR_TEXT_DESCRIPTION', 'Kauf auf Rechnung avec garantie de paiement.');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_TITLE', 'Zones autoris�es');
define('MODULE_PAYMENT_SOFORT_SOFORTRECHNUNG_ALLOWED_DESC', 'Veuillez indiquer <b>s�par�ment</b> les zones, lesquelles seront autoris�es pour ce module. (par exemple AT,DE (si vide toutes les zones seront autoris�es))');
define('MODULE_PAYMENT_SOFORT_SR_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_SR_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_TITLE', '�tat de commande ne pas confirm�');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_STATUS_ID_DESC', '�tat de commande apr�s paiement r�ussi. La facture n\'a pas encore �t� valid�e par le commer�ant.'); // (pending-confirm_invoice)
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_TITLE', '�tat de commande en cas d\'une annulation compl�te');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_STATUS_ID_DESC', '�tat de commande annul�<br />�tat de commande apr�s une annulation compl�te de la facture.');  //(loss-canceled, loss-confirmation_period_expired)
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Confirmer �tat de commande');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_STATUS_ID_DESC', '�tat de commande apr�s transaction r�ussite et validation de la facture par le commer�ant.'); //(pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_TITLE', 'Annulation apr�s confirmation (cr�dit)');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_STATUS_ID_DESC', '�tat pour commandes qui ont �t� annul�e enti�rement apr�s la confirmation (cr�dit).'); // (refunded_refunded)
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT', 'Kauf auf Rechnung s�lectionn� comme mode de paiement. Transaction pas conclue.');
define('MODULE_PAYMENT_SOFORT_SR_TMP_COMMENT_SELLER', 'Redirection � SOFORT - Paiement ne pas encore effectu�.');

define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TITLE', '"Mode de paiement conseill�"');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_DESC', '"Noter ce mode de paiement comme "mode de paiement recommand�". Sur la page du paiement une indication suit directement derri�re le mode de paiement."');
define('MODULE_PAYMENT_SOFORT_SR_RECOMMENDED_PAYMENT_TEXT', '("Mode de paiement conseill�")');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED_HISTORY', 'Ordre afin de confirmer la facture a �t� envoy� � SOFORT. Confirmation de la part de SOFORT en cours.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CANCELED_HISTORY', 'Ordre pour l\'annulation de la facture a �t� envoy� � SOFORT. Confirmation de la part de SOFORT en cours.');
define('MODULE_PAYMENT_SOFORT_SR_INVOICE_REFUNDED_HISTORY', 'Ordre pour le cr�dit de la facture a �t� envoy� � SOFORT. Confirmation de la part de SOFORT en cours.');

/////////////////////////////////////////////////
//////// Seller-Backend and callback.php ////////
/////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_SR_CONFIRM_INVOICE', 'Confirmer facture');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE', 'Annuler facture');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE', 'Cr�diter facture');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_INVOICE_QUESTION', '�tes-vous s�r de vouloir effectivement annuler la facture? Cette proc�dure ne peut pas �tre r�voqu�e.');
define('MODULE_PAYMENT_SOFORT_SR_CANCEL_CONFIRMED_INVOICE_QUESTION', '�tes-vous s�r de vouloir cr�diter la facture? Cette action ne peut pas �tre annul�e.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED_REFUNDED', 'La facture a �t� annul�. Cr�dit cr��.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_CANCELED', 'La facture a �t� annul�e.');

define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE', 'T�l�charger facture');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_HINT', 'Veuillez t�l�charger ici le document correspondant (aper�u facture, facture, note de cr�dit).');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_CREDIT_MEMO', 'T�l�charger cr�dit');
define('MODULE_PAYMENT_SOFORT_SR_DOWNLOAD_INVOICE_PREVIEW', 'T�l�charger aper�u de la facture');

define('MODULE_PAYMENT_SOFORT_SR_EDIT_CART', 'Ajuster panier');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART', 'Sauvegarder panier');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_QUESTION', '�tes-vous s�r de vouloir r�ajuster le panier?');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CART_HINT', 'Veuillez sauvegarder ici vos modifications du panier. Si la facture a d�j� �t� confirm�e, l\'article r�duit en quantit� ainsi que supprim� de la facture, sera rembours� en forme d\'un cr�dit.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_HINT', 'Vous pouvez ajuster les rabais ou les augmentations. Augmentations ne peuvent pas �tre augment�es et rabais ne peuvent pas avoir des montants sup�rieurs � z�ro. Le total de la facture ne peut pas �tre augment� par l\'ajustement.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_DISCOUNTS_GTZERO_HINT', 'Rabais ne peuvent pas contenir des montants sup�rieurs � z�ro.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY', 'Ajuster la quantit�');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_HINT', 'Vous pouvez ajuster le nombre d\'articles par position. La quantit� peut �tre seulement r�duite et ne pas ajout�e.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_TOTAL_GTZERO', 'Le nombre de l\'article ne peut pas �tre r�duit, puisque le montant total de la facture ne peut pas �tre n�gatif.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_QUANTITY_ZERO_HINT', 'Le nombre doit �tre sup�rieur � 0. Pour supprimer, veuillez s�lectionner l\'article � la fin de la ligne.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE', 'Ajuster prix');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_HINT', 'Vous pouvez ajuster le prix de chaque article par position. Les prix peuvent seulement �tre r�duits et ne pas augment�s.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_TOTAL_GTZERO', 'Le prix de peut pas �tre r�duit, puisque le montant total de la facture ne peut pas �tre n�gatif.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_HINT', 'Le prix et la quantit� ne peuvent pas �tre ajuster au m�me temps.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_PRICE_AND_QUANTITY_NAN', 'Vous avez entr� des caract�res incorrects. Avec ces ajustements uniquement des chiffres sont autoris�s.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_VALUE_LTZERO_HINT', 'La valeur ne peut pas �tre inf�rieure � 0.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE', 'Veuillez entrer un commentaire');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_CONFIRMED_INVOICE_HINT', 'Si une facture d�j� confirm�e est modifi�e, une justification respective doit �tre d�pos�e. Celle-l� appara�tra plus tard sur la note de cr�dit comme commentaire de l\'article correspondant.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_HINT', 'Vous pouvez adapter le prix des frais d\'exp�dition. Le prix peut �tre seulement r�duit, et ne pas augment�.');
define('MODULE_PAYMENT_SOFORT_SR_UPDATE_SHIPPING_TOTAL_GTZERO', 'Les co�ts d\'envoi ne peuvent pas �tre r�duit, puisque le montant total de la facture ne peut pas �tre n�gatif.');
define('MODULE_PAYMENT_SOFORT_SR_RECALCULATION', 'sera calcul� de nouveau');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_TOTAL_GTZERO','Cet article ne peut pas �tre supprim�, puisque le montant total de la facture ne peut pas �tre n�gatif.');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_ARTICLE_FROM_INVOICE', 'Supprimer article');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE', 'Supprimer position');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_QUESTION', '�tes-vous s�r de vouloir supprimer l\'article suivant: %s?');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_FROM_INVOICE_HINT', 'Veuillez s�lectionner les articles � supprimer. Si une facture a d�j� �t� confirm�e, chaque article supprim� sera rembours� en forme de cr�dit.');
define('MODULE_PAYMENT_SOFORT_SR_REMOVE_LAST_ARTICLE_HINT', 'En r�duisant la totalit� des articles ou en supprimant le dernier, la facture sera annul�e enti�rement.');
define('MODULE_PAYMENT_SOFORT_SR_SYNC_FAILED_SELLER', 'Cette commande contient des articles qui peuvent cr�er des probl�mes pendant la synchronisation avec les serveurs SOFORT. En cas de modifications ult�rieures concernant exp�dition, rabais ou articles, veuillez comparer les donn�es indiqu�es sur la facture PDF avec les donn�es sauvegard�es dans la boutique en ligne pour �viter une exp�dition erron�e. Changements du panier peuvent �tre effectu� seulement dans le menu commer�ant de SOFORT si n�cessaire.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_GX_CUSTOMIZER_AFFECTED', 'En l\'occurrence, il s\'agit d\'articles qui utilisent des fonctions de GX-Customizers.');

define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_BUYER', 'Commande soumise avec succ�s. Confirmation n\'a pas encore eu lieu..');
define('MODULE_PAYMENT_SOFORT_SR_PEN_CON_INV_SELLER', 'Commande conclue avec succ�s - la facture ne peut pas �tre confirm� - votre identification de transaction:');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_BUYER', 'Commande annul�e.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CAN_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_BUYER', 'Commande confirm�e et en traitement.');
define('MODULE_PAYMENT_SOFORT_SR_PEN_NOT_CRE_YET_SELLER', 'La facture a �t� confirm�e et cr�e.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_BUYER', 'La facture a �t� cr�dit�e.');
define('MODULE_PAYMENT_SOFORT_SR_REF_REF_SELLER', 'La facture a �t� cr�dit�e. Le cr�dit a �t� cr��.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_INVOICE_REANIMATED', 'L\'annulation de la facture a �t� annul�.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_BUYER', 'Commande annul�e.');
define('MODULE_PAYMENT_SOFORT_SR_LOS_CON_PER_EXP_SELLER', 'La commande a �t� annul�e. P�riode de confirmation expir�.');

define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CURRENT_TOTAL', 'Montant de facturation courant:');

define('MODULE_PAYMENT_SOFORT_SR_INVOICE_CONFIRMED', 'Facture a �t� confirm�.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_TRANSACTION_ID', 'ID de transaction');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CANCELED_REFUNDED', 'La facture a �t� annul�. Cr�dit cr��. {{time}}');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_EDITED', 'Le panier a �t� ajust�.');
define('MODULE_PAYMENT_SOFORT_SR_TRANSLATE_CART_RESET', 'Le panier a �t� remis � l\'�tat initial.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9000', 'Aucune transaction de facture trouv�e.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9001', 'La facture n\'a pas pu �tre confirm�e.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9002', 'La somme de la facture transmise d�passe la limite du cr�dit.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9003', 'La facture n\'a pas pu �tre annul�e.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9004', 'La demande contenait des positions de panier invalides.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9005', 'La panier n\'a pas pu �tre ajust�.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9006', 'L\'acc�s � l\'interface n\'est plus possible 30 jours apr�s la r�ception du paiement.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9007', 'La facture a d�j� �t� annul�e.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9008', 'Le montant de la T.V.A. transmise est trop est trop �lev�.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9009', 'Les montants de la T.V.A. transmise des articles sont en conflit les uns aux autres.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9010', 'L\'ajustement du panier n\'est pas possible.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9011', 'Aucun commentaire n\'a �t� transmis pour l\'ajustement du panier.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9012', 'Aucune position ne peut �tre ajout�e au panier. De m�me, le volume par position de la facture ne peut pas �tre augment�. Montants de positions singuliers ne peuvent pas d�passer le montant d\'origine.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9013', 'Dans votre panier se trouvent seulement des articles qui ne peuvent pas �tre factur�s.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9014', 'Le num�ro de facture transmis est d�j� e cours d\'utilisation.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9015', 'Le num�ro transmis du cr�dit est d�j� en cours d\'utilisation.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9016', 'Le num�ro de commande transmis est d�j� en cours d\'utilisation.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9017', 'La facture a d�j� �t� confirm�e.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_9018', 'Aucune donn� de la facture n\'a �t� ajust�e.');