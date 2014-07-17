<?php
/**
* \file menus.php
* \brief PHP drop down menu from xml file
*
* PHP version 5
*
* @category PHP
* @package Menus
* @author Jean-Michel Leyrie <jean-michel.leyrie (at) viveris.fr>
* @license http://creativecommons.org/licenses/by-nc/4.0/ CC-BY-NC
* @link http://www.viveris.fr
**/

class CMenu
{

    /** \brief Copy constructor
*
* @param [in] $i_name XML node to copy
*
* @return new instance
*/
public function CMenu($i_name)
{
    if (is_array($i_name)) {
        foreach ($i_name as $k=>$v) {
            $this->$k = $i_name[$k];
        }
    }
}

    /** \brief name accessor
*
* @return String "name"
*/
public function getName()
{
    return $this->name;
}

    /** \brief url accessor
*
* @return String "url"
*/
public function getUrl()
{
    return $this->url;
}

    /** \brief text accessor
*
* @return String "text"
*/
public function getText()
{
    return $this->text;
}

    /** \brief valid accessor
*
* @return String "valid"
*/
public function getValid()
{
    return $this->valid;
}

    /** \brief rank accessor
*
* @return String "rank"
*/
public function getRank()
{
    return $this->rank;
}

    /** \brief name anchor
*
* @return String "anchor"
*/
public function getAnchor()
{
    return $this->anchor;
}

    private $name; // Name
    private $url; // Url of the page to display
    private $text; // Text displayed in the url

    static $fsm_inFolder = 0;
    static $fsm_numDiv = 0;
}

/** \brief Read a complete XML file
*
* @param [in] $filename to read
*
* @return XML file in an array style
*/
function readDatabase($filename)
{

    // read the xml database of aminoacids
    $data = implode("", file($filename));
    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    if (xml_parse_into_struct($parser, $data, $values, $tags)==0) {
        echo xml_error_string(xml_get_error_code($parser));
        return;
    }
    xml_parser_free($parser);
    // loop through the structures
    foreach ($tags as $key=>$val) {
        if ($key == "item") {
            $molranges = $val;
            
            // each contiguous pair of array entries are the
            // lower and upper range for each molecule definition
            for ($i=0; $i < count($molranges); $i+=2) {
                $offset = $molranges[$i] + 1;
                $len = $molranges[$i + 1] - $offset;
                $tdb[] = parseMol(array_slice($values, $offset, $len));
            }

        } else {
            continue;
        }
    }
    return $tdb;
}

/** \brief Explode the contents of an array and map it in a class
*
* @param [in] $mvalues array to explode
*
* @return New CMenu instance
*/
function parseMol($mvalues)
{
    for ($i=0; $i < count($mvalues); $i++) {
        $mol[$mvalues[$i]["tag"]] = $mvalues[$i]["value"];
    }

    return new CMenu($mol);
}

/** \brief Main entry point to display entire html menu structure
*
* Display html code on standart output
*
* @param [in] $currentPage Current page displayed
* @param [in] $lang To return <text> in the right language
*
* @return none
*/
function showMenu($currentPage,$lang)
{
    $db = readDatabase("./menus.xml");
    echo "<div class=\"menu\">\n";
    echo "<ul>\n";
    $fsm_inFolder = 0;
    for ($i = 0 ; $i< count($db); $i++) {
        if ($db[$i]->getValid() == "1") {
            // if (root folder)&(not first item)&(not yet in a folder)
            if (($db[$i]->getRank() == 0)&& ($i!=0)&& ($fsm_inFolder == 0)) {
                echo "</li>\n";
            }
            
            //if (node not in root folder) and (not yet in a folder)
            //ie: first step in a folder
            if (($db[$i]->getRank() != 0) && ($fsm_inFolder == 0)) {
                $fsm_inFolder = 1;
                echo "\n<ul>\n";
            }
            
            //if (node in root folder) and (already in a folder)
            //ie: Go back to root folder
            if (($db[$i]->getRank() == 0) && ($fsm_inFolder == 1)) {
                $fsm_inFolder = 0;
                $father = "";
                echo "\n</ul>\n</li>\n";
            }
            echo "\t<li><a href=\"?page=";
            echo $db[$i]->getName();
            
            //If current node is already displayed
            if ($db[$i]->getName() == $currentPage) {
                echo "&amp;lang=$lang\" class=\"current\">";
            } else {
                echo "&amp;lang=$lang\">";
            }
            echo $db[$i]->getText();
            echo "</a>";
            if ($fsm_inFolder == 1) {
                echo "</li>";
            }
            echo "\n";
        }
    }
    if ($fsm_inFolder == 1) {
        echo "</ul>";
    }
    echo "</li>\n";
    echo "</ul>\n";
    echo "</div>\n";
}

/** \brief Include a file depending on its xml <id> field
*
* @param [in] $currentPage page id to include
*
* @return none
*/
function showPage($currentPage)
{
    $db = readDatabase("./menus.xml");

    for ($i = 0 ; $i< count($db); $i++) {
        if (($db[$i]->getName() == $currentPage) &&
            ($db[$i]->getUrl() != "")) {
            include_once $db[$i]->getUrl();
        break;
    }
}
return $db[$i];
}

/** \brief Return the text argument of a page
*
* @param [in] $page page id to get text field
*
* @return text
*/
function getPageText($page)
{
    $db = readDatabase("./menus.xml");
    $text = "";
    for ($i = 0 ; $i< count($db); $i++) {
        if ($db[$i]->getName() == $page) {
            $text = $db[$i]->getText();
            break;
        }
    }
    return $text;
}

/** \brief Main entry point to display html menu structure for tiny screens
*
* Display html code on standart output, fitting Foundation's off-canvas
* @author Nicolas Dages <contact (at) nicolas-dages.fr>
*
* @param [in] $currentPage Current page displayed
* @param [in] $lang To return <text> in the right language
*
* @return none
*/
function showTinyMenu($currentPage,$lang)
{
    $db = readDatabase("./menus.xml");
    
    echo "<nav class=\"tab-bar show-for-small\" style=\"top:5px;\">\n";
    echo "<section class=\"left-small\">\n";
    echo "<a class=\"left-off-canvas-toggle menu-icon\"><span></span></a>\n";
    echo "</section>\n";
    echo "<section class=\"middle tab-bar-section\">\n";
    echo "<h1 class=\"title\">Viveris Technologies</h1>\n";
    echo "</section>\n";
    echo "</nav>\n";
    echo "<aside class=\"left-off-canvas-menu\">\n";
    echo "<ul class=\"off-canvas-list\">\n";

    $fsm_inFolder = 0;
    $bool_label = False;
    for ($i = 0 ; $i< count($db); $i++) {
        if ($db[$i]->getValid() == "1") {

            //if (node in root folder) and (not yet in a folder)
            if (($db[$i]->getRank() == 0) && ($fsm_inFolder == 0)){
                echo "\t<li><label>";
                $bool_label = True;
            }else{
                echo "\t<li>";
            }
            echo "<a href=\"?page=";
            echo $db[$i]->getName();
            
            //If current node is already displayed
            if ($db[$i]->getName() == $currentPage) {
                echo "&amp;lang=$lang\" class=\"current\">";
            } else {
                echo "&amp;lang=$lang\">";
            }
            echo $db[$i]->getText();
            echo "</a>";
            if ($bool_label) {
                echo "</label>";
                $bool_label = False;
            }
            echo "</li>\n";
            if ($fsm_inFolder == 1) {
                echo "\n\t<li class=\"divider\"></li>\n";
            }
        }
    }
    echo "</ul>\n</aside>\n";
}

?>