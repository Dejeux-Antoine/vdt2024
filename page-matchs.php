<?php
/* Template Name: Matchs */
get_header();

// Récupérer tous les matchs
$matchs = new WP_Query(array(
    'post_type' => 'matchs',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'ASC'
));

if ($matchs->have_posts()) {
    echo '<h1 class="titre-page">Matchs</h1>';
    echo '<ul class="liste-matchs">';
    while ($matchs->have_posts()) {
        $matchs->the_post();

        // Récupérer les champs pour les équipes et le score
        $equipe_a = get_field('equipe_a');
        $equipe_b = get_field('equipe_b');
        $score_a = get_field('score_equipe_a');
        $score_b = get_field('score_equipe_b');
        $statut = get_field('statut_');
        $date_match = get_the_date('l j F'); // Format de la date

        echo '<li class="match">';
        echo '<p class="date-match">' . esc_html($date_match) . '</p>';

        // Afficher le statut du match
        if ($statut) {
            echo '<p class="statut-match">' . esc_html($statut) . '</p>';
        }

        echo '<div class="contenu-match">';

        // Afficher Équipe A avec son logo
        if ($equipe_a && is_array($equipe_a) && isset($equipe_a[0])) {
            $logo_a = get_field('logo_de_lequipe', $equipe_a[0]->ID);
            echo '<div class="equipe">';
            if ($logo_a) {
                echo '<img src="' . esc_url($logo_a['url']) . '" alt="Logo de ' . esc_attr($equipe_a[0]->post_title) . '" class="logo-equipe">';
            }
            echo '<span class="nom-equipe">' . esc_html($equipe_a[0]->post_title) . '</span>';
            echo '</div>';
        }

        // Afficher le score
        if ($score_a !== null && $score_b !== null) {
            echo '<div class="score">';
            echo '<span>' . esc_html($score_a) . '</span>';
            echo '<span> / </span>';
            echo '<span>' . esc_html($score_b) . '</span>';
            echo '</div>';
        } else {
            echo '<div class="score"><span>/</span></div>';
        }

        // Afficher Équipe B avec son logo
        if ($equipe_b && is_array($equipe_b) && isset($equipe_b[0])) {
            $logo_b = get_field('logo_de_lequipe', $equipe_b[0]->ID);
            echo '<div class="equipe">';
            if ($logo_b) {
                echo '<img src="' . esc_url($logo_b['url']) . '" alt="Logo de ' . esc_attr($equipe_b[0]->post_title) . '" class="logo-equipe">';
            }
            echo '<span class="nom-equipe">' . esc_html($equipe_b[0]->post_title) . '</span>';
            echo '</div>';
        }

        echo '</div>'; // Fin du contenu du match
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>Aucun match trouvé.</p>';
}

wp_reset_postdata();
get_footer();
?>

