<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador Regressivo Vermelho</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
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
    <div class="form">
        <label for="message">Mensagem:</label>
        <input type="text" id="message" value="<?php echo $text; ?>">
        <button id="save">Salvar Texto</button>
    </div>
    <div class="form-timer">
        <label for="timer">Timer (Formato HH:MM:SS):</label>
        <input type="text" id="timer" value="<?php echo $timer; ?>">
        <button id="save-timer">Salvar Timer</button>
    </div>
    <button id="reset">Reiniciar Timer</button>

    <script>
        document.getElementById('save').addEventListener('click', function() {
            const message = document.getElementById('message').value;
            
            // Envia os dados para o servidor
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'message=' + encodeURIComponent(message)
            })
            .then(response => response.text())
            .then(
                alert('Mensagem salva com sucesso!')
            )
            .catch(error => {
                notification.className = 'notification error';
                notification.textContent = 'Erro na comunicação com o servidor';
                notification.style.display = 'block';
            });
        });
        document.getElementById('save-timer').addEventListener('click', function() {
            const timer = document.getElementById('timer').value;
            
            // Envia os dados para o servidor
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'timer=' + encodeURIComponent(timer)
            })
            .then(response => response.text())
            .then(
                alert('Timer salvo com sucesso!')
            )
            .catch(error => {
                notification.className = 'notification error';
                notification.textContent = 'Erro na comunicação com o servidor';
                notification.style.display = 'block';
            });
        });
        document.getElementById('reset').addEventListener('click', function() {
                fetch('timer.php?action=reset', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            }).then(response => response.text())
            .then(data => {
                alert('Timer reiniciado com sucesso!');
            })
            .then(
                window.location.reload()
            );
        });
    </script>
</body>
</html>