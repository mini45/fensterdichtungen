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
 * $Id: sofort_sofortueberweisung.php 6097 2013-04-22 12:00:13Z rotsch $
 */

//include language-constants used in all Multipay Projects
require_once 'sofort_general.php';

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_EXTRA',
	MODULE_PAYMENT_SOFORT_MULTIPAY_JS_LIBS.'
	<div id="suExtraDesc">
		<div class="content" style="display:none;"></div>
	</div>
	<script type="text/javascript">
		suOverlay = new sofortOverlay(jQuery("#suExtraDesc"), "'.DIR_WS_CATALOG.'callback/sofort/ressources/scripts/getContent.php", "https://documents.sofort.com/sb/shopinfo/fr");
	</script>
');

define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_TEXT_TITLE', 'SOFORT Banking <br /> <img src="https://images.sofort.com/de/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_TEXT_TITLE_ADMIN', 'SOFORT Banking <br /> <img src="https://images.sofort.com/de/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE', 'SOFORT Banking');
define('MODULE_PAYMENT_SOFORT_SU_KS_TEXT_TITLE', 'SOFORT Banking avec protection du consommateur');
define('MODULE_PAYMENT_SOFORT_SU_LOGO_HTML', '<img src="https://images.sofort.com/de/su/logo_90x30.png" alt="Logo SOFORT Banking"/>');
define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION', 'SOFORT Banking est le service de paiement gratuit, certifi� T�V de SOFORT AG.');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE', '     <table border="0" cellspacing="0" cellpadding="0">      <tr>        <td valign="bottom">
	<a onclick="javascript:window.open(\'https://images.sofort.com/de/su/landing.php\',\'Informations client\',\'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1020, height=900\');" style="float:left; width:auto; cursor:pointer;">
		{{image}}
	</a>
	</td>      </tr>      <tr> <td class="main">{{text}}</td>      </tr>      </table>');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'SOFORT Banking');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_TEXT', '<ul><li>Syst�me de paiement avec protection des donn�es certifi�e T�V</li><li>Pas d\'enregistrement</li><li>Marchandise/service sera envoy� si disponible IMM�DIATEMENT</li><li>Veuillez tenir � disposition vos donn�es de banque en ligne (code PIN/TAN)</li></ul>');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_TEXT_KS', '<ul><li>En payant avec SOFORT Banking vous b�n�ficiez de la protection du consommateur! [[link_beginn]]Plus d\'informations[[link_end]]</li><li>Syst�me de paiement avec protection des donn�es certifi� T�V</li><li>Pas d\'enregistrement</li><li>Marchandise/service est livr� ou envoy� si disponible IMM�DIATEMENT</li><li>Veuillez tenir � disposition vos donn�es de banque en ligne (code PIN/TAN)</li></ul>');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_SU_CHECKOUT_INFOLINK_KS', 'https://www.sofort-bank.com/eng-DE/general/kaeuferschutz/informationen-fuer-kaeufer/');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_ALLOWED_TITLE', 'Zones autoris�es');
define('MODULE_PAYMENT_SOFORT_SOFORTUEBERWEISUNG_ALLOWED_DESC', 'Veuillez indiquer <b>s�par�ment</b> les zones, lesquelles seront autoris�es pour ce module. (par exemple AT,DE (si vide toutes les zones seront autoris�es))');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_TITLE', 'Activer module sofort.de');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_DESC', 'Active/d�sactive le module entier');
define('MODULE_PAYMENT_SOFORT_SU_ZONE_TITLE', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE);
define('MODULE_PAYMENT_SOFORT_SU_ZONE_DESC', MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC);

define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_TITLE', 'Ordre d\'affichage');
define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_DESC', 'Ordre de l\'affichage. Le chiffre plus petit est affich� en premier.');
define('MODULE_PAYMENT_SOFORT_SU_KS_STATUS_TITLE', 'Activer protection du consommateur');
define('MODULE_PAYMENT_SOFORT_SU_KS_STATUS_DESC', 'Activer protection du consommateur pour SOFORT Banking');

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Confirmer �tat de commande');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_DESC', '�tat de commande confirm�<br />�tat de commande apr�s transaction conclue.'); // (pending-not_credited_yet)
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_TITLE', '�tat de la commande, quand l\'argent n\'est arriv�');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_DESC', '�tat de la commande si l\'argent n\'est pas arriv� dans votre compte. (Condition pr�alable: compte chez Sofort Bank).'); // (loss-not_credited)
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_TITLE', 'R�ception de paiement');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_DESC', '�tat des commandes quand l\'argent est arriv� sur le compte de la banque SOFORT.'); // (received-credited)
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_TITLE', 'Remboursement partiel');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_DESC', '�tat des commandes quand un montant partiel a �t� rembours� � l\'acheteur.');  // (refunded-compensation)
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_TITLE', 'Remboursement int�gral');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_DESC', '�tat des commandes quand le montant int�gral a �t� rembours� � l\'acheteur.'); // (refunded-refunded)

define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TITLE', '"Mode de paiement conseill�"');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_DESC', '"Noter ce mode de paiement comme "mode de paiement recommand�". Sur la page du paiement une indication suit directement derri�re le mode de paiement."');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TEXT', '("Mode de paiement conseill�")');

define('MODULE_PAYMENT_SOFORT_SU_TMP_COMMENT', 'SOFORT Banking s�lectionn� comme mode de paiement. Transaction pas conclue.');
define('MODULE_PAYMENT_SOFORT_SU_TMP_COMMENT_SELLER', 'Redirection � SOFORT - Paiement ne pas encore effectu�.');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_ERROR_MESSAGE', 'Le mode de paiement s�lectionn� n\'est malheureusement pas possible ou a �t� annul� � la demande du client. Vous �tes pri� de s�lectionner un autre mode de paiement.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_SU', 'Le mode de paiement s�lectionn� n\'est malheureusement pas possible ou a �t� annul� � la demande du client. Vous �tes pri� de s�lectionner un autre mode de paiement.');

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_BUYER', 'Commande avec SOFORT Banking transmis avec succ�s. Votre ID de transaction: {{transaction}}');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_BUYER', 'La r�ception du paiement n\'a jusqu\'� pr�sent pas pu �tre constat�. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_BUYER', '');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_SELLER', 'R�ception du paiement sur le compte');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_SELLER', '');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_BUYER', 'Le montant de la facture sera rembours�. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_SELLER', 'Une partie du montant factur� sera rembours�. Montant total rembours�: {{refunded_amount}}. {{time}}');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_BUYER', 'Une partie du montant sera rembours�e.');

?>