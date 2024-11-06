<?php
/* Template Name: Mon Profil */
get_header();

if (is_user_logged_in()) {
    // Récupérer l'utilisateur actuellement connecté
    $user_id = get_current_user_id();

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
        <h1><?php echo esc_html($pseudo); ?></h1>
        <?php if ($photo_profil) : ?>
            <img src="<?php echo esc_url($photo_profil['url']); ?>" alt="Photo de profil de <?php echo esc_html($pseudo); ?>" class="photo-profil">
        <?php endif; ?>

        <div class="equipe-actuelle">
            <h2>Équipe Actuelle</h2>
            <?php if ($equipe_actuelle_data && is_array($equipe_actuelle_data) && isset($equipe_actuelle_data[0])) :
                $equipe_actuelle = $equipe_actuelle_data[0];
                if ($equipe_actuelle instanceof WP_Post && $equipe_actuelle->post_type == 'equipes') : ?>
                    <p><?php echo esc_html($equipe_actuelle->post_title); ?></p>
                    <a href="<?php echo get_permalink($equipe_actuelle->ID); ?>" class="button-equipe">Voir l'équipe</a>
                <?php else : ?>
                    <p>Non définie</p>
                <?php endif;
            else : ?>
                <p>Non définie</p>
            <?php endif; ?>
        </div>

        <div class="statistiques-joueur">
            <p><strong>Classement actuel :</strong> <?php echo esc_html($classement_actuel ? $classement_actuel : 'Non défini'); ?></p>
            <p><strong>Meilleur Classement :</strong> <?php echo esc_html($meilleur_classement ? $meilleur_classement : 'Non défini'); ?></p>
            <p><strong>Win % :</strong> <?php echo esc_html($ratio_vd ? $ratio_vd : 'Non défini'); ?></p>
            <p><strong>Nombres de matchs joués :</strong> <?php echo esc_html($matchs_joues ? $matchs_joues : 'Non défini'); ?></p>
        </div>

        <p>
            <a href="<?php echo admin_url('profile.php'); ?>" class="button-modifier-profil">Modifier le profil</a>
        </p>
    </div>

<?php
} else {
    ?>

    <!-- Affichage pour les utilisateurs non connectés -->
    <div class="profil-non-associe">
        <h2>Profil non associé</h2>
        <p>Associer votre profil pour une expérience plus personnalisée et un accès rapide à vos statistiques et votre équipe.</p>
        <a href="<?php echo site_url('/connexion-inscription/'); ?>" class="button-connexion">Connexion ou Inscription</a>
        <div class="ou-divider">
            <hr><span>ou</span><hr>
        </div>
        <a href="<?php echo site_url('/joueurs/'); ?>" class="button-trouver-joueur">Trouver un joueur</a>
    </div>



<?php
}

get_footer();
