<?php
include '../data_process.php'; // 데이터베이스 연결 설정 포함

// POST로 받은 데이터를 변수에 저장
$irum = $_POST['irum'];
$id = $_POST['id'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$pwd = $_POST['pwd']; // 실제 서비스에서는 비밀번호를 해시 처리하는 것이 좋습니다.
$location = $_POST['location'];
$date = date("Y-m-d"); // 현재 날짜

// SQL 쿼리 준비
$sql = "INSERT INTO member (irum, id, nickname, email, pwd, date, location, role)
VALUES (?, ?, ?, ?, ?, ?, ?, 'user')";

// 쿼리 준비
$stmt = $conn->prepare($sql);

// 변수를 쿼리에 바인딩
$stmt->bind_param("sssssss", $irum, $id, $nickname, $email, $pwd, $date, $location);

// 쿼리 실행
if ($stmt->execute()) {
    echo "회원가입 성공!";
} else {
    echo "오류: " . $stmt->error;
}
// 기존 회원가입 코드 이후에 추가
$verification_code = $_POST['verification_code'];

// 이메일과 인증 코드를 검증
$stmt = $conn->prepare("SELECT * FROM email_verification WHERE email=? AND verification_code=? AND expiration > NOW()");
$stmt->bind_param("ss", $email, $verification_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // 인증 코드가 일치하고 만료되지 않음
    // 회원가입 처리 로직 실행 (위에 제공된 회원가입 코드)
} else {
    echo "<script>alert('인증 코드가 일치하지 않거나 만료되었습니다.'); history.go(-1);</script>";
    exit;
}

// 연결 종료
$stmt->close();
$conn->close();
?>
