<?php
// Configurações de segurança
$file_path = 'text/message.txt';

// Lê o conteúdo atual do arquivo
$text = '';
if (file_exists($file_path)) {
    $text = htmlspecialchars(file_get_contents($file_path), ENT_QUOTES, 'UTF-8');
}

echo $text;