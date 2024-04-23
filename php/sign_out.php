<?php
session_start(); // 세션 시작

// 세션 변수와 세션 파괴
$_SESSION = array(); // 모든 세션 변수 제거
session_destroy(); // 세션 파괴

setcookie('loggedIn', '', time() - 3600, "/"); // 쿠키 삭제
header('Location: ../index.html');
exit();
?>
