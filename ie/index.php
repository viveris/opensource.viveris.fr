<?php
/**
* File index.php
* Accueil
*
* PHP version 5
*
* @category PHP
* @package  Site
* @author   Nicolas Dages <contact@nicolas-dages.fr>
* @license  http://www.gnu.org/licenses/gpl-3.0.html GPLv3
* @link     http://www.viveris.fr
**/
    header('Content-Type: text/html;charset=UTF-8');
    require_once "./menus.php";
    
    $lang = isset($_GET['lang']) ? $_GET['lang'] : "fr";
    $page = isset($_GET['page']) ? $_GET['page'] : "about";
    $title = getPageText($page);
?><!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="Author" lang="fr" content="Viveris Technologies">
  <meta name="Description" content="Viveris Technologies Open Source Initiative">
  <meta name="Keywords" lang="fr" content="open source">
  <meta name="revisit-after" content="30">
  
  <link rel="stylesheet" href="menu_style.css" type="text/css">
  <link rel="stylesheet" title="Default" href="viveris.css" type="text/css">

  <script type="text/javascript" src="js/jquery.js"></script>
  <title><?php echo $title;?></title> 
</head>
<body>
<!-- Piwik -->
<script type="text/javascript"> 
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http")
    + "://opensource.viveris.fr/piwik//";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script')
     s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js';
    s.parentNode.insertBefore(g,s);
  })();

</script>
<noscript>
  <p>
    <img src="/piwik/piwik.php?idsite=1" style="border:0" alt="" />
  </p>
</noscript>
<!-- End Piwik Code -->


<?php

    
    echo '<div id="LogoBg"><div id="Logo"></div></div>';
    echo '<div id="PageContainer" >';
        showMenu($page, $lang);
        echo '<div class="bottomradius">';
            echo '<div id="Page" class="shadow10 bottomradius divborder">';
                echo "<br>";
                echo '<div id="colonne1">';
                    require_once "gauche.html";
                echo '</div>';
                echo '<div id="centre">';
                    showPage($page);
                echo '</div>';
                echo '<div class="spacer"></div>';
            echo '</div>';

            echo '<div id="footer"  class="shadow10 radius divborder">';
                require_once "footer.html";
            echo '</div>';
        echo '</div>';    
    echo '</div>';    
?>
<p>&nbsp;</p>

</body>
</html>

