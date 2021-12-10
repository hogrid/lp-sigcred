<?php 
add_theme_support('menus');
register_nav_menu('menu-topo','Menu Topo');
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

// Register Custom Navigation Walker
require_once('assets/wp_bootstrap_navwalker.php');

// THUMBNAILS SIZE
add_image_size( '360x260', 360, 260, true );

// function remove_menus () {
//   global $menu;
//   $restricted = array(__('Posts'), __('Media'), __('Dashboard'), __('Comments'), __('Appearance'), __('Users'), __('Tools'), __('Plugins'), __('Settings')); end ($menu); while (prev($menu)){ $value = explode(' ',$menu[key($menu)][0]); if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);} }
// }
// add_action('admin_menu', 'remove_menus');
// REMOVE ITEMS DA BARRA DE ADMIN
// function wps_admin_bar() {
//     global $wp_admin_bar;
//     $wp_admin_bar->remove_menu('wp-logo');
//     $wp_admin_bar->remove_menu('site-name');
//     $wp_admin_bar->remove_menu('updates');
//     $wp_admin_bar->remove_menu('comments');
//     $wp_admin_bar->remove_menu('new-content');
// }
// add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );


// DESABILITA BOTÃO DE AJUDA NO TOPO DO PAINEL
// function hide_help() {
//     echo '<style type="text/css">
//             #contextual-help-link-wrap { display: none !important; }
// </style>';
// }
// add_action('admin_head', 'hide_help');


// REMOVER VERSÃO DO WORDPRESS DO RODAPÉ
// function change_footer_version() {
//   return '';
// }
// add_filter( 'update_footer', 'change_footer_version', 9999 );

// CUSTOMIZAR O FOOTER DO WORDPRESS
// function remove_footer_admin () {
// echo '© Desenvolvido por <a href="http://ifwebs.com/" target="_blank">Ifwebs</a>';
// }
// add_filter('admin_footer_text', 'remove_footer_admin');


/* TRELLO */

add_action('wpcf7_submit', 'action_sent_form_function', 10, 2);
 
function action_sent_form_function($contact_form, $result){
    $boardid='569e3894329b68a49b666dba';
    $listid='569e669a207af91492922bcf';
    $apiKey='1baf60275a125a33355df5ccce5f8f2d';
    $token='4aa336740ea5020353e1fd1f77737cf8678d89d0bc68723c2b11bab70e209643';
 
    $formid=$contact_form->id;    
    $submission = WPCF7_Submission::get_instance();
  
    if ($submission){
        $posted_data = $submission->get_posted_data(); 
        
        if($formid == 5203){
            $name = "Lead Modo 3D: ".$posted_data['your-name']."\n\n";
            $desc = "Lead Modo 3D.\n\n";
            $desc .= "Nome: ".$posted_data['your-name'].".\n\n";
            $desc .= "E-mail: ".$posted_data['your-email'].".\n\n";
            $desc .= "Telefone: ".$posted_data['your-phone'].".\n\n";
            add_to_trello($name,$desc,$listid,$boardid,$apiKey,$token);
        }elseif($formid == 5450){
            $name = "Lead Illustrator CC: ".$posted_data['your-name']."\n\n";
            $desc = "Lead Illustrator CC.\n\n";
            $desc .= "Nome: ".$posted_data['your-name'].".\n\n";
            $desc .= "E-mail: ".$posted_data['your-email'].".\n\n";
            $desc .= "Telefone: ".$posted_data['your-phone'].".\n\n";
            add_to_trello($name,$desc,$listid,$boardid,$apiKey,$token);
        }elseif($formid == 5222){
            $name = "Lead Ilustração Digital: ".$posted_data['your-name']."\n\n";
            $desc = "Lead Ilustração Digital.\n\n";
            $desc .= "Nome: ".$posted_data['your-name'].".\n\n";
            $desc .= "E-mail: ".$posted_data['your-email'].".\n\n";
            $desc .= "Telefone: ".$posted_data['your-phone'].".\n\n";
            add_to_trello($name,$desc,$listid,$boardid,$apiKey,$token);
        }elseif($formid == 5438){
            $name = "Lead Photoshop CC: ".$posted_data['your-name']."\n\n";
            $desc = "Lead Photoshop CC.\n\n";
            $desc .= "Nome: ".$posted_data['your-name'].".\n\n";
            $desc .= "E-mail: ".$posted_data['your-email'].".\n\n";
            $desc .= "Telefone: ".$posted_data['your-phone'].".\n\n";
            add_to_trello($name,$desc,$listid,$boardid,$apiKey,$token);
        }elseif($formid == 5440){
            $name = "Lead Indesign CC: ".$posted_data['your-name']."\n\n";
            $desc = "Lead Indesign CC.\n\n";
            $desc .= "Nome: ".$posted_data['your-name'].".\n\n";
            $desc .= "E-mail: ".$posted_data['your-email'].".\n\n";
            $desc .= "Telefone: ".$posted_data['your-phone'].".\n\n";
            add_to_trello($name,$desc,$listid,$boardid,$apiKey,$token);
        }        
    }    
}
 
function add_to_trello($name,$desc,$listid,$boardid,$apiKey,$token){
    $url = 'https://api.trello.com/1/cards';
    $fields='token='.$token;
    $fields.='&key='.$apiKey;
    $fields.='&idList='.$listid;
    $fields.='&name='.$name;
    $fields.='&desc='.$desc;  
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    curl_setopt($ch, CURLOPT_HEADER, 0);    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $output = curl_exec($ch);
    $request = curl_getinfo($ch, CURLINFO_HEADER_OUT);
    $error = curl_error($ch);
    curl_close($ch);
    
    return json_decode($output);
}

?>