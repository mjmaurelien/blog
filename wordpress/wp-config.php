<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Le script de création wp-config.php utilise ce fichier lors de l'installation.
 * Vous n'avez pas à utiliser l'interface web, vous pouvez directement
 * renommer ce fichier en "wp-config.php" et remplir les variables à la main.
 *
 * Ce fichier contient les configurations suivantes :
 *
 * * réglages MySQL ;
 * * clefs secrètes ;
 * * préfixe de tables de la base de données ;
 * * ABSPATH.
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'blog');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ViwXF4~XFeQ^7.Rj*,qRqK=Zx^MT[svQ~. 1~8l$E}0P?=n[) @$Z/@Y$0--,!X5');
define('SECURE_AUTH_KEY',  'Y)iW=6@hRgRE_Q@NQcWV|tC+%a4QWU+M&bOD50JBAN:#}netC|dWLVR`(e=<gjM-');
define('LOGGED_IN_KEY',    '^510 J]Hea4;Dj|JmmKDT_|7!Y-Wot(u]>Eq,uGx,+P)T$W&w+KL]vz(WQ${/V=o');
define('NONCE_KEY',        '}3T}1VN`gj+.<9|[<7F!QJ<,.mmI!2@Aq[EhP,UX[2.oQ>_9ik4}KU#a^Jr,?q&P');
define('AUTH_SALT',        ':X(T+6ayFNGR(-EI3YIYCcVkiz*Bsu?HN<Ii,+IF(;GmHQcIZ-]*&m{r$eE||nuj');
define('SECURE_AUTH_SALT', '2knH%/T-Mw,SUzl(mh^|h^WMDPrqi3Yt{ZxW,n^P4B#*td$!(w|5mmh2X+joY1|A');
define('LOGGED_IN_SALT',   'C=+#M]h|il1@0[L.*Jq[(*p7fX2Dr)=gE&m0B]}~]61t#i7:a9lK!1@;>Q#_uF^n');
define('NONCE_SALT',       ':*Zp|d~r,tL,=ooJ8bjxG+E49|a_!;{ko2kqVbm!+e5gPO[c@P5`AxtB5:5O.Q,d');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour obtenir plus d'information sur les constantes
 * qui peuvent être utilisée pour le déboguage, consultez le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
