<?PHP
/*
Plugin Name: Cathopedia
Plugin URI: http://wordpress.org/extend/plugins/cathopedia/
            http://it.cathopedia.org/wiki/Wordpress
Description: Crea un collegamento alla voce di Cathopedia dove trova la sintassi [[parola]] o [[link|parola]]
Author: Paolo Benvenuto <paolobenve@gmail.com>
        Cristiano Fino <info@cristianofino.net> developped the original code for wikipedia
Version: 1.3
Author URI: http://it.cathopedia.org/wiki/Utente:Don_Paolo_Benvenuto
License: GPL2
*/

/* 
  Copyleft 2010 Paolo Benvenuto (email: paolobenve@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/


/* Adding plugin if not already exists function */ 

if (function_exists('cf_cathoterms')) 
{
    add_filter('the_content', 'cf_cathoterms');

    /* Adding parameters */
    add_option('cf_cathoterms_link', '1', 'attiva i collegamenti a cathopedia');
    add_option('cf_cathoterms_icon', '0', 'mette il collegamento nel termine (0) o aggiungendo una icona (1)');
    add_option('cf_cathoterms_culture', substr(constant('WPLANG'), 0, 2), 'lingua di cathopedia');
    add_option('cf_cathoterms_style', '1', 'controllo che attiva la formattazione dei termini di cathopedia');
    add_option('cf_cathoterms_rel','0','attiva o disattiva rel=nofollow nel collegamento');

    /* Adding menu and parameters page */
    add_action('admin_menu', 'cf_cathoterms_admin_menu');
    
    /* Loading text domain */
    load_plugin_textdomain('cf_cathopedia', PLUGINDIR.'/'.dirname(plugin_basename(__FILE__)).'/languages', dirname(plugin_basename(__FILE__)).'/languages');
}


/* Adding parameters page */

function cf_cathoterms_admin_menu()
{
    add_submenu_page('plugins.php', 'Opzioni del plugin di Cathopedia', 'Cathopedia', 5, basename(__FILE__),'cf_cathoterms_options_page'); 
}


/* Options page */

function cf_cathoterms_options_page() {

    $hidden_field_name = 'mt_submit_hidden';
    
    $opt_name_link = 'cf_cathoterms_link';
    $opt_name_icon = 'cf_cathoterms_icon';
    $opt_name_culture = 'cf_cathoterms_culture';
    $opt_name_style = 'cf_cathoterms_style';
    $opt_name_rel = 'cf_cathoterms_rel';

    
    $data_field_name_link = 'cf_cathoterms_link';
    $data_field_name_icon = 'cf_cathoterms_icon';
    $data_field_name_culture = 'cf_cathoterms_culture';
    $data_field_name_style = 'cf_cathoterms_style';
    $data_field_name_rel = 'cf_cathoterms_rel';

    // Read in existing option value from database
    $opt_val_link = get_option($opt_name_link);
    $opt_val_icon = get_option($opt_name_icon);
    $opt_val_culture = get_option($opt_name_culture);
    $opt_val_style = get_option($opt_name_style);
    $opt_val_rel = get_option($opt_name_rel);

    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        $opt_val_link = $_POST[$data_field_name_link];
        $opt_val_icon = $_POST[$data_field_name_icon];
        $opt_val_culture = $_POST[$data_field_name_culture];
        $opt_val_style = $_POST[$data_field_name_style];
        $opt_val_rel = $_POST[$data_field_name_rel];
        
        update_option($opt_name_link, $opt_val_link);
        update_option($opt_name_icon, $opt_val_icon);
        update_option($opt_name_culture, substr($opt_val_culture, 0, 2));
        update_option($opt_name_style, $opt_val_style);
        update_option($opt_name_rel, $opt_val_rel);     
        
?>
    <div id="message" class="updated fade"><p><strong><?php _e('Opzione salvata.', 'cf_cathopedia' ); ?></strong></p></div>

<?php
    }
    echo '<div class="wrap">';
    echo "<h2>" . __( 'Opzioni del Plugin Cathopedia', 'cf_cathopedia' ) . "</h2>";
    ?>

    <form name="form_Wikiterm_Options" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
    <p style="padding-left:25px">   
    <table>
    <tr style="vertical-align: middle; height: 40px">
        <td><?php _e("Lingua di Cathopedia:", 'cf_cathopedia' ); ?></td>
        <td><input type="text" name="<?php echo $data_field_name_culture; ?>" value="<?php echo $opt_val_culture; ?>" size="2"></td>
    </tr>
    <tr style="vertical-align: middle; height: 40px"">
        <td><?php _e("Attiva i collegamenti a Cathopedia:", 'cf_cathopedia' ); ?></td>
        <td>
            <select name="<?php echo $data_field_name_link; ?>">
                <option value="0" <?php if($opt_val_link == "0") echo 'selected' ?> ><?php _e("No", 'cf_cathopedia' ); ?></option> 
                <option value="1" <?php if($opt_val_link == "1") echo 'selected' ?> ><?php _e("Sì", 'cf_cathopedia' ); ?> </option>
            </select>
        </td>
    </tr>
    <tr style="vertical-align: middle; height: 40px"">
        <td><?php _e("Pone il collegamento in un'icona:", 'cf_cathopedia' ); ?></td>
        <td>
            <select name="<?php echo $data_field_name_icon; ?>">
                <option value="0" <?php if($opt_val_icon == "0") echo 'selected' ?> ><?php _e("No", 'cf_cathopedia' ); ?></option> 
                <option value="1" <?php if($opt_val_icon == "1") echo 'selected' ?> ><?php _e("Sì", 'cf_cathopedia' ); ?> </option>
            </select>
        </td>
    </tr>
    <tr style="vertical-align: middle; height: 40px"">
        <td><?php _e("Usa lo stile CSS standard:", 'cf_cathopedia' ); ?></td>
        <td>
            <select name="<?php echo $data_field_name_style; ?>">
                <option value="0" <?php if($opt_val_style == "0") echo 'selected' ?> ><?php _e("No", 'cf_cathopedia' ); ?></option> 
                <option value="1" <?php if($opt_val_style == "1") echo 'selected' ?> ><?php _e("Sì", 'cf_cathopedia' ); ?></option> 
            </select>
        </td>
    </tr>
    <tr style="vertical-align: middle; height: 40px"">
        <td><?php _e("Abilita il NOFOLLOW nel collegamento:", 'cf_cathopedia' ); ?></td>
        <td>
            <select name="<?php echo $data_field_name_rel; ?>">
                <option value="0" <?php if($opt_val_rel == "0") echo 'selected' ?> ><?php _e("No", 'cf_cathopedia' ); ?></option> 
                <option value="1" <?php if($opt_val_rel == "1") echo 'selected' ?> ><?php _e("Sì", 'cf_cathopedia' ); ?></option> 
            </select>
        </td>
    </tr>
    </table>
    </p>
    <p class="submit">
    <input type="submit" name="Submit" value="<?php _e('Update Options', 'cf_cathopedia' ) ?>" />
    </p>
    </form>
    </div>

