<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador Regressivo Vermelho</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<?php
// Lê o conteúdo atual do arquivo
$file_path = 'text/message.txt';
$text = '';
if (file_exists($file_path)) {
    $text = htmlspecialchars(file_get_contents($file_path), ENT_QUOTES, 'UTF-8');
}
$file_path = 'text/timer.txt';
$timer = '';
if (file_exists($file_path)) {
    $timer = htmlspecialchars(file_get_contents($file_path), ENT_QUOTES, 'UTF-8');
}
?>
<body>
    <div class="controls">
        <button id="startBtn">Iniciar</button>
        <button id="pauseBtn">Pausar</button>
    </div>
    <div class="counter" id="counter"><?= $timer; ?></div>
    <p id="message"><?= $text; ?></p>
</body>
</html>