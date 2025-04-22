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
            updateCounter2();
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
function updateCounter2() {
    fetch('timer.php?action=count', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    }).then(response => response.text())
    .then(data => {
        document.getElementById('counter').innerHTML = data;
        // console.log(response.text())
        console.log(data)
    });
}