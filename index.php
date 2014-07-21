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
  <meta name="Author" lang="fr" content="Viveris Technologies" />
  <meta name="Description" content="Viveris Technologies Open Source Initiative" />
  <meta name="Keywords" lang="fr" content="open source" />
  <meta name="revisit-after" content="30" />
  <!-- Copyright Viveris Technologies 2014 - All rights reserved -->
  <link rel="stylesheet" type="text/css" href="css/foundation.css" />
  <link rel="stylesheet" type="text/css" href="css/viveris.css" />
  <link rel="stylesheet" type="text/css" href="css/menu_style.css">
  <!--[if lte IE 9]>
    <meta HTTP-EQUIV="REFRESH" content="0; url=./old/">
    <script type="text/javascript">
      window.location = "./old/";
    </script>
  <![endif]-->
  <script type="text/javascript" src="js/vendor/modernizr.js"></script>
  <script type="text/javascript" src="js/vendor/jquery.js"></script>
  <script type="text/javascript" src="js/foundation.min.js"></script>

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
      <span id="Logo"></span>
    </strong>
    <strong class="show-for-small-only">
      <img src="./images/logo-small.png" alt="Viveris" style="width:100%" />
    </strong>
  </div>

  <div id="content-area" class="row shadow10" style="background-color:#fff;">

    <div class="off-canvas-wrap docs-wrap " data-offcanvas="">

      <div class="inner-wrap">
        <?php showTinyMenu($page,$lang); ?>
        <section class="main-section shadow10">
          <div class="row full-width hide-for-small" style="margin-top:-6px;">
            <?php showMenu($page,$lang); ?>
          </div>
          <div class="row">
            <div class="columns large-2 hide-for-small" style="text-align:center">
              <?php include("gauche.php"); ?>
            </div>
            <div class="columns large-9 text-justify">
              <?php showPage($page); ?>
            </div>
            <div class="columns large-1"></div>
          </div>
        </section>

        <a class="exit-off-canvas"></a>
      </div>

    </div>
  </div>

  <div class="row">
    <div class="columns large-12 shadow10" id="footer">
      <?php require_once ("footer.php"); ?>
    </div>
  </div>
  <p>&nbsp;</p>

  <script>
    $(document).foundation();
  </script>
</body>
</html>
