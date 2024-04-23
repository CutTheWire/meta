<?php
session_start(); // 세션 시작
// 로그인 상태 확인
if (!isset($_SESSION['user_id'])) { // 'user_id'는 로그인 시 세션에 저장된 사용자 식별 정보입니다.
    // 로그인하지 않은 경우 로그인 페이지로 리다이렉트
    header("Location: ../sign_in.php");
    exit(); // 추가적인 코드 실행 방지
}
?>
