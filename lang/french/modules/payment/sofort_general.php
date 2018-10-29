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

define('MODULE_PAYMENT_SOFORT_MULTIPAY_APIKEY_TITLE', 'Cl� de configuration');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_APIKEY_DESC', 'Cl� de configuration attribu� par SOFORT AG');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_AUTH_TITLE', 'Tester cl� de configuration/API-Key');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_AUTH_DESC', '<noscript>Veuillez activer Javascript!</noscript>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/jquery.min_1.8.3.js"></script>
	<script type="text/javascript" src="'.DIR_WS_CATALOG.'callback/sofort/ressources/javascript/testAuth.js"></script>
');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_TITLE', 'Zone de paiement');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ZONE_DESC', 'Quand une zone est s�lectionn�e, la m�thode de paiement est valable seulement pour cette zone.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_1_TITLE', 'R�f�rence 1');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_1_DESC', 'Dans la r�f�rence 1 les options suivantes peuvent �tre s�lectionn�es');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_2_TITLE', 'R�f�rence 2');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_REASON_2_DESC', 'Dans le motif (maximum 27 caract�res), les espaces r�serv�es suivants seront remplac�s:<br />{{order_date}}<br />{{customer_id}}<br />{{customer_name}}<br />{{customer_company}}<br />{{customer_email}}');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEXT_ERROR_HEADING', 'L\'erreur suivante a �t� signal�e pendant le processus:');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEXT_ERROR_MESSAGE', 'Le mode de paiement s�lectionn� n\'est malheureusement pas possible ou a �t� annul� � la demande du client. Vous �tes pri� de s�lectionner un autre mode de paiement.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_IMAGE_TITLE', 'Banni�re ou texte dans la s�lection des options de paiement');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_IMAGE_DESC', 'Banni�re ou texte dans la s�lection des options de paiement');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_PROF_SETTINGS_TITLE', '<span style="font-weight:bold; text-decoration:underline; font-size:1.4em;"><br />Param�tres professionnels</span> ');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_PROF_SETTINGS_DESC', 'Les param�tres suivants ne n�cessitent habituellement aucun ajustement et devraient �tre d�j� rempli avec les valeurs correctes.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_LOG_ENABLED_TITLE', 'Activer enregistrement');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_LOG_ENABLED_DESC', 'Veuillez activer le loggin (enregistrement), pour enregistrer des erreurs, des avertissements ainsi que les demandes et les r�ponses des serveurs SOFORT. Le loggin (enregistrement) devrait �tre activ� pour des raison de protection des donn�es uniquement pour la recherche d\'erreurs. Vous pouvez trouver plus d\'information dans le manuel.');

define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEMP_STATUS_ID_TITLE', '�tat de commande temporaire');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_TEMP_STATUS_ID_DESC', '�tat de la commande pour transactions non-conclues. La commande a �t� cr�e mais la transaction n\'a pas encore �t� confirm�e par SOFORT AG.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ABORTED_STATUS_ID_TITLE', '�tat de la commande pour un paiement annul�'); //Bestellstatus bei abgebrochener/erfolgloser Zahlung
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ABORTED_STATUS_ID_DESC', '�tat de la commande pour commandes qui ont �t� annul�es pendant le processus de paiement.'); //Bestellstatus bei Bestellungen, die whrend des Bestellvorgangs oder im Wizard abgebrochen wurden.
define('MODULE_PAYMENT_SOFORT_MULTIPAY_ORDER_CANCELED', 'La commande a �t� annul�e.'); //Die Bestellung wurde abgebrochen.

define('MODULE_PAYMENT_SOFORT_MULTIPAY_TRANSACTION_ID', 'ID de transaction');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_UPDATE_NOTICE', 'Le module a �t� actualis�. Pour un fonctionnement correct, tous (!) les modes de paiement SOFORT doivent �tre d�sinstall� et ensuite r�-install� (si besoin). Jusque-l�, les modes de paiements ne seront pas offerts � l\'acheteur. Veuillez prendre note des param�tres du module avant de le d�sinstaller!');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_VERSIONNUMBER', 'Num�ro de version');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_FORWARDING', 'Votre demande est en cours de v�rification, veuillez attendre un moment et ne pas abandonner. Le processus peut prendre jusqu\'� 30 secondes.');

define('MODULE_PAYMENT_SOFORT_KEYTEST_SUCCESS', 'Cl� API valid� avec succ�s!');
define('MODULE_PAYMENT_SOFORT_KEYTEST_SUCCESS_DESC', 'Test OK le');
define('MODULE_PAYMENT_SOFORT_KEYTEST_ERROR', 'Cl� API n\'a pas pu �tre valid�e!');
define('MODULE_PAYMENT_SOFORT_KEYTEST_ERROR_DESC', 'Attention: cl� API erron�e');
define('MODULE_PAYMENT_SOFORT_KEYTEST_DEFAULT', 'Cl� API ne pas encore test�e');

define('MODULE_PAYMENT_SOFORT_REFRESH_INFO', 'Si venez de confirmer, ajuster, annuler ou cr�diter cette commande, vous devrez peut-�tre actualiser cette page {{refresh}} afin que tous les changements soient visible.');
define('MODULE_PAYMENT_SOFORT_REFRESH_PAGE', 'Cliquez ici pour actualiser cette page');
define('MODULE_PAYMENT_SOFORT_TRANSLATE_TIME', 'Heure');

