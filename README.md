# xampp


```
 📦meta 
 ┣ 📂CSS
 ┃ ┣ 📜add_style.css
 ┃ ┣ 📜sign_in.css
 ┃ ┣ 📜style.css
 ┃ ┗ 📜table_style.css
 ┃
 ┣ 📂JS
 ┃ ┗ 📜script.js
 ┃
 ┣ 📂php
 ┃ ┣ 📂table_edit
 ┃ ┃ ┣ 📜add_process.php
 ┃ ┃ ┣ 📜delete_process.php
 ┃ ┃ ┣ 📜edit_process.php
 ┃ ┃ ┣ 📜send_verification_code.php
 ┃ ┃ ┗ 📜signup_process.php
 ┃ ┃
 ┃ ┣ 📂table_view
 ┃ ┃ ┣ 📜grade_table.php
 ┃ ┃ ┣ 📜ingame_table.php
 ┃ ┃ ┣ 📜member_table.php
 ┃ ┃ ┣ 📜speak_table.php
 ┃ ┃ ┗ 📜word_table.php
 ┃ ┃
 ┃ ┣ 📜auth_check.php
 ┃ ┣ 📜data_process.php
 ┃ ┣ 📜index.php
 ┃ ┣ 📜sign_in.php
 ┃ ┗ 📜sign_out.php
 ┃ 
 ┣ 📂vendor
 ┃ ┗ 📜autoload.php
 ┃ 
 ┣ 📜.env
 ┣ 📜.gitignore
 ┣ 📜composer.json
 ┣ 📜composer.lock
 ┣ 📜config.php
 ┗ 📜index.html
```

# 프로젝트 구조 설명

이 구조는 웹 프로젝트의 일반적인 디렉토리 및 파일 구성을 나타냅니다. 각 디렉토리와 파일은 웹 사이트의 다양한 기능과 스타일을 관리하는 데 사용됩니다.

## 📦meta
웹 프로젝트의 메인 디렉토리로, CSS, JS, PHP, 그리고 기타 설정 파일들을 포함하고 있습니다.

### 📂CSS
웹 페이지의 스타일을 정의하는 CSS 파일들을 저장하는 디렉토리입니다.
- **add_style.css**: 추가 기능 관련 스타일
- **sign_in.css**: 로그인 페이지 스타일
- **style.css**: 전체 사이트의 기본 스타일
- **table_style.css**: 테이블 스타일

### 📂JS
웹 페이지의 동작을 구현하는 JavaScript 파일들을 저장하는 디렉토리입니다.
- **script.js**: 사이트 전체에 걸쳐 사용되는 스크립트

### 📂php
서버 측 스크립트와 기능들을 구현하는 PHP 파일들을 저장하는 디렉토리입니다.
- **table_edit**: 데이터 수정 관련 스크립트
  - **add_process.php**: 데이터 추가 처리
  - **delete_process.php**: 데이터 삭제 처리
  - **edit_process.php**: 데이터 수정 처리
  - **send_verification_code.php**: 인증 코드 전송 처리
  - **signup_process.php**: 회원가입 처리
- **table_view**: 데이터 조회 관련 스크립트
  - **grade_table.php**: 성적 테이블 조회
  - **ingame_table.php**: 게임 내 정보 조회
  - **member_table.php**: 회원 정보 조회
  - **speak_table.php**: 발언 정보 조회
  - **word_table.php**: 단어 정보 조회
- **auth_check.php**: 인증 확인
- **data_process.php**: 데이터 처리 일반
- **index.php**: 메인 페이지
- **sign_in.php**: 로그인 처리
- **sign_out.php**: 로그아웃 처리

### 📂vendor
외부 라이브러리와 프레임워크들을 포함하는 디렉토리입니다.
- **autoload.php**: 클래스 자동 로딩

### 📜.env
환경 변수들을 저장하는 파일로, 데이터베이스 연결 정보 등 중요한 설정을 포함합니다.

### 📜.gitignore
Git 버전 관리에서 제외할 파일 및 디렉토리 목록을 지정합니다.

### 📜composer.json, composer.lock
PHP의 의존성 관리 도구인 Composer 관련 설정 파일입니다.

### 📜config.php
사이트의 전반적인 설정을 포함하는 파일입니다.

### 📜index.html
웹 사이트의 메인 페이지 HTML 파일입니다.

# File : .env add
```.env
DB_HOST= your_host
DB_USER= your_root
DB_PASSWORD= your_pw
DB_NAME= your_DB
```

# DB : google drive link
```.sql
CREATE DATABASE metaclass default CHARACTER SET UTF8; 
```
[METACLASS.SQL](https://drive.google.com/file/d/16yQWxhwA5o9P3LN-CX1HzSg8DYgeXkyo/view?usp=sharing)

# Data : google drive link

[CSV.ZIP](https://drive.google.com/file/d/12nmInyQAST9wkF4pD_RqzmE6EuV_mubg/view?usp=sharing)

[WORD.CSV](https://drive.google.com/file/d/1uFx9eAFEpNuTpa7_fz_zOPLvgJ7J7KYS/view?usp=sharing)

[SPEAK.CSV](https://drive.google.com/file/d/1uKNTpH0CWmO_-WMyAufIk8OkG9F_GyVj/view?usp=sharing)

[MEMBER.CSV](https://drive.google.com/file/d/1yxDo4e6aO9xKGyPFj77uqm3kNzH9dQM-/view?usp=sharing)

[INGAME.CSV](https://drive.google.com/file/d/1z0MbfCKsqCSKKl9Iu8H-WNT4wDtt0jaH/view?usp=sharing)

[GRADE.CSV](https://drive.google.com/file/d/1z1VLPAPbHDxCP-nqrruRI-TQ9La4zmjG/view?usp=sharing)
