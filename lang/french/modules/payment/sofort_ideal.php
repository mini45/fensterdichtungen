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
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_TITLE', 'iDEAL <br /><img src="https://images.sofort.com/fr/ideal/logo_90x30.png" alt="Logo iDEAL"/>');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_TITLE_ADMIN', 'iDEAL <br /><img src="https://images.sofort.com/fr/ideal/logo_90x30.png" alt="Logo iDEAL"/>');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TEXT', '("Mode de paiement conseillé")');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION', '<b>iDEAL</b><br />Dès que le client a sélectionné le mode de paiement et sa banque, il sera redirigé par SOFORT AG à sa banque. Là il effectue son paiement et sera retransmis ensuite sur le système de vente. Si la confirmation du paiement réussit, un Callback par SOFORT AG aura lieu sur le système de vente lequel modifie en conséquence l\'état du paiement de la commande.<br />Mis en place par SOFORT AG');

//all shopsystem-params
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_TITLE', 'iDEAL - Activer module sofort.de');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TITLE', '"Mode de paiement conseillé"');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_TITLE', 'Tester clé de configuration/API-Key');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_DESC', "<script>function t(){k = document.getElementsByName(\"configuration[MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY]\")[0].value;window.open(\"../callback/sofort/testAuth.php?k=\"+k);}</script><input type=\"button\" onclick=\"t()\" value=\"Test\" />");  //max 255 signs
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_TITLE' , MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_TITLE' , 'Zone de paiement');
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_DESC' , 'Veuillez indiquer <b>séparément</b> les zones, lesquelles seront autorisées pour ce module. (par exemple AT,DE (si vide toutes les zones seront autorisées))');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_TITLE' , 'État de commande temporaire');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_TITLE', 'Confirmer état de commande');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_TITLE', 'Annulation automatique avec rejet de débit');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_TITLE', 'Remboursement partiel');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_TITLE', 'Remboursement intégral');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_TITLE', 'État de la commande pour un paiement annulé');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_TITLE', 'État de commande en cas d\'une annulation complète');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_TITLE', 'Ordre d\'affichage');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_TITLE', 'Clé de configuration attribué par SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_TITLE', 'Mot de passe du projet');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_TITLE', 'Mot de passe de notification');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_TITLE', 'Référence 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_TITLE', 'Référence 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_TITLE', 'Logo+texte');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_DESC', 'Active/désactive le module entier');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_DESC', 'Mettre iDEAL comme méthode de paiement recommandée');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_DESC', 'Quand une zone est sélectionnée, la méthode de paiement est valable seulement pour cette zone.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_DESC', 'État de la commande pour transactions non-conclues. La commande a été crée mais la transaction n\'a pas encore été confirmée par SOFORT AG.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_DESC', 'État de commande confirmé<br />État de commande après transaction conclue.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_DESC', 'État de la commande en cas d\'annulation entière.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_DESC', 'État de la commande pour commandes qui ont été annulées pendant le processus de paiement.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_DESC', 'État des commandes chez lesquelles une réception du paiement a été constatée après l\'expiration de la période d\'attente spécifiée dans le projet SOFORT et lesquelles ont été annulée automatiquement pour cette raison. Le remboursement du débit sera aussi transféré automatiquement sur le compte de l\'acheteur.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_DESC', 'État des commandes quand un montant partiel a été remboursé à l\'acheteur.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_DESC', 'État des commandes quand le montant intégral a été remboursé à l\'acheteur.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_DESC', 'Ordre de l\'affichage. Le chiffre plus petit est affiché en premier.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_DESC', 'Clé de configuration attribué par SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_DESC', 'Mot de passe attribué par SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_DESC', 'Mot de passe de notification attribué par SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_DESC', 'Référence 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_DESC', 'Référence 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_DESC', 'Bannière ou texte dans la sélection des options de paiement');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CHECKOUT_TEXT', 'iDEAL.nl - virements en ligne pour le commerce électronique dans les Pays-Bas. Pour le paiement avec iDEAL vous avez besoin d\'un compte chez une des banques indiquées. Vous effectuez le virement directement chez votre banque. Services/marchandises seront, si disponibles, livrés ou bien envoyés IMMÉDIATEMENT!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'iDEAL.nl - virements en ligne pour le commerce électronique dans les Pays-Bas. Pour le paiement avec iDEAL vous avez besoin d\'un compte chez une des banques indiquées. Vous effectuez le virement directement chez votre banque. Services/marchandises seront, si disponibles, livrés ou bien envoyés IMMÉDIATEMENT!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_COMMENT', 'iDEAL sélectionné comme mode de paiement. Transaction pas conclue.');

define('MODULE_PAYMENT_SOFORT_IDEAL_PEN_NOT_CRE_YET_BUYER', 'La commande a été transmise avec succès. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_REC_CRE_BUYER', '{{paymentMethodStr}} - Argent reçu. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_LOS_NOT_CRE_YET_BUYER', 'Le paiement a été annulé.');
define('MODULE_PAYMENT_SOFORT_IDEAL_LAT_SUC_AUT_BUYER', 'La transaction a été annulée automatiquement. Retour de débit sur le compte de l\'acheteur a été ordonné.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_COM_BUYER', 'Une partie du montant sera remboursée.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_REF_BUYER', 'Le montant de la facture sera remboursé. {{time}}');

//////////////////////////////////////////////////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10000', 'Veuillez sélectionner une banque avant l\'envoi!');

define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_TEXT', 'iDEAL.nl - virements en ligne pour le commerce électronique dans les Pays-Bas. Pour le paiement avec iDEAL vous avez besoin d\'un compte chez une des banques indiquées. Vous effectuez le virement directement chez votre banque. Services/marchandises seront, si disponibles, livrés ou bien envoyés IMMÉDIATEMENT!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_ERROR_HEADING', 'L\'erreur suivante a été signalée pendant le processus:');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_ALL_CODES', 'Erreur pendant la transmission de données, vous êtes prié de sélectionner un autre mode de paiement ou contacter le gérant de la boutique en ligne.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_DEFAULT', 'Erreur pendant la transmission de données, vous êtes prié de sélectionner un autre mode de paiement ou contacter le gérant de la boutique en ligne.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IDEALSELECTED_PENDING' , 'iDEAL sélectionné comme mode de paiement. Transaction pas conclue.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_SELECTBOX_TITLE', 'Veuillez sélectionner votre banque');
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
      	<p>Après la confirmation de la commande vous serez redirigé au système de paiement de votre banque sélectionnée et vous pouvez y effectuer le virement en ligne.</p><p>Pour cela vous avez besoin de vos données d\'accès de banque en ligne, soit coordonnées bancaires, numéro de compte, code PIN et TAN. Pour plus d\'information allez sur: <a href="http://www.ideal.nl" target="_blank">iDEAL.nl</a></p>
      </td>
    </tr>
  </table>');