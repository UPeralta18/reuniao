const counter = document.getElementById('counter');
const startBtn = document.getElementById('startBtn');
const pauseBtn = document.getElementById('pauseBtn');

let totalSeconds = 3600; // 1 hora em segundos
let timerInterval = null;

function updateCounter() {
    const hours = Math.floor(totalSeconds / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    const seconds = totalSeconds % 60;
    
    counter.textContent = 
    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    
    if (totalSeconds <= 0) {
        clearInterval(timerInterval);
        counter.textContent = "00:00:00";
        counter.style.color = "#ff0000";
        counter.style.textShadow = "0 0 10px #ff0000, 0 0 20px #ff0000";
    }
}

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

function getMessage() {
    fetch('text/message.txt')
    .then(response => response.text())
    .then(data => {
        const messageElement = document.getElementsByClassName('message');
        messageElement.textContent = data;
    });
}

startBtn.addEventListener('click', startTimer);
pauseBtn.addEventListener('click', pauseTimer);

// Inicializa o contador
updateCounter();
getMessage();