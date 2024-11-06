<?php
get_header();

// Récupérer l'ID de l'utilisateur actuel (l'auteur)
$user_id = get_queried_object_id();

// Récupérer les champs personnalisés en utilisant les noms exacts
$pseudo = get_field('pseudo_en_jeu', 'user_' . $user_id);
$photo_profil = get_field('photo_de_profil', 'user_' . $user_id);
$equipe_actuelle_data = get_field('equipe_actuelle', 'user_' . $user_id);
$ratio_vd = get_field('ratio_victoiresdefaites', 'user_' . $user_id);
$matchs_joues = get_field('nombre_de_matchs_joues', 'user_' . $user_id);
$classement_actuel = get_field('classement_actuel', 'user_' . $user_id);
$meilleur_classement = get_field('meilleur_classement_', 'user_' . $user_id);

?>

<div class="profil-joueur">
    <!-- Afficher le pseudo et la photo de profil -->
    <h1>Profil de <?php echo esc_html($pseudo); ?></h1>
    <?php if ($photo_profil) : ?>
        <img src="<?php echo esc_url($photo_profil['url']); ?>" alt="Photo de profil de <?php echo esc_html($pseudo); ?>" class="photo-profil">
    <?php endif; ?>

    <!-- Afficher l'équipe actuelle avec vérification du type de contenu -->
    <?php 
    if ($equipe_actuelle_data && is_array($equipe_actuelle_data) && isset($equipe_actuelle_data[0])) :
        $equipe_actuelle = $equipe_actuelle_data[0];
        if ($equipe_actuelle instanceof WP_Post && $equipe_actuelle->post_type == 'equipes') : ?>
            <p><strong>Équipe Actuelle :</strong> <?php echo esc_html($equipe_actuelle->post_title); ?></p>
        <?php else : ?>
            <p><strong>Équipe Actuelle :</strong> Non définie</p>
        <?php endif;
    else : ?>
        <p><strong>Équipe Actuelle :</strong> Non définie</p>
    <?php endif; ?>

    <!-- Afficher les statistiques du joueur avec vérifications -->
    <div class="statistiques-joueur">
        <p><strong>Ratio Victoires/Défaites :</strong> <?php echo esc_html($ratio_vd ? $ratio_vd : 'Non défini'); ?></p>
        <p><strong>Nombre de matchs joués :</strong> <?php echo esc_html($matchs_joues ? $matchs_joues : 'Non défini'); ?></p>
        <p><strong>Classement actuel :</strong> <?php echo esc_html($classement_actuel ? $classement_actuel : 'Non défini'); ?></p>
        <p><strong>Meilleur Classement :</strong> <?php echo esc_html($meilleur_classement ? $meilleur_classement : 'Non défini'); ?></p>
    </div>
</div>

<?php get_footer(); ?>
