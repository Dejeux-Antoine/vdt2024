<?php
/* Template Name: Joueurs */
get_header();

// Récupérer tous les utilisateurs ayant le rôle "joueur"
$args = array(
    'role' => 'joueur', // Assure-toi que le rôle "joueur" correspond
    'orderby' => 'display_name',
    'order' => 'ASC'
);
$joueurs = get_users($args);
?>

<div class="joueurs-container">
    <h1>Joueurs Participants</h1>

    <!-- Barre de recherche -->
    <input type="text" id="search-bar" placeholder="Rechercher Joueurs..." onkeyup="searchPlayers()">
    
    <?php if (!empty($joueurs)) : ?>
        <ul id="joueurs-list" class="liste-joueurs">
            <?php foreach ($joueurs as $joueur) :
                $pseudo = $joueur->display_name;
                $photo = get_field('photo_de_profil', 'user_' . $joueur->ID); // Récupérer la photo de profil du joueur
            ?>
                <li class="joueur-item">
                    <?php if ($photo) : ?>
                        <img src="<?php echo esc_url($photo['url']); ?>" alt="Photo de <?php echo esc_attr($pseudo); ?>" class="photo-joueur">
                    <?php endif; ?>
                    <a href="<?php echo esc_url(get_author_posts_url($joueur->ID)); ?>" class="joueur-pseudo"><?php echo esc_html($pseudo); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Aucun joueur trouvé.</p>
    <?php endif; ?>
</div>

<script>
// Fonction de recherche pour filtrer les joueurs
function searchPlayers() {
    var input, filter, ul, li, pseudo, i, txtValue;
    input = document.getElementById("search-bar");
    filter = input.value.toUpperCase();
    ul = document.getElementById("joueurs-list");
    li = ul.getElementsByClassName("joueur-item");

    for (i = 0; i < li.length; i++) {
        pseudo = li[i].getElementsByClassName("joueur-pseudo")[0];
        txtValue = pseudo.textContent || pseudo.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>

<?php get_footer(); ?>
