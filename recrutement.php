<?php
/**
* File recrutement.php
* PHP pour la partie emplois du site
*
* PHP version 5
*
* @category PHP
* @package  Site
* @author   Nicolas Dages <contact@nicolas-dages.fr>
* @license  http://www.gnu.org/licenses/gpl-3.0.html GPLv3
* @link     http://www.viveris.fr
**/
require "./adm_emploi/bdd.php";

/**
* Génère un affichage individuel pour une offre
* @param [in] $titre        Titre
* @param [in] $type         Type
* @param [in] $description  Description
* @param [in] $agence       Agence
* @param [in] $dateCreation Date de création
* @param [in] $id ID de l'offre
* @return Rien 
**/
function affOffre($titre, $type, $description, $agence, $dateCreation, $id)
{
    echo '<div class="large-12 offre '.$agence.' '.$type.'">'."\n";
    echo '<div class="row entete">';
    echo '<span class="columns large-2 medium-2 small-12 type">'.$type.'</span>';
    echo '<span class="columns large-7 medium-7 small-12 titre">'.$titre.'</span>';
    echo '<span class="columns large-3 medium-3 small-12 agence">'.$agence.'</span>';
    echo '</div>'."\n";
    "\n";
    echo '<div class="row annonce">'."\n";
    echo $description."\n";
    echo '<p class="datePublication"><b>Mise en ligne le</b> '.$dateCreation.'</p>'."\n";
    echo '<p class="reference"><b>Référence</b> : '.$agence.'-'.$id.'</p>'."\n";
    echo '<div style="width:100%;text-align:center;">';
    echo '<input type="button" class="postuler" value="Postuler" ';
    echo 'onclick="location.href=\'mailto:candidature_vt@viveris.fr?';
    echo 'subject=OpenSource%20:%20Candidature%20offre%20'.$agence.'-'.$id.'\';"';
    echo '/></div>'."\n";
    echo '<img class="icon reduire" src="/images/reduce.png" alt="Réduire" />'."\n";
    echo '</div>'."\n".'</div>'."\n";
}

/**
* Récupère la liste des offres, et appelle la fonction d'affichage
* @return Rien
**/
function afficherOffres()
{
    $sql = "SELECT titre,type,description,agence,DATE_FORMAT(date_creation,
        GET_FORMAT(DATE, 'EUR')),id 
        FROM `offres`
        WHERE `publier` != 0
        ORDER BY date_creation ASC";
    $reponse = mysql_query($sql);
    while ($tab = mysql_fetch_array($reponse)) {
        affOffre($tab[0], $tab[1], $tab[2], $tab[3], $tab[4], $tab[5]);
    }
}

/**
* Factorisation de code, utilisé dans la fonction genFiltres
* @param [in] $filtre Filtre
* @return Rien 
**/
function listGenFiltres($filtre)
{
    echo'<div class="large-12 medium-12 small-12">';
    echo '<p>'.$filtre.'</p><ul id="filtre_'.$filtre.'">'."\n";
    $sql = "SELECT DISTINCT ".$filtre." FROM `offres` WHERE `publier` != 0";
    $reponse = mysql_query($sql);
    while ($tab = mysql_fetch_array($reponse)) {
        echo '<li><label><input type="checkbox" value="'.$tab[0];
        echo '" name="'.$tab[0].'" class="cb cb_'.$filtre.'"/>'.$tab[0];
        echo '</label></li>'."\n";
    }
    echo'</ul>'."\n".'</div>'."\n";
}

/**
* Génère les filtres adéquats pour type et agence
* @return Rien 
**/
function genFiltres()
{
    listGenFiltres("Type");
    listGenFiltres("Agence");
}

?>


<div id="filtres">
    <h2>Filtres de recherche</h2>
    <?php genFiltres(); ?>
</div>
<hr/>
<?php afficherOffres(); ?>


<script>
    $(".annonce").hide();

    $(".entete").click(function(){
        $(this).parent().children(".annonce").toggle(500);
    });

    $(".reduire").click(function(){
        $(this).parent().hide(500);
    });

    var sections = $('.offre');
    function updateContentVisibility(){
        var types = $(".cb_Type:checked").map(function(){
            return $(this).val();
        }).get();
        var agences = $(".cb_Agence:checked").map(function(){
            return $(this).val();
        }).get();

        if ((types.length === 0) && (agences.length === 0)){//Si aucune spec
            $(".offre").show();
        } else {
            $(".offre").hide();
            $(".offre").each(function(){
                var classes = $(this).attr('class').split(' ');
                if (types.length === 0){ //Si aucune spec sur le type
                    if ($.inArray(classes[2],agences) >= 0){
                        $(this).show();
                    }
                } else if (agences.length === 0){//Si aucune spec sur agence
                    if ($.inArray(classes[3],types) >= 0){
                        $(this).show();
                    } 
                } else {//Si deux spec
                    if (($.inArray(classes[2],agences) >= 0)
                        && ($.inArray(classes[3],types) >= 0)
                        ){
                        $(this).show();
                    }
                }
            });
        }
    }
    $(".cb").click(updateContentVisibility);
    updateContentVisibility();
</script>