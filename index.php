<?php header('Content-Type: text/html;charset=UTF-8');
    require_once("./menus.php");
    
    $lang = isset($_GET['lang']) ? $_GET['lang'] : "fr";
    $page = isset($_GET['page']) ? $_GET['page'] : "about";
    $title = getPageText($page);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="Author" lang="fr" content="Viveris Technologies">
  <meta name="Description" content="Viveris Technologies Open Source Initiative">
  <meta name="Keywords" lang="fr" content="open source">
  <meta name="revisit-after" content="30">
  <meta name="Publisher" content="Viveris Technologies">
  <meta name="Copyright" content="Viveris Technologies">
  <meta http-equiv="content-style-type" content="text/css">
  
  <link rel="stylesheet" href="menu_style.css" type="text/css" media="screen">
  <link rel="stylesheet" title="Default" href="viveris.css" type="text/css" media="screen">

  <title><?php echo $title;?></title> 
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


<?php

    
    echo '<div id="LogoBg"><div id="Logo"></div></div>';
    echo '<div id="PageContainer" >';
        showMenu($page,$lang);
        echo '<div class="bottomradius">';
            echo '<div id="Page" class="shadow10 bottomradius divborder">';
                echo "<br>";
                echo '<div id="colonne1">';
                    require_once("gauche.php");
                echo '</div>';
                echo '<div id="centre">';
                    showPage($page);
                echo '</div>';
                echo '<div class="spacer"></div>';
            echo '</div>';

            echo '<div id="footer"  class="shadow10 radius divborder">';
                require_once ("footer.php");
            echo '</div>';
        echo '</div>';    
    echo '</div>';    
?>
<p>&nbsp;</p>

</body>
</html>