//definition of error-codes that can resolve by calling the SOFORT-API
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_0',		'Une erreur inconnue s\'est produite.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8002',		'Un erreur s\'est produite pendant la validation.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010',		'Les donn�es sont incompl�tes ou erron�es. Vous �tes pri� de les corriger ou de contacter le g�rant de la boutique en ligne.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8011',		'Pas dans la port�e des valeurs valides.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8012',		'La valeur doit �tre positive.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8013',		'En ce moment uniquement des commandes en Euro sont possibles. Veuillez corriger cela et essayer ensuite de nouveau.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8015',		'Le total est trop �lev� ou trop bas. Veuillez corriger cela ou contacter le g�rant de la boutique en ligne.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8017',		'Caract�res inconnus.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8018',		'Nombre maximal de caract�res d�pass� (max. 27).');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8019',		'La commande ne peut pas �tre effectu�e en raison d\'une adresse e-mail erron�e. Veuillez corriger celle-ci et essayer de nouveau ensuite.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8020',		'La commande ne peut pas �tre effectu� en raison d\'un num�ro de t�l�phone erron�. Veuillez corriger cela et essayer de nouveau ensuite.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8021',		'Le code du pays n\'est pas support�, vous �tes pri� de contacter votre commer�ant.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8022',		'Le BIC indiqu� n\'est pas valable.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8023',		'La commande ne peut pas �tre effectu� en raison d\'un BIC (Bank Identifier Code) erron�. Veuillez corriger cela et essayer de nouveau ensuite.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8024',		'La commande ne peut pas �tre effectu�e en raison d\'un code pays erron�. L\'adresse de livraison/facturation doit �tre en Allemagne. Veuillez corriger cela et essayer de nouveau ensuite.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8029',		'Seulement les comptes bancaires allemands sont compatibles. Veuillez corriger cela ou s�lectionner un autre mode de paiement.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8033',		'Le total est trop �lev�. Veuillez corriger cela et essayer de nouveau ensuite.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8034',		'Le total est trop bas. Veuillez corriger cela et essayer de nouveau ensuite.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8041',		'Valeur pour la TVA n\'est pas correcte. Valeurs valables sont: 0, 7 ou 19.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8046',		'La validation du compte bancaire et du code de banque a �chou�e.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8047',		'A d�pass� le nombre maximal de 255 caract�res.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8051',		'La demande contenait des positions de panier non valables. Veuillez corriger ceci ou contacter le g�rant de la boutique en ligne.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8058',		'Veuillez au moins indiquer le titulaire du compte et essayez de nouveau ensuite.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8061',		'Une transaction avec les donn�es que vous avez soumis existe d�j�.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8068',		'Kauf auf rechnung (achat sur compte) est disponible en ce moment uniquement aux clients priv�s.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10001', 	'Vous �tes pri� de remplir enti�rement les champs num�ro de compte, code de banque et titulaire du compte.'); //LS: holder and bankdata missing
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10002',	'Veuillez accepter la politique de confidentialit�.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10003',	'Malheureusement, le mode de paiement s�lectionn� ne peut pas �tre utilis� pour payer articles comme t�l�chargements et ch�ques-cadeaux.');  //RBS and virtual content is not allowed
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10007',	'Une erreur inconnue s\'est produite.');  //Rechnung by SOFORT: check of shopamount against invoiceamount failed (more than one percent difference found)
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_10008',	'Une erreur s\'est produite pendant la synchronisation avec les serveurs SOFORT. Vous �tes pri� d\'utiliser les options dans le menu commer�ant SOFORT pour traiter la facture ou le panier.');  //Rechnung by SOFORT: Sync of Articles failed

//check for empty fields failed (code 8010 = 'must not be empty')
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.EMAIL_CUSTOMER',				'L\'adresse e-mail ne peut pas �tre vide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.PHONE_CUSTOMER',				'Le num�ro de t�l�phone ne peut pas �tre vide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.FIRSTNAME',	'Le pr�nom de l\'adresse de facturation ne peut pas �tre vide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.FIRSTNAME',	'Le pr�nom de l\'adresse d\'envoi ne peut pas �tre vide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.LASTNAME',	'Le nom de l\'adresse de facturation ne peut pas �tre vide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.LASTNAME',	'Le nom de l\'adresse d\'envoi ne peut pas �tre vide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.STREET',		'Rue et num�ro de rue doivent �tre s�par�s par un espace.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.STREET',		'Rue et num�ro de rue doivent �tre s�par�s par un espace.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.STREET_NUMBER',	'Rue et num�ro de rue doivent �tre s�par�s par un espace.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.STREET_NUMBER',	'Rue et num�ro de rue doivent �tre s�par�s par un espace.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.ZIPCODE',		'Le code postal de l\'adresse de facturation ne peut pas �tre vide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.ZIPCODE',	'Le code postal de l\'adresse d\'envoi ne peut pas �tre vide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.CITY',		'Le nom de la ville de l\'adresse de facturation ne peut pas �tre vide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.CITY',		'Le nom de la ville de l\'adresse d\'envoi ne peut pas �tre vide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.INVOICE_ADDRESS.COUNTRY_CODE',	'Le code du pays de l\'adresse de facturation ne peut pas �tre vide.');
define('MODULE_PAYMENT_SOFORT_MULTIPAY_XML_FAULT_8010.SHIPPING_ADDRESS.COUNTRY_CODE',	'Le code du pays de l\'adresse d\'envoi ne peut pas �tre vide.');