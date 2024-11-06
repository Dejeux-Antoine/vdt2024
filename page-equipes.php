<?php
/* Template Name: Équipes */
get_header();

// Bouton pour accéder à la création d'une nouvelle équipe dans le back-office
if (is_user_logged_in() && current_user_can('edit_posts')) : ?>
    <p>
        <a href="<?php echo admin_url('edit.php?post_type=equipes'); ?>" class="button-creer-equipe">+ Créer son équipe</a>
    </p>
<?php endif; ?>

<!-- Récupérer toutes les équipes -->
<?php
$equipes = new WP_Query(array(
    'post_type' => 'equipes', // Assure-toi que ce slug correspond à celui de ton type de publication
    'posts_per_page' => -1
));

if ($equipes->have_posts()) {
    echo '<h1>Équipes Enregistrées</h1>';
    echo '<ul class="liste-equipes">';
    while ($equipes->have_posts()) {
        $equipes->the_post();
        $logo = get_field('logo_de_lequipe'); // Récupère le logo de l'équipe si le champ existe

        echo '<li class="equipe">';
        echo '<div class="equipe-content">';
        
        // Afficher le logo de l'équipe
        if ($logo) {
            echo '<img src="' . esc_url($logo['url']) . '" alt="Logo de ' . get_the_title() . '" class="logo-equipe">';
        }
        
        // Nom de l'équipe
        echo '<h2>' . get_the_title() . '</h2>';

        // Bouton Voir l'équipe
        echo '<a href="' . get_permalink() . '" class="button-voir-equipe">Voir l’équipe</a>';
        
        echo '</div>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>Aucune équipe trouvée.</p>';
}

wp_reset_postdata();
get_footer();
?>

