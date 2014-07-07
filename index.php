
<?php header('Content-Type: text/html;charset=UTF-8');
require_once("./menus.php");
$lang = isset($_GET['lang']) ? $_GET['lang'] : "fr";
$page = isset($_GET['page']) ? $_GET['page'] : "about";
$title = getPageText($page);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <meta name="Author" lang="fr" content="Viveris Technologies">
  <meta name="Description" content="Viveris Technologies Open Source Initiative">
  <meta name="Keywords" lang="fr" content="open source">
  <meta name="revisit-after" content="30">
  <meta name="Publisher" content="Viveris Technologies">
  <meta name="Copyright" content="Viveris Technologies">
  <meta http-equiv="content-style-type" content="text/css">

  <link rel="stylesheet" href="css/foundation.css" />
  <link rel="stylesheet" href="css/viveris.css" />
  <script src="js/vendor/modernizr.js"></script>
  <script src="js/vendor/jquery.js"></script>
  <script src="js/foundation.min.js"></script>

  <title><?php echo $title; ?></title> 
</head>
<body>
  <!-- Piwik -->
  <script type="text/javascript"> 
    var _paq = _paq || [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
      var u=(("https:" == document.location.protocol) ? "https" : "http") + "://opensource.viveris.fr/piwik//";
      _paq.push(['setTrackerUrl', u+'piwik.php']);
      _paq.push(['setSiteId', 1]);
      var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
      g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
  </script>
  <noscript><p><img src="http://opensource.viveris.fr/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
  <!-- End Piwik Code -->

  <div class="row full-width" style="background:black;" >
    <strong class="show-for-medium-up">
      <img id="Logo" src="./images/logo.png" alt="Viveris" style="width:100%" />
    </strong>
    <strong class="show-for-small-only">
      <img id="Logo" src="./images/logo-small.png" alt="Viveris" style="width:100%" />
    </strong>
  </div>

  <div id="full-width content-area" >
    <div class="row">

      <div class="off-canvas-wrap docs-wrap " data-offcanvas="">

        <div class="inner-wrap">
        <?php
          showLargeMenu($page,$lang);
          showTinyMenu($page,$lang);
        ?>
          <section class="main-section shadow10">
            <div class="row">
              <div class="columns large-3 hide-for-small">
                <?php require_once("gauche.php"); ?>
              </div>
              <div class="columns large-9">
                <?php showPage($page); ?>
              </div>
            </div>
          </section>

          <a class="exit-off-canvas"></a>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="columns large-12" id="footer">
        <?php require_once ("footer.php"); ?>
      </div>
    </div>

    <p>&nbsp;</p>
  </div>

  <script>
    $(document).foundation();
  </script>
</body>
</html>
