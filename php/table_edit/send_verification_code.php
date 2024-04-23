<?php
include '../data_process.php'; // 데이터베이스 연결 설정 포함

// POST로 받은 이메일을 변수에 저장
$email = $_POST['email'];

// 랜덤 인증 코드 생성
$verification_code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

// 인증 코드 만료 시간 설정 (예: 5분 후)
$expiration = date('Y-m-d H:i:s', strtotime('+5 minutes'));

// 이메일과 인증 코드, 만료 시간을 데이터베이스에 저장
$stmt = $conn->prepare("INSERT INTO email_verification (email, verification_code, expiration) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE verification_code=?, expiration=?");
$stmt->bind_param("sssss", $email, $verification_code, $expiration, $verification_code, $expiration);
if ($stmt->execute()) {
    // 이메일로 인증 코드 발송 로직 (실제 이메일 발송 코드 필요)
    // 예시는 PHPMailer 라이브러리를 사용한 코드입니다. 실제 환경에서는 이 라이브러리를 설치하고 설정해야 합니다.
    require '../PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // SMTP 서버 주소
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@example.com'; // SMTP 사용자 이름
    $mail->Password = 'your_password'; // SMTP 비밀번호
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress($email); // 수신자 이메일 주소
    $mail->isHTML(true);

    $mail->Subject = '이메일 인증 코드';
    $mail->Body    = '인증 코드는 ' . $verification_code . ' 입니다.';

    if(!$mail->send()) {
        echo '메일을 발송하지 못했습니다. ';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo '인증 코드가 발송되었습니다.';
    }
} else {
    echo "오류: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
