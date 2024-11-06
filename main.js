const dataQuestions = [
    {
        q: "What is the capital of France?",
        a: "Paris",
        b: "London",
        c: "Berlin",
        d: "Madrid",
        correct: "a",
    },
    {
        q: "What is the largest planet in our solar system?",
        a: "Earth",
        b: "Mars",
        c: "Jupiter",
        d: "Saturn",
        correct: "c",
    },
    {
        q: "What is the chemical symbol for water?",
        a: "H2O",
        b: "O2",
        c: "CO2",
        d: "NaCl",
        correct: "a",
    },
    {
        q: "Who wrote 'To Kill a Mockingbird'?",
        a: "Harper Lee",
        b: "Mark Twain",
        c: "Ernest Hemingway",
        d: "F. Scott Fitzgerald",
        correct: "a",
    },
    {
        q: "What is the speed of light?",
        a: "300,000 km/s",
        b: "150,000 km/s",
        c: "450,000 km/s",
        d: "600,000 km/s",
        correct: "a",
    }
];

const quiz = document.getElementById('quiz')
const answers = document.querySelectorAll('.answer')
const question = document.getElementById('question')
const a = document.getElementById('a_text')
const b = document.getElementById('b_text')
const c = document.getElementById('c_text')
const d = document.getElementById('d_text')

let currentQuiz = 0
let score = 0

loadQuiz()

function loadQuiz() {
    deselectAnswers()

    const currentQuestion = dataQuestions[currentQuiz]
    question.innerText = currentQuestion.q // Fix property to 'q'
    a.innerText = currentQuestion.a
    b.innerText = currentQuestion.b
    c.innerText = currentQuestion.c
    d.innerText = currentQuestion.d
}

function deselectAnswers() {
    answers.forEach(answer => answer.checked = false)
}

function getSelected() {
    let selectedAnswer
    answers.forEach(answer => {
        if (answer.checked) {
            selectedAnswer = answer.id
        }
    });
    return selectedAnswer
}

const submitBtn = document.getElementById('submit')

submitBtn.addEventListener('click', () => {
    const selectedAnswer = getSelected()
    if (selectedAnswer) {
        if (selectedAnswer === dataQuestions[currentQuiz].correct) {
            score++
        }

        currentQuiz++

        if (currentQuiz < dataQuestions.length) {
            loadQuiz()
        } else {
            quiz.innerHTML = `
            <h2>You answered ${score}/${dataQuestions.length} questions correctly</h2>
            <button onclick="location.reload()">Reload</button>
            `
        }
    }
})
