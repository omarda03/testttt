<?php
// Capture les données du formulaire
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$subject = htmlspecialchars($_POST["subject"]);
$message = htmlspecialchars($_POST["message"]);

// Vérification des champs requis
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo "<p>Tous les champs sont obligatoires. Veuillez remplir le formulaire complètement.</p>";
    echo "<p>Vous allez être redirigé vers la page d'accueil dans quelques secondes...</p>";
    echo "<script>
            setTimeout(function() {
                window.location.href = '/sbcg/index.html';
            }, 5000); // Redirection après 5 secondes
          </script>";
    exit;
}

// Vérification de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<p>L'adresse e-mail n'est pas valide. Veuillez réessayer.</p>";
    echo "<p>Vous allez être redirigé vers la page d'accueil dans quelques secondes...</p>";
    echo "<script>
            setTimeout(function() {
                window.location.href = '/sbcg/index.html';
            }, 5000); // Redirection après 5 secondes
          </script>";
    exit;
}

// URL de l'application Google Apps Script
$googleAppsScriptUrl = 'https://script.google.com/macros/s/AKfycbzUtyx-fGPUoh3kyYo_6bkapiFfj_GN2wHtoiufHU96Cq9AnIC0EdKHLiz6gwFGgzeo/exec'; // Remplace par l'URL du script déployé

// Crée un tableau avec les données à envoyer
$data = [
    'name' => $name,
    'email' => $email,
    'subject' => $subject,
    'message' => $message
];

// Initialisation de cURL
$ch = curl_init($googleAppsScriptUrl);

// Configuration des options cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retourne le résultat sous forme de string
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Données à envoyer
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);

// Exécute la requête
$response = curl_exec($ch);
$error = curl_error($ch); // Récupère l'erreur s'il y en a

// Ferme la session cURL
curl_close($ch);

// Redirection et affichage des messages d'erreur ou de succès

?>
