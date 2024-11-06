<?php
get_header();

// Afficher le nom de l'équipe en tant que titre
echo '<h1 class="equipe-title">' . get_the_title() . '</h1>';

// Afficher le logo de l'équipe
$logo = get_field('logo_de_lequipe');
if ($logo && is_array($logo)) {
    echo '<div class="logo-container"><img src="' . esc_url($logo['url']) . '" alt="Logo de l\'équipe" class="logo-equipe"></div>';
} elseif ($logo && is_string($logo)) {
    echo '<div class="logo-container"><img src="' . esc_url($logo) . '" alt="Logo de l\'équipe" class="logo-equipe"></div>';
} else {
    echo '<p>Logo non défini.</p>';
}

// Titre pour les membres de l'équipe
echo '<h2 class="joueurs-title">Joueurs</h2>';

// Afficher les membres de l'équipe avec des liens vers leurs pages de profil
echo '<ul class="liste-joueurs">';

$membres = array('membres_de_lequipe1', 'membres_de_lequipe2', 'membres_de_lequipe3', 'membres_de_lequipe4', 'membres_de_lequipe5');

foreach ($membres as $membre) {
    $joueur = get_field($membre);
    if ($joueur) {
        // Récupérer l'avatar du joueur
        $photo = get_field('photo_de_profil', 'user_' . $joueur['ID']);
        
        echo '<li class="joueur-item">';
        echo '<a href="' . esc_url(get_author_posts_url($joueur['ID'])) . '">';
        
        if ($photo) {
            echo '<img src="' . esc_url($photo['url']) . '" alt="Photo de ' . esc_attr($joueur['display_name']) . '" class="photo-joueur">';
        }
        
        echo '<span class="joueur-name">' . esc_html($joueur['display_name']) . '</span>';
        echo '</a>';
        echo '</li>';
    } else {
        echo '<li class="joueur-item joueur-non-defini">Membre non défini</li>';
    }
}

echo '</ul>';

get_footer();
?>

