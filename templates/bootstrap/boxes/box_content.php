{config_load file="$language/lang_$language.conf" section="boxes"}
<div class="boxbody">
    <div class="span3">
        <span class="categoryheader">Informationen</span>
        {foreach from=$BOX_CONTENT item=aktuelle_id}
        <ul class="footer-navigation">
            {foreach from=$aktuelle_id item=item}
            <li>{$item}</li>
            {/foreach}
        </ul>
        {/foreach}
    </div>
    <div class="span3 nomobile">
        <span class="categoryheader">Hilfeseiten</span>
        <ul class="footer-navigation">
            <li><a href="http://fensterdichtungen.org/shop_content.php?coID=12" style="padding-left: 0; padding-right: 0;">Montage</a></li>
            <li><a href="http://fensterdichtungen.org/shop_content.php?coID=13" style="padding-left: 0; padding-right: 0;">Drei-Wege Anleitung</a></li>
            <li><a href="http://fensterdichtungen.org/shop_content.php?coID=21" style="padding-left: 0; padding-right: 0;">Kaufanleitung</a></li>
            <li><a href="http://fensterdichtungen.org/shop_content.php?coID=18" style="padding-left: 0; padding-right: 0;">Dichtungspflege</a></li>
            <li><a href="http://fensterdichtungen.org/shop_content.php?coID=19" style="padding-left: 0; padding-right: 0;">Austauschen</a></li>
            <li><a href="http://fensterdichtungen.org/shop_content.php?coID=22" style="padding-left: 0; padding-right: 0;">Fenster undicht</a></li>
            <li><a href="http://fensterdichtungen.org/shop_content.php?coID=25" style="padding-left: 0; padding-right: 0;">Fenster abdichten</a></li>
            <li><a href="http://fensterdichtungen.org/shop_content.php?coID=14" style="padding-left: 0; padding-right: 0;">Dichtungsvergleich</a></li>
        </ul>
    </div>
    <div class="span3">
        <span class="categoryheader">Sicher bezahlen mit...</span>
        <a href="shop_content.php?coID=4"><img class="img-responsive" src="{$tpl_path}img/payments/bezahlungsarten.png" alt="Beahlungsarten"/></a>
        <span class="categoryheader">Sie finden uns auch bei</span>
        <a target="_blank" href="https://www.facebook.com/fensterdichtungen.org/"><img class="img-responsive" src="{$tpl_path}/img/facebook.png" alt="Facebook"/></a>
        <a target="_blank" href="https://plus.google.com/104836272234517912144/"><img class="img-responsive" src="{$tpl_path}/img/google+.png" alt="Google+"/></a>
    </div>
    <div class="span3">
        <span class="categoryheader">Geprüfter und zertifizierter Shop</span>

        <div class="trusted">
            <div class="span12">
                <div style="float: left;" class="span3">
                    <a class="no-deco" href="https://www.trustedshops.de/shop/certificate.php?shop_id=X65176769964A25851EED3C91B1CEAE3C" target="_blank">
                        <img class="img-responsive" alt="trusted_shops_medium_sign" src="{$tpl_path}/img/trusted_shops.png">
                    </a>
                </div>
                <span style="color: white" class="span8">
                    Als geprüfter und zertifizierter Onlineshop von Trusted Shops genießen Sie den Käuferschutz den Sie brauchen.
                </span>
            </div>

            <div class="span12">
                <div style="color: white; text-align: left;">
                    Händlerbewertungen von Trusted Shops : 4.92 / 5.00 bei 572 Fensterdichtungen.org Bewertungen.
                </div>
            </div>
        </div>
    </div>
</div>

<!--{$BOX_CONTENT}-->