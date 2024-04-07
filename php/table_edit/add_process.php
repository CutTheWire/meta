<?php
include '../data_process.php'; // 데이터베이스 연결 설정 포함

// 테이블 이름 받기
$tableName = isset($_GET['table']) ? $_GET['table'] : '';

// 컬럼 정보 및 타입 가져오기
$columnsQuery = "SHOW COLUMNS FROM " . $tableName;
$result = mysqli_query($conn, $columnsQuery);
$columns = [];
$columnTypes = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $columns[] = $row['Field'];
        $columnTypes[$row['Field']] = $row['Type'];
    }
} else {
    die("Error retrieving column names: " . mysqli_error($conn));
}

// 폼 데이터 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $insertQuery = "INSERT INTO " . $tableName . " (";
    $insertQuery .= implode(", ", $columns) . ") VALUES (";
    $insertQuery .= rtrim(str_repeat('?, ', count($columns)), ', ') . ")";

    $stmt = mysqli_prepare($conn, $insertQuery);
    
    $bindParams = [];
    $types = str_repeat('s', count($columns));
    $bindParams[] = &$types;
    foreach ($columns as $column) {
        // 시간 관련 컬럼이라면 현재 시간으로 설정
        if (stripos($columnTypes[$column], 'date') !== false || stripos($columnTypes[$column], 'time') !== false) {
            $currentTime = date('Y-m-d H:i:s');
            $bindParams[] = &$currentTime;
        } else {
            $bindParams[] = &$_POST[$column];
        }
    }
    
    call_user_func_array([$stmt, 'bind_param'], $bindParams);
    
    if (mysqli_stmt_execute($stmt)) {
        // 데이터 추가 성공 메시지와 함께 JavaScript를 사용하여 2초 후 리디렉션
        echo "<script>alert('새로운 레코드가 성공적으로 추가되었습니다.'); window.location.href = '../index.php?table=" . urlencode($tableName) . "';</script>";
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit;
    
}


// 입력 폼 생성
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>데이터 추가: <?= htmlspecialchars($tableName) ?></title>
    <link rel="stylesheet" href="../../CSS/add_style.css">
</head>
<body>
    <div class="container">
        <h1>데이터 추가: <?= htmlspecialchars($tableName) ?></h1>
        <form action="add_process.php?table=<?= htmlspecialchars($tableName) ?>" method="post">
            <section>
                <?php foreach ($columns as $column): ?>
                    <div class="form-group">
                        <label for="<?= $column ?>"><?= htmlspecialchars($column) ?>:</label>
                        <?php
                        // 시간 관련 컬럼인 경우 현재 시간을 기본값으로 설정
                        if (stripos($columnTypes[$column], 'date') !== false || stripos($columnTypes[$column], 'time') !== false) {
                            echo '<input type="text" id="' . $column . '" name="' . $column . '" value="' . date('Y-m-d H:i:s') . '">';
                        } else {
                            echo '<input type="text" id="' . $column . '" name="' . $column . '">';
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            </section>
            <button type="submit">추가</button>
        </form>
    </div>
</body>
</html>
