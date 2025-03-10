<?php
session_start();

// Initialisation des joueurs si la session n'existe pas encore
if (!isset($_SESSION['players'])) {
    $_SESSION['players'] = [
        "Joueur 1" => 1,
        "Joueur 2" => 1
    ];
    $_SESSION['current_player'] = "Joueur 1";
}

// Lancer le dé (nombre aléatoire entre 1 et 6)
$dice = rand(1, 6);
$_SESSION['players'][$_SESSION['current_player']] += $dice;

// Règle spéciale : si un joueur dépasse 50, il revient à la case 25
if ($_SESSION['players'][$_SESSION['current_player']] > 50) {
    $_SESSION['players'][$_SESSION['current_player']] = 25;
}

// Vérification de la victoire
if ($_SESSION['players'][$_SESSION['current_player']] == 50) {
    $winner = $_SESSION['current_player'];
    session_destroy(); // Réinitialisation du jeu après victoire
    echo json_encode(["winner" => $winner]);
    exit;
}

// Passer au joueur suivant
$_SESSION['current_player'] = ($_SESSION['current_player'] == "Joueur 1") ? "Joueur 2" : "Joueur 1";

// Retourner les données au frontend
echo json_encode([
    "players" => $_SESSION['players'],
    "current_player" => $_SESSION['current_player'],
    "dice" => $dice
]);
?>

