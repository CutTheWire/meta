<?php
include '../data_process.php'; // 데이터베이스 연결 설정 포함

$tableName = isset($_GET['table']) ? $_GET['table'] : '';
$recordId = isset($_GET['id']) ? $_GET['id'] : ''; // 수정할 레코드의 ID

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

// 기존 데이터 조회
if (!empty($recordId)) {
    $query = "SELECT * FROM " . $tableName . " WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $recordId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $existingData = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
} else {
    die("No record ID provided.");
}

// 폼 데이터 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 업데이트 로직 구현
    $updateQuery = "UPDATE " . $tableName . " SET ";
    foreach ($columns as $column) {
        $updateQuery .= $column . "=?, ";
    }
    $updateQuery = rtrim($updateQuery, ", ") . " WHERE id=?";
    
    $stmt = mysqli_prepare($conn, $updateQuery);
    
    $bindParams = [];
    $types = str_repeat('s', count($columns)) . 's'; // 마지막 's'는 id의 타입
    $bindParams[] = &$types;
    foreach ($columns as $column) {
        $bindParams[] = &$_POST[$column];
    }
    $bindParams[] = &$recordId; // WHERE 절에 사용될 id 값
    
    call_user_func_array([$stmt, 'bind_param'], $bindParams);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('레코드가 성공적으로 수정되었습니다.'); window.location.href = '../index.php?table=" . urlencode($tableName) . "';</script>";
    } else {
        echo "Error: " . $updateQuery . "<br>" . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit;
}

// 수정 폼 생성
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>데이터 수정: <?= htmlspecialchars($tableName) ?></title>
    <link rel="stylesheet" href="../../CSS/add_style.css">
</head>
<body>
    <div class="container">
        <h1>데이터 수정: <?= htmlspecialchars($tableName) ?></h1>
        <form action="edit_process.php?table=<?= htmlspecialchars($tableName) ?>&id=<?= htmlspecialchars($recordId) ?>" method="post">
            <section>
                <?php foreach ($columns as $column): ?>
                    <div class="form-group">
                        <label for="<?= $column ?>"><?= htmlspecialchars($column) ?>:</label>
                        <?php
                        // 시간 관련 컬럼인 경우 현재 시간을 기본값으로 설정할 수 있으나, 여기서는 기존 값을 유지
                        if (stripos($columnTypes[$column], 'date') !== false || stripos($columnTypes[$column], 'time') !== false) {
                            echo '<input type="text" id="' . $column . '" name="' . $column . '" value="' . (isset($existingData[$column]) ? htmlspecialchars($existingData[$column]) : '') . '">';
                        } else {
                            echo '<input type="text" id="' . $column . '" name="' . $column . '" value="' . (isset($existingData[$column]) ? htmlspecialchars($existingData[$column]) : '') . '">';
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            </section>
            <button type="submit">수정</button>
        </form>
    </div>
</body>
</html>

