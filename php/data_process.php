<?php
include('C:/xampp/htdocs/meta/config.php'); // 환경 변수 로드

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("연결 실패: " . mysqli_connect_error());
}

$table = isset($_GET['table']) ? $_GET['table'] : '';

$query = "";
if ($table == "word") {
    $query = "SELECT * FROM word";
}
elseif ($table == "speak") {
    $query = "SELECT * FROM speak";
}
elseif ($table == "grade") {
    $query = "SELECT * FROM grade";
}
elseif ($table == "member") {
    $query = "SELECT * FROM member";
}
elseif ($table == "ingame") {
    $query = "SELECT * FROM ingame";
}

$result = false; // 초기값 설정
if (!empty($query)) {
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("쿼리 실패: " . mysqli_error($conn));
    }
}

$rows = []; // 데이터를 저장할 배열
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
}

// 사용될 변수들을 반환
return [
    'table' => $table,
    'rows' => $rows
];
?>
