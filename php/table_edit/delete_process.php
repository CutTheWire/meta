<?php
// 데이터베이스 연결
require_once '../data_process.php';

if (isset($_POST['delete'])) {
    $tableName = $_POST['table']; // 삭제할 테이블 이름
    $selectedIds = $_POST['selected']; // 삭제할 항목의 ID 배열

    // 배열이 비어 있지 않은지 확인
    if (!empty($selectedIds)) {
        // 각 ID를 따옴표로 묶어 안전하게 처리
        $safeIds = array_map(function($id) use ($conn) {
            return "'" . mysqli_real_escape_string($conn, $id) . "'";
        }, $selectedIds);
        
        $ids = implode(',', $safeIds);
        $sql = "DELETE FROM `$tableName` WHERE id IN ($ids)";
        
        if ($conn->query($sql) === TRUE) {
            echo "레코드가 성공적으로 삭제되었습니다.";
        } else {
            echo "오류: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "삭제할 항목이 유효하지 않습니다.";
    }
    
    $conn->close();
} else {
    echo "삭제할 항목이 선택되지 않았습니다.";
}


// 페이지 리디렉션
header("Location: ../index.php?table=" . urlencode($tableName));

?>
