const dataQuestions = [
    { q: "What is the capital of France?", 
        a: "Paris", 
        b: "London", 
        c: "Berlin", 
        d: "Madrid", 
        correct: "a" },
    { q: "What is the largest planet in our solar system?", 
        a: "Earth", 
        b: "Mars", 
        c: "Jupiter", 
        d: "Saturn", 
        correct: "c" },
    { q: "What is the chemical symbol for water?", 
        a: "H2O", 
        b: "O2", 
        c: "CO2", 
        d: "NaCl", 
        correct: "a" },
    { q: "Who wrote 'To Kill a Mockingbird'?", 
        a: "Harper Lee", 
        b: "Mark Twain", 
        c: "Ernest Hemingway", 
        d: "F. Scott Fitzgerald", 
        correct: "a" },
    { q: "What is the speed of light?", 
        a: "300,000 km/s", 
        b: "150,000 km/s", 
        c: "450,000 km/s", 
        d: "600,000 km/s", 
        correct: "a" }
];

const quiz = document.getElementById('quiz');
const answers = document.querySelectorAll('.answer');
const question = document.getElementById('question');
const a = document.getElementById('a_text');
const b = document.getElementById('b_text');
const c = document.getElementById('c_text');
const d = document.getElementById('d_text');
const submitBtn = document.getElementById('submit');
const nameForm = document.getElementById('start-form');
const nameInput = document.getElementById('username');
let currentQuiz = 0;
let score = 0;
let username = '';

nameForm.addEventListener('submit', (e) => {
    e.preventDefault();
    username = nameInput.value.trim();
    if (username) {
        document.getElementById('name-form').style.display = 'none';
        quiz.style.display = 'block';
        loadQuiz();
    }
});

function loadQuiz() {
    deselectAnswers();
    const currentQuestion = dataQuestions[currentQuiz];
    question.innerText = currentQuestion.q;
    a.innerText = currentQuestion.a;
    b.innerText = currentQuestion.b;
    c.innerText = currentQuestion.c;
    d.innerText = currentQuestion.d;
}

function deselectAnswers() {
    answers.forEach(answer => (answer.checked = false));
}

function getSelected() {
    let selectedAnswer;
    answers.forEach(answer => {
        if (answer.checked) {
            selectedAnswer = answer.id;
        }
    });
    return selectedAnswer;
}

submitBtn.addEventListener('click', () => {
    const selectedAnswer = getSelected();
    if (selectedAnswer) {
        if (selectedAnswer === dataQuestions[currentQuiz].correct) {
            score++;
        }

        currentQuiz++;

        if (currentQuiz < dataQuestions.length) {
            loadQuiz();
        } else {
            const formData = new FormData();
            formData.append('name', username);
            formData.append('score', score);

            fetch('index.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
              .then(data => {
                  document.body.innerHTML = data; 
              });
        }
    }
});
