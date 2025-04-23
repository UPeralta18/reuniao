// Inicializa o contador
function getTimer() {
    fetch('timer.php?action=getTimer', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    }).then(response => response.text())
    .then(data => {
        document.getElementById('counter').innerHTML = data;
        if(data == '10:00' || data == '00:00') {
            // play sound
            const audio = new Audio('audio/alert.mp3');
            audio.play();
        }
    });
}

setInterval(updateText, 1000);
setInterval(getTimer, 1000);

function updateText() {
    text = document.getElementById('message').innerHTML
    fetch('text.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    }).then(response => response.text())
    .then(data => {
        if(text != data) {
            document.getElementById('message').innerHTML = data;
            // play sound
            const audio = new Audio('audio/alert.mp3');
            audio.play();
        }
    });
}

/* enter screen click the button */
const enterBtn = document.getElementById('enterBtn');
enterBtn.addEventListener('click', function() {
    // hide enter screen
    document.querySelector('.enter-screen').style.display = 'none';
});