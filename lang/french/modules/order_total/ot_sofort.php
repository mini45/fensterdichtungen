<?php
/**
 * @version SOFORT Gateway 5.2.0 - $Date: 2012-11-21 12:09:39 +0100 (Wed, 21 Nov 2012) $
 * @author SOFORT AG (integration@sofort.com)
 * @link http://www.sofort.com/
 *
 * Copyright (c) 2012 SOFORT AG
 * 
 * Released under the GNU General Public License (Version 2)
 * [http://www.gnu.org/licenses/gpl-2.0.html]
 *
 * $Id: ot_sofort.php 5725 2012-11-21 11:09:39Z rotsch $
 */

$num = 3;

define('MODULE_ORDER_TOTAL_SOFORT_TITLE', 'Module de remise sofort.de');
define('MODULE_ORDER_TOTAL_SOFORT_DESCRIPTION', 'Remise pour les modes de paiement de sofort.com');

define('MODULE_ORDER_TOTAL_SOFORT_STATUS_TITLE', 'Afficher remise');
define('MODULE_ORDER_TOTAL_SOFORT_STATUS_DESC', 'Désirez-vous activer la remise selon le mode de paiement?');

define('MODULE_ORDER_TOTAL_SOFORT_SORT_ORDER_TITLE', 'Ordre d\'affichage');
define('MODULE_ORDER_TOTAL_SOFORT_SORT_ORDER_DESC', 'Ordre de l\'affichage. Le chiffre plus petit est affiché en premier.');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SU_TITLE', 'Échelle des rabais pour SOFORT Banking');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SU_DESC', 'Remise (valeur minimale:pourcentage&montant fixe)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SL_TITLE', 'Échelle des rabais pour SOFORT Lastschrift');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SL_DESC', 'Remise (valeur minimale:pourcentage&montant fixe)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SR_TITLE', 'Échelle des rabais pour Rechnung by SOFORT');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SR_DESC', 'Remise (valeur minimale:pourcentage&montant fixe)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SV_TITLE', 'Échelle des rabais pour Vorkasse by SOFORT');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_SV_DESC', 'Remise (valeur minimale:pourcentage&montant fixe)');

define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_LS_TITLE', 'Échelle des rabais pour Lastschrift by SOFORT');
define('MODULE_ORDER_TOTAL_SOFORT_PERCENTAGE_LS_DESC', 'Remise (valeur minimale:pourcentage&montant fixe)');

define('MODULE_ORDER_TOTAL_SOFORT_INC_SHIPPING_TITLE', 'Frais d\'envoi inclus');
define('MODULE_ORDER_TOTAL_SOFORT_INC_SHIPPING_DESC', 'Frais d\'envoi sont rabaissés');

define('MODULE_ORDER_TOTAL_SOFORT_INC_TAX_TITLE', 'Taxe sur le chiffre d\'affaires inclue');
define('MODULE_ORDER_TOTAL_SOFORT_INC_TAX_DESC', 'Taxe sur le chiffre d\'affaires avec remise');

define('MODULE_ORDER_TOTAL_SOFORT_CALC_TAX_TITLE', 'Calcul de la taxe sur le chiffre d\'affaires');
define('MODULE_ORDER_TOTAL_SOFORT_CALC_TAX_DESC', 'recalculer la somme de la taxe sur le chiffre d\'affaires');

define('MODULE_ORDER_TOTAL_SOFORT_ALLOWED_TITLE', 'Zones autorisées');
define('MODULE_ORDER_TOTAL_SOFORT_ALLOWED_DESC' , 'Veuillez indiquer <b>séparément</b> les zones, lesquelles seront autorisées pour ce module. (par exemple AT,DE (si vide toutes les zones seront autorisées))');

define('MODULE_ORDER_TOTAL_SOFORT_DISCOUNT', 'Remise');
define('MODULE_ORDER_TOTAL_SOFORT_FEE', 'Supplément');

define('MODULE_ORDER_TOTAL_SOFORT_TAX_CLASS_TITLE','Tranches d\'imposition');
define('MODULE_ORDER_TOTAL_SOFORT_TAX_CLASS_DESC','La tranche d\'imposition ne compte pas est sert seulement pour éviter un message d\'erreur.');

define('MODULE_ORDER_TOTAL_SOFORT_BREAK_TITLE','Calcul multiple');
define('MODULE_ORDER_TOTAL_SOFORT_BREAK_DESC','Est-ce que calculs multiples sont possibles? Si non, abandon après le premier rabais approprié.');
?>