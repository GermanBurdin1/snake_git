<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snake</title>
    <style>
        canvas{
            border: 2px solid;
        }
    </style>
</head>
<body>

<canvas width="400" height="400"></canvas>
    
<script>
    // Écouteur d'événement pour le bouton "Lancer le Dé"
document.getElementById("rollDice").addEventListener("click", function() {
    fetch("game.php") // Appel AJAX pour exécuter la logique PHP
        .then(response => response.json())
        .then(data => {
            // Vérifier si un joueur a gagné
            if (data.winner) {
                document.getElementById("turn").innerText = 🎉 ${data.winner} a gagné ! 🎉;
                document.getElementById("rollDice").disabled = true; // Désactiver le bouton après la victoire
                return;
            }

            // Mise à jour des informations du jeu
            document.getElementById("turn").innerText = Tour de ${data.current_player};
            document.getElementById("diceResult").innerText = Dé: ${data.dice};

            // Mise à jour de la position des joueurs
            updatePlayerPosition("player1", data.players["Joueur 1"]);
            updatePlayerPosition("player2", data.players["Joueur 2"]);
        });
});

// Fonction pour déplacer un joueur sur le plateau
function updatePlayerPosition(playerId, position) {
    let player = document.getElementById(playerId);
    let newX = (position - 1) * 10; // Conversion de la position en pixels
    player.style.transform = translateX(${newX}px);
}
</script>
</body>
</html>