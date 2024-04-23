<?php
session_start(); // 세션 시작

$data = include('data_process.php');

// POST로부터 이메일과 비밀번호 가져오기
$id = $_POST['id'];
$password = $_POST['pwd'];

// 사용자 검증 쿼리
$sql = "SELECT * FROM member WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 사용자가 존재하는 경우
    $row = $result->fetch_assoc();
    if ($password === $row['pwd']) {
        $_SESSION['loggedIn'] = true; // 세션을 이용해 로그인 상태 설정
        header("Location: ./index.php");
        exit();
    } else {
        // 비밀번호 불일치
        echo "<script>
                alert('로그인 실패: 비밀번호가 일치하지 않습니다.');
                window.location.href='../index.html';
              </script>";
        exit();
    }
} else {
    // 이메일 불일치
    echo "<script>
            alert('로그인 실패: 등록되지 않은 ID 입니다.');
            window.location.href='../index.html';
          </script>";
    exit();
}

$conn->close();
?>
