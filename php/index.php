<?php
session_start(); // 세션 시작

// 로그인 상태가 아니면 로그인 페이지로 리다이렉트
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: ../index.html'); // 로그인 페이지로 리다이렉트
    exit();
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <title>META</title>
    <link rel="stylesheet" href="../CSS/table_style.css">
    <script src="../JS/script.js"></script>
    <style>
        .table-name {
            color: #007bff; /* 테이블 이름에 적용할 색상 */
            margin-left: 10px; /* h1 태그와의 간격 조정 */
            display: inline; /* h1 태그와 같은 줄에 표시 */
        }
    </style>
</head>
<body>
    <button style="float: right;" onclick="window.location.href='sign_out.php';">Sign out</button>
    <br><br>
    <div class="container">
        <?php $data = include('data_process.php'); ?>
        <h1>테이블 관리<?php if (!empty($data['table'])) { echo "<span class='table-name'>" . htmlspecialchars($data['table']) . "</span>"; } ?></h1>
        <form action="" method="get">
            <input type="submit" name="table" value="word">
            <input type="submit" name="table" value="speak">
            <input type="submit" name="table" value="grade">
            <input type="submit" name="table" value="ingame">
            <input type="submit" name="table" value="member">
        </form>

        <?php
        // 페이지 번호를 가져옵니다. 기본값은 1입니다.
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        // 한 페이지에 표시할 항목 수입니다.
        $perPage = 20;

        if (!empty($data['table'])) {
            $tableName = $data['table'];
            $filePath = "table_view/{$tableName}_table.php";
            if (file_exists($filePath)) {
                include($filePath);
                $functionName = "Create".ucfirst($tableName)."Table";
                if (function_exists($functionName)) {
                    // 전체 데이터 수
                    $totalRows = count($data['rows']);
                    // 총 페이지 수
                    $totalPages = ceil($totalRows / $perPage);
                    // 현재 페이지에 표시할 데이터 슬라이스
                    $currentData = array_slice($data['rows'], ($page - 1) * $perPage, $perPage);
                    // 데이터 표시 함수 호출
                    $functionName($currentData);
                    
                    // 페이지네이션 링크
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo "<a href='?table=$tableName&page=$i'>$i</a> ";
                    }
                } else {
                    echo "함수가 존재하지 않습니다: {$functionName}";
                }
            } else {
                echo "파일이 존재하지 않습니다: {$filePath}";
            }
        }
        ?>
    </div>
</body>
</html>
