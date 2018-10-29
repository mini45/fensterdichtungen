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
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TEXT', '("Mode de paiement conseill�")');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION', '<b>iDEAL</b><br />D�s que le client a s�lectionn� le mode de paiement et sa banque, il sera redirig� par SOFORT AG � sa banque. L� il effectue son paiement et sera retransmis ensuite sur le syst�me de vente. Si la confirmation du paiement r�ussit, un Callback par SOFORT AG aura lieu sur le syst�me de vente lequel modifie en cons�quence l\'�tat du paiement de la commande.<br />Mis en place par SOFORT AG');

//all shopsystem-params
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_TITLE', 'iDEAL - Activer module sofort.de');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_TITLE', '"Mode de paiement conseill�"');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_TITLE', 'Tester cl� de configuration/API-Key');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_AUTH_DESC', "<script>function t(){k = document.getElementsByName(\"configuration[MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY]\")[0].value;window.open(\"../callback/sofort/testAuth.php?k=\"+k);}</script><input type=\"button\" onclick=\"t()\" value=\"Test\" />");  //max 255 signs
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_TITLE' , MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_TITLE' , 'Zone de paiement');
define('MODULE_PAYMENT_SOFORT_IDEAL_ALLOWED_DESC' , 'Veuillez indiquer <b>s�par�ment</b> les zones, lesquelles seront autoris�es pour ce module. (par exemple AT,DE (si vide toutes les zones seront autoris�es))');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_TITLE' , '�tat de commande temporaire');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_TITLE', 'Confirmer �tat de commande');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_TITLE', 'Annulation automatique avec rejet de d�bit');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_TITLE', 'Remboursement partiel');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_TITLE', 'Remboursement int�gral');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_TITLE', '�tat de la commande pour un paiement annul�');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_TITLE', '�tat de commande en cas d\'une annulation compl�te');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_TITLE', 'Ordre d\'affichage');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_TITLE', 'Cl� de configuration attribu� par SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_TITLE', 'Mot de passe du projet');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_TITLE', 'Mot de passe de notification');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_TITLE', 'R�f�rence 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_TITLE', 'R�f�rence 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_TITLE', 'Logo+texte');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_STATUS_DESC', 'Active/d�sactive le module entier');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_RECOMMENDED_PAYMENT_DESC', 'Mettre iDEAL comme m�thode de paiement recommand�e');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ZONE_DESC', 'Quand une zone est s�lectionn�e, la m�thode de paiement est valable seulement pour cette zone.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_STATUS_ID_DESC', '�tat de la commande pour transactions non-conclues. La commande a �t� cr�e mais la transaction n\'a pas encore �t� confirm�e par SOFORT AG.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ORDER_STATUS_ID_DESC', '�tat de commande confirm�<br />�tat de commande apr�s transaction conclue.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LOS_NOT_CRE_STATUS_ID_DESC', '�tat de la commande en cas d\'annulation enti�re.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CANCELED_ORDER_STATUS_ID_DESC', '�tat de la commande pour commandes qui ont �t� annul�es pendant le processus de paiement.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_LAT_SUC_AUT_STATUS_ID_DESC', '�tat des commandes chez lesquelles une r�ception du paiement a �t� constat�e apr�s l\'expiration de la p�riode d\'attente sp�cifi�e dans le projet SOFORT et lesquelles ont �t� annul�e automatiquement pour cette raison. Le remboursement du d�bit sera aussi transf�r� automatiquement sur le compte de l\'acheteur.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_COM_STATUS_ID_DESC', '�tat des commandes quand un montant partiel a �t� rembours� � l\'acheteur.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REF_REF_STATUS_ID_DESC', '�tat des commandes quand le montant int�gral a �t� rembours� � l\'acheteur.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_SORT_ORDER_DESC', 'Ordre de l\'affichage. Le chiffre plus petit est affich� en premier.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CONFIGURATION_KEY_DESC', 'Cl� de configuration attribu� par SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_PROJECT_PASSWORD_DESC', 'Mot de passe attribu� par SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_NOTIFICATION_PASSWORD_DESC', 'Mot de passe de notification attribu� par SOFORT AG');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_1_DESC', 'R�f�rence 1');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_REASON_2_DESC', 'R�f�rence 2');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IMAGE_DESC', 'Banni�re ou texte dans la s�lection des options de paiement');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_CHECKOUT_TEXT', 'iDEAL.nl - virements en ligne pour le commerce �lectronique dans les Pays-Bas. Pour le paiement avec iDEAL vous avez besoin d\'un compte chez une des banques indiqu�es. Vous effectuez le virement directement chez votre banque. Services/marchandises seront, si disponibles, livr�s ou bien envoy�s IMM�DIATEMENT!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'iDEAL.nl - virements en ligne pour le commerce �lectronique dans les Pays-Bas. Pour le paiement avec iDEAL vous avez besoin d\'un compte chez une des banques indiqu�es. Vous effectuez le virement directement chez votre banque. Services/marchandises seront, si disponibles, livr�s ou bien envoy�s IMM�DIATEMENT!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TMP_COMMENT', 'iDEAL s�lectionn� comme mode de paiement. Transaction pas conclue.');

