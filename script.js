const playerScoreElem = document.getElementById('player-score');
const computerScoreElem = document.getElementById('computer-score');
const resultElem = document.getElementById('result');
const choices = document.querySelectorAll('.choice');
const resetBtn = document.getElementById('reset');

let playerScore = 0;
let computerScore = 0;

const choicesMap = {
  rock: 'Batu',
  paper: 'Kertas',
  scissors: 'Gunting',
};

// Fungsi untuk memilih secara acak dari komputer
function getComputerChoice() {
  const choices = ['rock', 'paper', 'scissors'];
  const randomIndex = Math.floor(Math.random() * 3);
  return choices[randomIndex];
}

// Fungsi untuk menentukan pemenang
function determineWinner(playerChoice, computerChoice) {
  if (playerChoice === computerChoice) {
    return 'draw';
  }

  if (
    (playerChoice === 'rock' && computerChoice === 'scissors') ||
    (playerChoice === 'paper' && computerChoice === 'rock') ||
    (playerChoice === 'scissors' && computerChoice === 'paper')
  ) {
    return 'player';
  }

  return 'computer';
}

// Fungsi untuk bermain game
function playGame(playerChoice) {
  const computerChoice = getComputerChoice();
  const winner = determineWinner(playerChoice, computerChoice);

  if (winner === 'player') {
    playerScore++;
    resultElem.textContent = `Kamu menang! ${choicesMap[playerChoice]} mengalahkan ${choicesMap[computerChoice]}.`;
  } else if (winner === 'computer') {
    computerScore++;
    resultElem.textContent = `Komputer menang! ${choicesMap[computerChoice]} mengalahkan ${choicesMap[playerChoice]}.`;
  } else {
    resultElem.textContent = `Seri! Kamu dan komputer memilih ${choicesMap[playerChoice]}.`;
  }

  updateScoreboard();
}

// Fungsi untuk memperbarui skor
function updateScoreboard() {
  playerScoreElem.textContent = playerScore;
  computerScoreElem.textContent = computerScore;
}

// Fungsi untuk mereset permainan
function resetGame() {
  playerScore = 0;
  computerScore = 0;
  resultElem.textContent = 'Make your move!';
  updateScoreboard();
}

// Menambahkan event listener untuk setiap tombol pilihan
choices.forEach(choice => {
  choice.addEventListener('click', (e) => {
    const playerChoice = e.currentTarget.id;  // Mengambil id dari tombol yang diklik
    playGame(playerChoice);
  });
});

// Event listener untuk tombol reset
resetBtn.addEventListener('click', resetGame);
