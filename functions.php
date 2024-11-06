<?php

function vdt2024_enqueue_styles() {
    wp_enqueue_style('vdt-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'vdt2024_enqueue_styles');

function vdt2024_setup() {
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'vdt2024'),
    ));
}
add_action('after_setup_theme', 'vdt2024_setup');

function ajouter_role_joueur() {
    add_role(
        'joueur',
        'Joueur',
        array(
            'read' => true, // Permet de lire le contenu du site
            'edit_posts' => false, // N'autorise pas à éditer des articles
            'delete_posts' => false, // N'autorise pas à supprimer des articles
        )
    );
}
add_action('init', 'ajouter_role_joueur');

function restrict_admin_menu_for_non_admins() {
    if (!current_user_can('administrator')) {
        // Masquer le menu des articles
        remove_menu_page('edit.php');
        
        // Masquer le menu des commentaires
        remove_menu_page('edit-comments.php');
        
        // Masquer le menu des outils
        remove_menu_page('tools.php');
        
        // Masquer le tableau de bord
        remove_menu_page('index.php');
        
        // Masquer le type de publication "Matchs" (si nécessaire)
        remove_menu_page('edit.php?post_type=matchs'); // Remplace 'matchs' par le slug exact si nécessaire
    }
}
add_action('admin_menu', 'restrict_admin_menu_for_non_admins', 999);

function register_my_menus() {
    register_nav_menus(array(
        'main-menu' => __('Main Menu'),
    ));
}
add_action('init', 'register_my_menus');

// Rediriger l'utilisateur vers la page d'accueil après la déconnexion
add_action('wp_logout', function() {
    wp_redirect(home_url());
    exit;
});