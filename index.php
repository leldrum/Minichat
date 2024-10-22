<?php
session_start();
require_once("pdo.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon chat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-gray-200">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4 text-center <?php if (!isset($_SESSION['pseudo'])) echo "hidden"; ?>">
            Bonjour <?php echo htmlspecialchars($_SESSION['pseudo']); ?>
        </h1>

        <form action="connection.php" method="post" class="my-12 text-center">
            <label for="pseudo" class="block text-lg font-medium text-gray-300">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" placeholder="Entre ton pseudo" required class="mt-1 block w-full border border-gray-600 bg-gray-800 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
            <button type="submit" class="mt-2 bg-blue-600 text-white font-bold py-2 px-4 rounded">Envoyer</button>
        </form>

        <div class="mb-4" id="messages">
            <?php
            $sql = "SELECT pseudo, message FROM message ORDER BY date_envoi";
            $tableau = array();
            lireBase($base_conn, $sql, $tableau);

            foreach ($tableau as $row) {
                echo '<div class="my-2">';
                echo '<div class="bg-gray-800 text-white p-3 rounded-lg shadow-md">';
                echo '<strong class="text-blue-400">' . htmlspecialchars($row['pseudo']) . ':</strong> ';
                echo htmlspecialchars($row['message']);
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <form action="traitement.php" <?php if (!isset($_SESSION['pseudo'])) echo "hidden"; ?> method="post" class=" text-center">
            <label for="message" class="block text-lg font-medium text-gray-300"></label>
            <input type="text" id="message" name="message" placeholder="Envoyer un message" required class="mt-1 block w-full border border-gray-600 bg-gray-800 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
            <button type="submit" class="mt-2 bg-blue-600 text-white font-bold py-2 px-4 rounded">Envoyer</button>
        </form>
    </div>
</body>

</html>
