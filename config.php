<?php
require_once __DIR__ . '/vendor/autoload.php'; // vendor 디렉토리의 경로는 실제 프로젝트 구조에 따라 조정해야 합니다.

// 환경 변수 로드
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
?>