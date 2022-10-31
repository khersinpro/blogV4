<?php
require __DIR__.'/database/database.php';
$authDb = require __DIR__.'/database/security.php';
const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
const ERROR_PASSWORD_TOO_SHORT = 'Le mot de passe doit faire au moins 6 caractères';
const ERROR_PASSWORD_MISSMATCH = 'Les mot de passe n\'est pas valide';
const ERROR_EMAIL_INVALID = 'L\'email n\'est pas valide';
const ERROR_EMAIL_UNKNOW = 'L\'email n\'est pas enregistré';

$errors = [
    'email' => '',
    'password' => '',
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = filter_input_array(INPUT_POST, [ "email" => FILTER_SANITIZE_EMAIL] );

    $email = $input['email'] ?? "";
    $password = $_POST['password'] ?? "";


    if(!$email) {
        $errors['email'] = ERROR_REQUIRED;
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = ERROR_EMAIL_INVALID;
    }
    
    if(!$password) {
        $errors['password'] = ERROR_REQUIRED;
    } else if(mb_strlen($password) < 6) {
        $errors['password'] = ERROR_PASSWORD_TOO_SHORT;
    }

    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
        $user = $authDb->getUserFromEmail($email);
        if(!$user) {
            $errors['email'] = ERROR_EMAIL_UNKNOW;
        } else {
            if( !password_verify($password, $user['password']) ) {
                $errors['password'] = ERROR_PASSWORD_MISSMATCH;
            } else {
                $authDb->login($user['id']);
                header("Location: /");
            }    
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/css/auth-login.css">
    <title>Connexion</title>
</head>

<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
        <div class="block p-20 form-container">
                <h1>Connexion</h1>
                <form action="/auth-login.php" method="POST">
                    
                    <div class="form-control">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?= $email ?? '' ?>">
                        <?php if ($errors['email']) : ?>
                            <p class="text-danger"><?= $errors['email'] ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-control">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password">
                        <?php if ($errors['password']) : ?>
                            <p class="text-danger"><?= $errors['password'] ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-actions">
                        <a href="/" class="btn btn-secondary" type="button">Annuler</a>
                        <button class="btn btn-primary" type="submit">Connexion</button>
                    </div>

                </form>
            </div>
        </div>
        <?php require_once 'includes/footer.php' ?>
    </div>

</body>

</html>