<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>언어별 문제</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1e1e1e;
            margin: 0;
            padding: 20px;
            color: #d4d4d4;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }

        .admin-container, .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #2d2d2d;
            border: 1px solid #3c3c3c;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        h1 {
            color: #d4d4d4;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #3c3c3c;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #3e3e3e;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"] {
            flex: 1;
            margin-right: 10px;
            padding: 10px;
            border: 1px solid #3c3c3c;
            border-radius: 4px;
            font-size: 14px;
            background-color: #1e1e1e;
            color: #d4d4d4;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 10px auto;
        }

        button:hover {
            background-color: #0056b3;
        }

        #languageSelection {
            display: none;
        }

        .question-box {
            background-color: #3a3a3a;
            border: 1px solid #4a4a4a;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
        }
    </style>
    <script>
        function showLanguageSelection() {
            const languageSelection = document.getElementById('languageSelection');
            languageSelection.style.display = 'block';
        }

        function showQuestionForm() {
            const problemLanguage = document.querySelector('input[name="problemLanguage"]:checked');
            const optionLanguage = document.querySelector('input[name="optionLanguages"]:checked');

            if (!problemLanguage) {
                alert('문제 언어를 선택해야 합니다.');
                return;
            }

            if (!optionLanguage) {
                alert('하나의 선택지 언어를 선택해야 합니다.');
                return;
            }

            window.location.href = `study.php?problemLanguage=${problemLanguage.value}&optionLanguage=${optionLanguage.value}`;
        }

        function toggleOptionLanguages() {
            const problemLanguage = document.querySelector('input[name="problemLanguage"]:checked').value;
            const optionLanguages = document.querySelectorAll('input[name="optionLanguages"]');

            optionLanguages.forEach(option => {
                if (option.value === problemLanguage) {
                    option.disabled = true;
                    option.checked = false;
                } else {
                    option.disabled = false;
                }
            });
        }
    </script>
    <script>
        function showLanguageSelection() {
            const languageSelection = document.getElementById('languageSelection');
            languageSelection.style.display = 'block';
        }

        function showQuestionForm() {
            const problemLanguage = document.querySelector('input[name="problemLanguage"]:checked');
            const optionLanguage = document.querySelector('input[name="optionLanguages"]:checked');

            if (!problemLanguage) {
                alert('문제 언어를 선택해야 합니다.');
                return;
            }

            if (!optionLanguage) {
                alert('하나의 선택지 언어를 선택해야 합니다.');
                return;
            }

            window.location.href = `study.php?problemLanguage=${problemLanguage.value}&optionLanguage=${optionLanguage.value}`;
        }

        function toggleOptionLanguages() {
            const problemLanguage = document.querySelector('input[name="problemLanguage"]:checked').value;
            const optionLanguages = document.querySelectorAll('input[name="optionLanguages"]');

            optionLanguages.forEach(option => {
                if (option.value === problemLanguage) {
                    option.disabled = true;
                    option.checked = false;
                } else {
                    option.disabled = false;
                }
            });
        }
    </script>
</head>
<body>
    <h1>언어를 선택하세요</h1>
    <button onclick="showLanguageSelection()">문제 언어 선택</button>

    <div id="languageSelection" style="display:none;">
        <label>문제 언어:</label><br>
        <input type="radio" name="problemLanguage" value="kl" onclick="toggleOptionLanguages()"> 한국어<br>
        <input type="radio" name="problemLanguage" value="cl" onclick="toggleOptionLanguages()"> 중국어<br>
        <input type="radio" name="problemLanguage" value="el" onclick="toggleOptionLanguages()"> 영어<br>
        <input type="radio" name="problemLanguage" value="rl" onclick="toggleOptionLanguages()"> 러시아어<br>
        <br><br>

        <label>선택지 언어:</label><br>
        <input type="radio" name="optionLanguages" value="kl"> 한국어<br>
        <input type="radio" name="optionLanguages" value="cl"> 중국어<br>
        <input type="radio" name="optionLanguages" value="el"> 영어<br>
        <input type="radio" name="optionLanguages" value="rl"> 러시아어<br>
        <br>
        <button onclick="showQuestionForm()">문제 생성</button>
    </div>
    <?php
    if (isset($_GET['problemLanguage']) && isset($_GET['optionLanguage'])) {
        include('C:/xampp/htdocs/meta/config.php'); // 환경 변수 로드

        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $database = $_ENV['DB_NAME'];

        $conn = mysqli_connect($host, $user, $password, $database);
        if (!$conn) {
            die("연결 실패: " . mysqli_connect_error());
        }

        $problemLanguage = $_GET['problemLanguage'];
        $optionLanguage = $_GET['optionLanguage'];

        // 문제 20개 랜덤 추출
        $sql = "SELECT id, $problemLanguage, $optionLanguage FROM word ORDER BY RAND() LIMIT 20";
        $result = $conn->query($sql);

        // 문제 출력
        $totalQuestions = 0;
        echo "<h1>4지선다 객관식 문제</h1>";
        echo "<form action='check_answers.php' method='post'>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $totalQuestions++;
                $id = $row["id"];
                $question = $row[$problemLanguage];
                $answer = $row[$optionLanguage];
                $options = array($answer);

                // 선택지 언어로 3개의 추가 선택지 추출, 정답을 제외하고
                $sql_option = "SELECT $optionLanguage FROM word WHERE id <> '$id' AND $optionLanguage <> '$answer' ORDER BY RAND() LIMIT 3";
                $result_option = $conn->query($sql_option);
                if ($result_option) {
                    while ($row_option = $result_option->fetch_assoc()) {
                        $options[] = $row_option[$optionLanguage];
                    }
                }
                shuffle($options);
                echo "<h3>문제 $totalQuestions. $question</h3>";
                echo "<input type='hidden' name='questions[$id][question]' value='$question'>";
                echo "<input type='hidden' name='questions[$id][answer]' value='$answer'>";
                foreach ($options as $option) {
                    echo "<input type='radio' name='questions[$id][selected_option]' value='$option'> $option<br>";
                }
                echo "<br>";
            }
        } else {
            echo "데이터가 없습니다.";
        }
        echo "<button type='submit'>전체 제출</button>";
        echo "</form>";

        // 데이터베이스 연결 종료
        $conn->close();
    }
    ?>
</body>
</html>