define('MODULE_PAYMENT_SOFORT_IDEAL_PEN_NOT_CRE_YET_BUYER', 'La commande a �t� transmise avec succ�s. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_REC_CRE_BUYER', '{{paymentMethodStr}} - Argent re�u. {{time}}');
define('MODULE_PAYMENT_SOFORT_IDEAL_LOS_NOT_CRE_YET_BUYER', 'Le paiement a �t� annul�.');
define('MODULE_PAYMENT_SOFORT_IDEAL_LAT_SUC_AUT_BUYER', 'La transaction a �t� annul�e automatiquement. Retour de d�bit sur le compte de l\'acheteur a �t� ordonn�.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_COM_BUYER', 'Une partie du montant sera rembours�e.');
define('MODULE_PAYMENT_SOFORT_IDEAL_REF_REF_BUYER', 'Le montant de la facture sera rembours�. {{time}}');

//////////////////////////////////////////////////////////////////////////////////////////////

define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10000', 'Veuillez s�lectionner une banque avant l\'envoi!');

define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_TEXT', 'iDEAL.nl - virements en ligne pour le commerce �lectronique dans les Pays-Bas. Pour le paiement avec iDEAL vous avez besoin d\'un compte chez une des banques indiqu�es. Vous effectuez le virement directement chez votre banque. Services/marchandises seront, si disponibles, livr�s ou bien envoy�s IMM�DIATEMENT!');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_ERROR_HEADING', 'L\'erreur suivante a �t� signal�e pendant le processus:');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_ALL_CODES', 'Erreur pendant la transmission de donn�es, vous �tes pri� de s�lectionner un autre mode de paiement ou contacter le g�rant de la boutique en ligne.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_ERROR_DEFAULT', 'Erreur pendant la transmission de donn�es, vous �tes pri� de s�lectionner un autre mode de paiement ou contacter le g�rant de la boutique en ligne.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_IDEALSELECTED_PENDING' , 'iDEAL s�lectionn� comme mode de paiement. Transaction pas conclue.');
define('MODULE_PAYMENT_SOFORT_IDEAL_CLASSIC_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_SELECTBOX_TITLE', 'Veuillez s�lectionner votre banque');
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
      	<p>Apr�s la confirmation de la commande vous serez redirig� au syst�me de paiement de votre banque s�lectionn�e et vous pouvez y effectuer le virement en ligne.</p><p>Pour cela vous avez besoin de vos donn�es d\'acc�s de banque en ligne, soit coordonn�es bancaires, num�ro de compte, code PIN et TAN. Pour plus d\'information allez sur: <a href="http://www.ideal.nl" target="_blank">iDEAL.nl</a></p>
      </td>
    </tr>
  </table>');