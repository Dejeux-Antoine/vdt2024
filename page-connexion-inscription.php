<?php
/* Template Name: Connexion Inscription */
ob_start(); // Démarre le tampon de sortie pour éviter les erreurs de headers
get_header();

if (is_user_logged_in()) {
    echo '<p>Vous êtes déjà connecté.</p>';
} else {
    // Gérer le formulaire d'inscription
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inscription'])) {
        $errors = [];

        // Récupérer les valeurs du formulaire
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];
        $pseudo = sanitize_text_field($_POST['pseudo']);
        $photo_profil = $_FILES['photo_profil'];

        // Validation de base
        if (empty($username) || empty($email) || empty($password) || empty($pseudo)) {
            $errors[] = 'Veuillez remplir tous les champs obligatoires.';
        }

        if (email_exists($email)) {
            $errors[] = 'Cet e-mail est déjà utilisé.';
        }

        if (username_exists($username)) {
            $errors[] = 'Ce nom d’utilisateur est déjà pris.';
        }

        // Si aucune erreur, procéder à l'inscription
        if (empty($errors)) {
            $user_id = wp_create_user($username, $password, $email);
            if (!is_wp_error($user_id)) {
                // Enregistrer le pseudo en tant que champ personnalisé
                update_user_meta($user_id, 'pseudo_en_jeu', $pseudo);

                // Enregistrer la photo de profil
                if (!empty($photo_profil['tmp_name'])) {
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                    $uploaded = wp_handle_upload($photo_profil, array('test_form' => false));

                    if (!isset($uploaded['error']) && isset($uploaded['url'])) {
                        update_user_meta($user_id, 'photo_de_profil', $uploaded);
                    }
                }

                echo '<p>Inscription réussie. Vous pouvez maintenant vous connecter.</p>';
            } else {
                $errors[] = 'Une erreur est survenue lors de l’inscription.';
            }
        }

        // Afficher les erreurs s'il y en a
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<p>' . esc_html($error) . '</p>';
            }
        }
    }

    // Gérer le formulaire de connexion
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connexion'])) {
        $creds = array(
            'user_login'    => $_POST['log'],
            'user_password' => $_POST['pwd'],
            'remember'      => isset($_POST['remember']),
        );

        $user = wp_signon($creds, false);

        if (is_wp_error($user)) {
            echo '<p style="color:red;">Erreur de connexion : ' . $user->get_error_message() . '</p>';
        } else {
            wp_redirect(home_url()); // Redirige vers la page d'accueil après connexion
            exit;
        }
    }
    ?>

    <h1>Connexion / Inscription</h1>

    <!-- Formulaire de connexion -->
    <form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
        <h2>Connexion</h2>
        <p>
            <label for="login-username">Identifiant ou e-mail</label>
            <input type="text" name="log" id="login-username" required>
        </p>
        <p>
            <label for="login-password">Mot de passe</label>
            <input type="password" name="pwd" id="login-password" required>
        </p>
        <p>
            <label>
                <input type="checkbox" name="remember"> Se souvenir de moi
            </label>
        </p>
        <p>
            <input type="submit" name="connexion" value="Se connecter">
        </p>
    </form>

    <!-- Formulaire d'inscription -->
    <form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
        <h2>Inscription</h2>
        <input type="hidden" name="inscription" value="1">
        <p>
            <label for="username">Identifiant</label>
            <input type="text" name="username" id="username" required>
        </p>
        <p>
            <label for="email">Adresse e-mail</label>
            <input type="email" name="email" id="email" required>
        </p>
        <p>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
        </p>
        <p>
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" required>
        </p>
        <p>
            <label for="photo_profil">Photo de profil</label>
            <input type="file" name="photo_profil" id="photo_profil" accept="image/*">
        </p>
        <p>
            <input type="submit" value="S'inscrire">
        </p>
    </form>

    <?php
}

get_footer();
ob_end_flush(); // Envoie le contenu du tampon de sortie
