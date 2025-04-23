<?php
if (isset($_GET['action']) && $_GET['action'] === 'count') {
    $file_path = 'text/timer.txt';
    $timer = '';
    if (file_exists($file_path)) {
        $timer = htmlspecialchars(file_get_contents($file_path), ENT_QUOTES, 'UTF-8');
    }
    
    $timer = explode(':', $timer);
    $minutes = $timer[0];
    $seconds = $timer[1];
    
    $seconds--;
    if ($seconds < 0) { 
        $seconds = 59;
        $minutes--;
        if ($minutes < 0) {
            $minutes = 59;
        }
    }
    
    $timer = sprintf('%02d:%02d', $minutes, $seconds);
    file_put_contents($file_path, $timer);
    
    echo $timer;
}

if (isset($_GET['action']) && $_GET['action'] === 'reset') {
    $file_path = 'text/timer.txt';
    $timer = '';
    if (file_exists($file_path)) {
        $timer = htmlspecialchars(file_get_contents($file_path), ENT_QUOTES, 'UTF-8');
    }
    
    $timer = sprintf('50:00');
    file_put_contents($file_path, $timer);
}

if (isset($_GET['action']) && $_GET['action'] === 'getTimer') {
    $file_path = 'text/timer.txt';
    $timer = '';
    if (file_exists($file_path)) {
        $timer = htmlspecialchars(file_get_contents($file_path), ENT_QUOTES, 'UTF-8');
    }
    
    echo $timer;
}