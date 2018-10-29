<!-- START Creare's 'Implied Consent' EU Cookie Law Banner -->
<script>
if (navigator.cookieEnabled) {
  (function ($) {
      $.fn.cookieConsent = function(options) {
          var settings = $.extend({           
              // Number of days before the cookie expires, and the banner reappears
              cookieDuration : 30,        
              // Name of our cookie
              cookieName: 'complianceCookie',        
              // Value of cookie
              cookieValue: 'on',
              // Path of cookie
              cookiePath: '<?php echo DIR_WS_CATALOG ?>',            
              // Message banner message
              bannerMessage: "This website uses cookies. These essential cookies are used to track important logical information for the smooth operation of the site.",        
              // Message banner dismiss button
              bannerButtonText: "OK",        
              // Link to your cookie policy.
              bannerLinkURL: "cookie_policy.html",        
              // Link text
              bannerLinkText: "<b>Read more</b>",
              // Class banner
              bannerClass: "alert alert-info text-center",
              // Style banner
//               bannerStyle: "position: fixed; width: 100%; margin: 0px; left: 0px; bottom: 0px; padding: 4px; z-index: 1000; text-align: center; display: none;", // Style Box fixed bottom width 100%
              bannerStyle: "padding: 10px; z-index: 1000; border-style: solid; border-width: 1px 1px 1px 1px; position: fixed; width: 300px; min-width: 300px; max-width: 90%; left: 10px; bottom: 10px; overflow: auto; display: none;", // Style Box fixed bottom right width 300px          
              // Class banner dismiss button
              bannerButtonClass: "btn-success btn-xs",
              // Style banner dismiss button
              bannerButtonStyle: "cursor: pointer;",            
              // Class banner link
              bannerLinkClass: "contentbox",
              // Style banner link
              bannerLinkStyle: "margin-left: 8px;",                        
              // Target banner link
              bannerLinkTarget: "_blank"                      
          }, options);         
          
          function checkCookie(name) {
              var nameEQ = name + "="
              var ca = document.cookie.split(';')
              for(var i = 0; i < ca.length; i++) {
                  var c = ca[i]
                  while (c.charAt(0)==' ')
                      c = c.substring(1, c.length)
                  if (c.indexOf(nameEQ) == 0)
                      return c.substring(nameEQ.length, c.length)
              }
              return null
          };        
                  
          if (checkCookie(settings.cookieName) != settings.cookieValue) {
            $("body").append(
              '<div id="cookieChoiceInfo" class="' + settings.bannerClass + '" style="' + settings.bannerStyle + '">' +
              settings.bannerMessage +
              ' <a href="' + settings.bannerLinkURL + '" class="' + settings.bannerLinkClass + '" style="' + settings.bannerLinkStyle + '" target="' + settings.bannerLinkTarget + '">' + settings.bannerLinkText + '</a> ' +
              '<button type="button" id="cookieChoiceDismiss" class="' + settings.bannerButtonClass + '" style="' + settings.bannerButtonStyle + '">' + settings.bannerButtonText + '</button>' +            
              '</div>'
            );          
            $("#cookieChoiceInfo").slideDown();
          }     
   
          $("#cookieChoiceDismiss").on("click", function () {        
            var expires = ""
            if (settings.cookieDuration) {
                var date = new Date()
                date.setTime(date.getTime() + (settings.cookieDuration*24*60*60*1000))
                expires = "; expires=" + date.toGMTString()
            }
            document.cookie = settings.cookieName + "=" + settings.cookieValue + expires + "; path=" + settings.cookiePath;
            $("#cookieChoiceInfo").slideUp();
          });
                       
      };
  }(jQuery));
 
  $(function() {
    $(document).cookieConsent({
  <?php if ($_SESSION['language_code'] == 'de') { ?>  
      bannerMessage: "Diese Website benutzt Cookies. Diese essentiellen Cookies sind f&uuml;r den reibungslosen Betrieb dieser Website wichtig.",
      bannerLinkText: "<b>Details lesen</b>",
      bannerLinkURL: "<?php echo xtc_href_link(FILENAME_POPUP_CONTENT, 'coID=2', $request_type) ?>",
      bannerButtonText: "OK"  
  <?php } else if ($_SESSION['language_code'] == 'en') { ?>  
      bannerMessage: "This website uses cookies. These essential cookies are used to track important logical information for the smooth operation of the site.",
      bannerLinkText: "<b>Read more</b>",
      bannerLinkURL: "<?php echo xtc_href_link(FILENAME_POPUP_CONTENT, 'coID=2', $request_type) ?>",
      bannerButtonText: "OK"
  <?php } else { ?>
      bannerMessage: "This website uses cookies. These essential cookies are used to track important logical information for the smooth operation of the site.",
      bannerLinkText: "<b>Read more</b>",
      bannerLinkURL: "<?php echo xtc_href_link(FILENAME_POPUP_CONTENT, 'coID=2', $request_type) ?>",
      bannerButtonText: "OK"
  <?php } ?>
    });
  });
}
</script>
<!-- END Creare's 'Implied Consent' EU Cookie Law Banner -->