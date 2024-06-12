<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>퀴즈 결과</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .result-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $questions = $_POST['questions'];
            $totalQuestions = count($questions);
            $correctAnswers = 0;

            foreach ($questions as $id => $question) {
                if (isset($question['selected_option']) && $question['selected_option'] === $question['answer']) {
                    $correctAnswers++;
                }
            }

            echo "<h1>결과</h1>";
            echo "<p>총 $totalQuestions 문제 중 $correctAnswers 문제 정답!</p>";
        }
        ?>
    </div>
</body>
</html>
