<?php
/* Template Name: Page d'Accueil Non Connecté */
get_header();
?>

<div class="accueil-non-connecte">
    <!-- Logo et titre du tournoi -->
    <div class="logo">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Logo VDT 2024">
    </div>

    <!-- Section pour associer le profil -->
    <div class="associer-profil">
        <button class="btn-associer">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon-user.png" alt="Icône Utilisateur"> Associer Profil
        </button>
    </div>

    <!-- Message pour les utilisateurs non connectés -->
    <div class="message-non-connecte">
        <p><img src="<?php echo get_template_directory_uri(); ?>/images/icon-user.png" alt="Icône Utilisateur"> Profil non associé</p>
        <p>Associer votre profil pour une expérience plus personnalisée et un accès rapide à vos statistiques et votre équipe.</p>
        <a href="<?php echo wp_login_url(); ?>" class="btn-connect">Connexion ou Inscription</a>
        <div class="ou-separateur">ou</div>
        <button class="btn-trouver-joueur">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon-player.png" alt="Icône Recherche Joueur"> Trouver un joueur
        </button>
    </div>

    <!-- Barre de navigation en bas de page -->
    <div class="navigation-bas">
        <a href="#joueurs"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-player.png" alt="Icône Joueurs"> Joueurs</a>
        <a href="#equipes"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-team.png" alt="Icône Équipes"> Équipes</a>
        <a href="#profil" class="profil-actif"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-user.png" alt="Icône Profil"> Mon Profil</a>
        <a href="#matchs"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-matchs.png" alt="Icône Matchs"> Matchs</a>
        <a href="#parametres"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-settings.png" alt="Icône Paramètres"> Paramètres</a>
    </div>
</div>

<?php
get_footer();
?>
