<?php
// Capture les données du formulaire
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$subject = htmlspecialchars($_POST["subject"]);
$message = htmlspecialchars($_POST["message"]);

// URL de l'application Google Apps Script
$googleAppsScriptUrl = 'URL_DU_SCRIPT_GOOGLE_APPS'; // Remplace par l'URL du script déployé

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

// Exécute la requête
$response = curl_exec($ch);
$error = curl_error($ch); // Récupère l'erreur s'il y en a

// Ferme la session cURL
curl_close($ch);

// Redirection et affichage des messages d'erreur ou de succès
if ($response === "Success") {
    // Redirige directement vers index.html en cas de succès
    header("Location: index.html");
    exit;
} else {
    // En cas d'erreur, affiche un message d'erreur puis redirige automatiquement
    echo "<p>Une erreur s'est produite lors de l'envoi des données. Veuillez réessayer.</p>";
    echo "<p>Détails de l'erreur : $error</p>";
    echo "<p>Vous allez être redirigé vers la page d'accueil dans quelques secondes...</p>";

    // Script pour rediriger après quelques secondes
    echo "<script>
            setTimeout(function() {
                window.location.href = 'index.html';
            }, 5000); // Redirection après 5 secondes
          </script>";
}
?>
