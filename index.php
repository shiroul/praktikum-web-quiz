<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? 'Unknown';
    $score = $_POST['score'] ?? 0;

    echo "<h1>Thank you, $name!</h1>";
    echo "<p>Your score: $score</p>";
    exit; 
}
?>
<!-- POST METHOD DI AKHIR!!! -->
 <!-- POST METHOD DI AKHIR!!! -->
  <!-- POST METHOD DI AKHIR!!! -->
   <!-- POST METHOD DI AKHIR!!! -->
    <!-- POST METHOD DI AKHIR!!! -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <div id="name-form">
        <h2>Fill Form Below To Start The Quiz</h2>
        <form id="start-form">
            <input type="text" id="username" name="username" placeholder="Your Name" required>
            <button type="submit">Start Quiz</button>
        </form>
    </div>

    <div class="quiz-container" id="quiz" style="display: none;">
        <div class="quiz-header">
            <h2 id="question">Question Text</h2>
            <ul>
                <li>
                    <input type="radio" name="answer" id="a" class="answer">
                    <label for="a" id="a_text">Answer</label>
                </li>
                <li>
                    <input type="radio" name="answer" id="b" class="answer">
                    <label for="b" id="b_text">Answer</label>
                </li>
                <li>
                    <input type="radio" name="answer" id="c" class="answer">
                    <label for="c" id="c_text">Answer</label>
                </li>
                <li>
                    <input type="radio" name="answer" id="d" class="answer">
                    <label for="d" id="d_text">Answer</label>
                </li>
            </ul>
        </div>
        <button id="submit">SUBMIT</button>
    </div>

    <script src="./main.js"></script>
</body>
</html>
