# PHP intermediate p7

## formulaire de login

### Prérequis

- la présence des packages twig, symfony/yaml, symfony/var-dumper
- un script php qui permet d'authentifier un utilisateur : `public/login.php`
- un template qui affiche le formulaire d'authentification : `templates/login.html.twig`
- un script php qui protège la page : `public/private.php`
- un template qui affiche la page privée : `templates/private.html.twig`

### Le rôle du script php d'authentification

1. charger la config avec symfony/yaml
2. démarrer twig
3. vérifier si l'utilisateur a envoyé des données
    si l'utilisateur a envoyé des données
    1. le script doit valider les données
       si les données sont valides (pas d'erreurs) le script doit effectuer une action :
        1. créer une clé et une valeur dans la variable de session 
        2. redirigier l'utilisateur vers une page protégée
       si les données ne sont pas valides, le script doit initialiser des message d'erreur
4. afficher le template twig en lui transmettant les valeurs par défaut du formulaire et les messages d'erreur éventuels

### Le rôle du template twig qui affiche le formulaire

1. afficher un document html
2. intégrer bootstrap (avec la balise `link`)
3. afficher le formulaire de login (avec la mise en page bootstrap)
   en phase de dev, on peut ajouter l'attribut `novalidate` dans la balise `form` pour désactiver la validation côté client
   en phase de prod, il faut retirer l'attribut `novalidate`
4. afficher les messages d'erreur éventuels

### Pour vérifier si l'utilisateur a envoyé des données (en POST)

Envoyer des données en POST == répondre au formulaire 

    if ($_POST) {
        // l'utilisateur a envoyé des données en POST
        // on peut tester les données
    }

Ou avec la fonction `empty()`

    if (!empty($_POST)) {
        // l'utilisateur a envoyé des données en POST
        // on peut tester les données
    }

### La validation des données

Dans le formulaire vous avez :

- nom d'utilisateur
- mot de passe

Ou :

- email
- mot de passe

1. on lance la vérification seulement s'il y a des données
2. validation de l'email
   1. vérifier si le champ est renseigné
      si ce n'est pas le cas, initialiser le message d'erreur correspondant
   2. vérifier si la syntaxe de l'email est valide avec la fonction `filter_var()`
      si ce n'est pas le cas, initialiser le message d'erreur correspondant
   3. vérifier si l'email correspond à celui qui est stocké dans le fichier de config
      si ce n'est pas le cas, initialiser un message d'erreur générique (qui ne permet pas de savoir si c'est l'email ou le mot de passe qui est faux)
3. validation du mot de passe
   1. vérifier si le champ est renseigné
      si ce n'est pas le cas, initialiser le message d'erreur correspondant
   2. vérifier si le mot de passe correspond à celui qui est stocké dans le fichier de config
      si ce n'est pas le cas, initialiser un message d'erreur générique (qui ne permet pas de savoir si c'est l'email ou le mot de passe qui est faux)
4. s'il n'y a pas d'erreur, on peut valider l'authentification de l'utilisateur
   1. on copie l'id et l'email de l'utilisateur dans la variable de session
   2. on redirige l'utilisateur vers une page protégée

### Pour filtrer les utilisateurs non authentifiés

1. on vérifie si son id ou son email existe dans la variable de session
   si aucun n'existe on redirige l'utilisateur vers la page de login
   sinon, on laisse l'utilisateur voir la page privée
