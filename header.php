<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="header-top">
        <div class="header-logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Logo" class="logo-image">
            </a>
        </div>

        <div class="header-title">
            <h1>VDT 2024</h1>
        </div>

        <div class="header-user">
            <?php if (is_user_logged_in()) : ?>
                <?php 
                    $current_user_id = get_current_user_id();
                    $user_photo = get_field('photo_de_profil', 'user_' . $current_user_id);
                    $user_pseudo = get_field('pseudo_en_jeu', 'user_' . $current_user_id);
                ?>
                <a href="<?php echo site_url('/mon-profil/'); ?>"> <!-- Lien vers la page de profil -->
                    <?php if ($user_photo) : ?>
                        <img src="<?php echo esc_url($user_photo['url']); ?>" alt="Photo de profil" class="user-avatar">
                    <?php endif; ?>
                    <span class="user-name"><?php echo esc_html($user_pseudo); ?></span>
                </a>
            <?php else : ?>
                <a href="<?php echo site_url('/connexion-inscription/'); ?>">Connexion</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Menu principal -->
    <nav class="main-menu">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'main-menu',
            'container' => 'ul',
            'menu_class' => 'menu',
        ));
        ?>
    </nav>
</header>
