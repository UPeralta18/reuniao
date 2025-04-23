const counter = document.getElementById('counter');
const startBtn = document.getElementById('startBtn');
const pauseBtn = document.getElementById('pauseBtn');

let totalSeconds = 3600; // 1 hora em segundos
let timerInterval = null;

function startTimer() {
    if (timerInterval) clearInterval(timerInterval);
    
    timerInterval = setInterval(() => {
        if (totalSeconds > 0) {
            totalSeconds--;
            updateCounter();
        } else {
            clearInterval(timerInterval);
        }
    }, 1000);
}

function pauseTimer() {
    clearInterval(timerInterval);
}

startBtn.addEventListener('click', startTimer);
pauseBtn.addEventListener('click', pauseTimer);

// Inicializa o contador
function updateCounter() {
    fetch('timer.php?action=count', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    }).then(response => response.text()).then(data => {
        getTimer();
    });
}

function getTimer() {
    fetch('timer.php?action=getTimer', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    }).then(response => response.text())
    .then(data => {
        document.getElementById('counter').innerHTML = data;
    });
}

setInterval(getTimer, 1000);

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