<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === 'reset') {
    session_destroy();
    header("Location: index.php"); 
    exit();
}

$questions = [
    ["q" => "What is the capital of France?", "a" => "Paris", "b" => "London", "c" => "Berlin", "d" => "Madrid", "correct" => "a"],
    ["q" => "What is the largest planet in our solar system?", "a" => "Earth", "b" => "Mars", "c" => "Jupiter", "d" => "Saturn", "correct" => "c"],
    ["q" => "What is the chemical symbol for water?", "a" => "H2O", "b" => "O2", "c" => "CO2", "d" => "NaCl", "correct" => "a"],
    ["q" => "Who wrote 'To Kill a Mockingbird'?", "a" => "Harper Lee", "b" => "Mark Twain", "c" => "Ernest Hemingway", "d" => "F. Scott Fitzgerald", "correct" => "a"],
    ["q" => "What is the speed of light?", "a" => "300,000 km/s", "b" => "150,000 km/s", "c" => "450,000 km/s", "d" => "600,000 km/s", "correct" => "a"]
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? '';

    if ($action === 'start') {
        $_SESSION['username'] = $_POST['username'] ?? 'Unknown';
        $_SESSION['nim'] = $_POST['nim'] ?? 'Unknown';
        
        $_SESSION['currentQuiz'] = 0;
        $_SESSION['score'] = 0;
    } elseif ($action === 'submitAnswer') {
        $selectedAnswer = $_POST['answer'] ?? '';
        $currentQuiz = $_SESSION['currentQuiz'];
        $correctAnswer = $questions[$currentQuiz]['correct'];

        if ($selectedAnswer === $correctAnswer) {
            $_SESSION['score']++;
        }

        $_SESSION['currentQuiz']++;
    }
}

$username = $_SESSION['username'] ?? '';
$nim = $_SESSION['nim'] ?? '';
$currentQuiz = $_SESSION['currentQuiz'] ?? 0;
$score = $_SESSION['score'] ?? 0;

if ($currentQuiz < count($questions)) {
    $currentQuestion = $questions[$currentQuiz];
} else {
    $quizCompleted = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styless.css">
</head>
<body>
    
    <?php if ($username === '' || $nim === ''): ?>
        <div id="name-form">
            <h2>Fill Form Below To Start The Quiz</h2>
            <form method="post">
                <input type="hidden" name="action" value="start">
                <input type="text" name="username" placeholder="Your Name">
                <input type="text" name="nim" placeholder="Your Student ID">
                <button type="submit">Start Quiz</button>
            </form>
        </div>
    <?php elseif (isset($quizCompleted) && $quizCompleted): ?>
        <h1>Thanks For Joining This Dummy Quiz</h1>
        <div class="result">
            <div class="left-side">
                <p>NAME</p>
                <p>STUDENT ID</p>
                <p>SCORE</p>
            </div>
            <div class="right-side">
                <p><?= htmlspecialchars($username)?></p>
                <p><?= htmlspecialchars($nim)?></p>
                <p><?= $score ?> / <?= count($questions) ?></p>
            </div>
        </div>
        <form method="post">
            <input type="hidden" name="action" value="reset">
            <button type="submit">Try Again</button>
        </form>
    <?php else: ?>
        <div class="quiz-container" id="quiz">
            <div class="quiz-header">
                <h2><?= htmlspecialchars($currentQuestion['q']) ?></h2>
                <form method="post" class="quiz">
                    <input type="hidden" name="action" value="submitAnswer">
                    <ul>
                        <li>
                            <input type="radio" name="answer" value="a" id="a" required>
                            <label for="a"><?= htmlspecialchars($currentQuestion['a']) ?></label>
                        </li>
                        <li>
                            <input type="radio" name="answer" value="b" id="b">
                            <label for="b"><?= htmlspecialchars($currentQuestion['b']) ?></label>
                        </li>
                        <li>
                            <input type="radio" name="answer" value="c" id="c">
                            <label for="c"><?= htmlspecialchars($currentQuestion['c']) ?></label>
                        </li>
                        <li>
                            <input type="radio" name="answer" value="d" id="d">
                            <label for="d"><?= htmlspecialchars($currentQuestion['d']) ?></label>
                        </li>
                    </ul>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