<?php
}

/* Core function of Cathopedia filter */

function cf_cathoterms($body = '')
{
    if (!strpos($body,"[[")) return $body;

    /* Style definitions */
    $cf_cathoterm = "padding-bottom: 2px; border-bottom: 1px dotted #DD0000";
    $cf_cathoicon = "font-family: Georgia, Times New Roman, Serif; font-weight: bold; color: #AAAAAA";

    /* Apply direct style ? */
    if (intval(get_option('cf_cathoterms_style')) == 1) 
    {
        $css_class_term = "style=\"" . $cf_cathoterm . "\"";
        $css_class_icon = "style=\"" . $cf_cathoicon . "\"";
    }
    else {
            $css_class_term = "class=\"cathoterm\"";
            $css_class_icon = "class=\"cathoicon\"";
         }
    
    /* loading parameters */
    $cathoLink = intval(get_option('cf_cathoterms_link'));
    $cathoIcon = intval(get_option('cf_cathoterms_icon'));
    $culture = strtolower(get_option('cf_cathoterms_culture'));
    $relnofollow = ((intval(get_option('cf_cathoterms_rel')) == 1) ? " rel=\"nofollow\"" : '');
    $ref = '?pk_campaign=WordpressPlugin&pk_kwd=' . $_SERVER['SERVER_NAME'] . ' ';
  
    /* if exists, set the cathoicon switch */ 
    if (stripos($body,"[cathoicon]") !== false)
    {
        $cathoIcon = 1;
        $body = str_ireplace("[cathoicon]", "", $body);
    }
    
    if (preg_match_all("@\[\[(.*?)\]\]@", $body, $Matches) > 0)
    {
        foreach ($Matches[1] as $pos => $Match)
        {
            $cathoTerm = trim($Match);                   
            $posizione_barra = strpos($Match, '|');
            if ($posizione_barra === FALSE)
            {
                $voce = $cathoTerm;
                $testo = $cathoTerm;
            }
            else
            {
                $voce = substr($cathoTerm, 0, $posizione_barra);
                $testo = substr($cathoTerm,
                                - (strlen($cathoTerm) - $posizione_barra - 1));
            }
            $collegamento = ucfirst($voce);
            $titolo = "Cathopedia:" . $collegamento;
            $collegamento = rawurlencode($collegamento);

            if ($cathoLink == 1) 
                if ($cathoIcon == 0) 
                    $link = "<a href=\"http://" . $culture . ".cathopedia.org/wiki/" . $collegamento . $ref . $collegamento . "\"" . $relnofollow . "
                                target=\"_blank\" title=\"" . $titolo . "\" " . $css_class_term . " >" . $testo . "</a>";
                else
                    $link = "<span " . $css_class_term . " >" . $testo . "</span>" . 
                            "<a href=\"http://" . $culture . ".cathopedia.org/wiki/" . $collegamento . $ref . $collegamento . "\"" . $relnofollow . "
                                    target=\"_blank\" title=\"" . $titolo . "\" " . $css_class_term . " >
                            <img src='" . WP_PLUGIN_URL . "/" . dirname(plugin_basename(__FILE__)) . "/SanPietro_12.png' /></a>";
            else $link = $testo;
            
            if (strpos($Matches[0][$pos], ":0]]") == (strlen($Matches[0][$pos]) - 4))
                $body = str_replace($Matches[0][$pos], str_replace(":0]]", "]]", $Matches[0][$pos]), $body); 
            else
                $body = str_replace($Matches[0][$pos], $link, $body);
        }
    }
    return $body;   
}

?>
