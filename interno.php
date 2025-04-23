<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle da Reunião</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts_interno.js" defer></script>
</head>
<body>
<?php
// Configurações de segurança
$file_path = 'text/message.txt';
$file_path_timer = 'text/timer.txt';

// Processa o salvamento se for uma requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    try {
        $new_message = $_POST['message'];
        
        // Verifica se o diretório existe e tem permissão de escrita
        if (!is_dir('text')) {
            mkdir('text', 0755, true);
        }
        
        // Escreve no arquivo
        $result = file_put_contents($file_path, $new_message);
        
        if ($result === false) {
            throw new Exception('Erro ao salvar o arquivo');
        }
        
        // Retorna sucesso
        echo '<div class="notification success" id="notification">Mensagem salva com sucesso!</div>';
    } catch (Exception $e) {
        echo '<div class="notification error" id="notification">Erro: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}

// Processa o salvamento se for uma requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['timer'])) {
    try {
        $timer = $_POST['timer'];
        
        // Verifica se o diretório existe e tem permissão de escrita
        if (!is_dir('text')) {
            mkdir('text', 0755, true);
        }
        
        // Escreve no arquivo
        $result = file_put_contents($file_path_timer, $timer);
        
        if ($result === false) {
            throw new Exception('Erro ao salvar o arquivo');
        }
        
        // Retorna sucesso
        echo '<div class="notification success" id="notification">Mensagem salva com sucesso!</div>';
    } catch (Exception $e) {
        echo '<div class="notification error" id="notification">Erro: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}

// Lê o conteúdo atual do arquivo
$text = '';
if (file_exists($file_path)) {
    $text = htmlspecialchars(file_get_contents($file_path), ENT_QUOTES, 'UTF-8');
}
$timer = '';
if (file_exists($file_path_timer)) {
    $timer = htmlspecialchars(file_get_contents($file_path_timer), ENT_QUOTES, 'UTF-8');
}
?>
    <div class="counter" id="counter"><?= $timer; ?></div>
    <div class="form">
        <label for="message">Mensagem:</label>
        <input type="text" id="message" value="<?php echo $text; ?>">
        <button id="save">Salvar Texto</button>
    </div>
    <div class="form-timer">
        <label for="timer">Timer (Formato MM:SS):</label>
        <input type="text" id="timer" value="<?php echo $timer; ?>">
        <button id="save-timer">Salvar Timer</button>
    </div>
    <button id="reset">Reiniciar Timer</button>
    <div class="controls">
        <button id="startBtn">Iniciar</button>
        <button id="pauseBtn">Pausar</button>
    </div>
</body>
</html>