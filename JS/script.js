document.addEventListener('DOMContentLoaded', function() {
    // phpToMain 버튼 이벤트 리스너 설정
    var phpToMainButton = document.getElementById('phpToMain');
    if (phpToMainButton) {
        phpToMainButton.onclick = function() {
            window.location.href = '../index.html';
        };
    } else {
        console.error('phpToMain 요소를 찾을 수 없습니다.');
    }

    // goToPhp 버튼 이벤트 리스너 설정
    var MainTophpButton = document.getElementById('goToPhp');
    if (MainTophpButton) {
        MainTophpButton.onclick = function() {
            window.location.href = './php/index.php';
        };
    } else {
        console.error('goToPhp 요소를 찾을 수 없습니다.');
    }

    // 여기에 기타 DOMContentLoaded 이벤트 리스너에 포함되어야 하는 코드를 추가
    // 예: 검색 버튼 설정
    var searchButton = document.getElementById('searchButtonId'); // 예시 ID
    if (searchButton) {
        searchButton.onclick = function() {
            // 버튼 클릭 이벤트 핸들러
        };
    }

    // 기타 요소에 대한 이벤트 핸들러 설정
    var myElement = document.getElementById('myElementId');
    if (myElement) {
        myElement.onclick = function() {
            // 이벤트 핸들러
        };
    } else {
        console.log('myElementId 요소를 찾을 수 없습니다.');
    }
});

function createForm() {
    const tableName = document.getElementById('tableNameSelect').value;
    const formContainer = document.getElementById('formContainer');
    formContainer.innerHTML = ''; // 기존 폼 초기화

    // 검색 키워드를 위한 입력 필드 추가
    const searchIdInput = document.createElement('input');
    searchIdInput.type = 'text';
    searchIdInput.id = 'searchId'; // searchData 함수에서 참조할 ID 설정
    searchIdInput.placeholder = '조회 id';
    formContainer.appendChild(searchIdInput);

    // 조회하기 버튼 추가
    const searchButton = document.createElement('button');
    searchButton.textContent = '조회하기';
    searchButton.onclick = function() {
        searchData(); // 클릭 시 searchData 함수 호출
    };
    formContainer.appendChild(searchButton);

    // 버튼 사이에 줄바꿈 추가
    const lineBreak = document.createElement('br');
    formContainer.appendChild(lineBreak);

    let fields = [];

    switch(tableName) {
        case 'word':
        case 'speak':
            fields = ['id', 'kl', 'cl', 'el', 'rl', 'date'];
            break;
        case 'member':
            fields = ['irum', 'id', 'nickname', 'email', 'pwd', 'regdate', 'location'];
            break;
        case 'ingame':
            fields = ['id', 'irum', 'gsme1', 'gsme2', 'gsme3', 'gsme4', 'gsme5', 'gsme6', 'gsme7', 'total', 'avg'];
            break;
    }

    fields.forEach(field => {
        const input = document.createElement('input');
        input.type = 'text';
        input.name = field;
        input.placeholder = field;
        formContainer.appendChild(input);
    });

    // 추가하기 버튼
    const submitButton = document.createElement('button');
    submitButton.type = 'submit';
    submitButton.textContent = '추가하기';
    formContainer.appendChild(submitButton);
}

function addData() {
    const form = document.getElementById('addForm');
    const formData = new FormData(form);
    const tableName = document.getElementById('tableNameSelect').value;
    formData.append('tableName', tableName);

    // AJAX 요청 생성
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/table_edit/add_data.php", true);
    xhr.onload = function () {
        if (this.status == 200) {
            console.log(this.responseText);
            alert("데이터 추가 완료");
        }
    };

    xhr.send(formData);
}

function searchData() {
    const id = document.getElementById('searchId').value; // 검색 키워드 가져오기
    const tableName = document.getElementById('tableNameSelect').value; // 선택된 테이블 이름 가져오기

    // 유효성 검사: 테이블 이름과 검색 키워드가 모두 입력되었는지 확인
    if (!tableName || !id) {
        alert("테이블 이름과 검색 키워드를 모두 입력해주세요.");
        return;
    }

    // AJAX 요청 생성 및 설정
    var xhr = new XMLHttpRequest();
    xhr.open("GET", `../php/table_edit/search_data.php?tableName=${tableName}&id=${id}`, true);
    xhr.onload = function () {
        if (this.status == 200) {
            // 응답 처리: 이 예시에서는 응답받은 데이터를 콘솔에 출력하고 알림창을 띄움
            console.log(this.responseText); // 서버로부터 받은 응답 출력
            alert("조회 완료"); // 사용자에게 조회 완료 알림
        } else {
            // 오류 처리: 실패한 요청에 대한 처리
            alert("조회 실패: 서버에서 오류가 발생했습니다.");
        }
    };

    // 오류 처리: 네트워크 문제 등으로 요청 자체가 실패한 경우
    xhr.onerror = function () {
        alert("요청 실패: 네트워크 상태를 확인해주세요.");
    };

    // 요청 전송
    xhr.send();
}

document.addEventListener('DOMContentLoaded', function() {
    // 여기에 코드를 넣으면, DOM 요소들이 로드된 후에 실행됩니다.
    var searchButton = document.getElementById('searchButtonId'); // 예시 ID
    if (searchButton) {
        searchButton.onclick = function() {
            // 버튼 클릭 이벤트 핸들러
        };
    }
});

var myElement = document.getElementById('myElementId');
if (myElement) {
    myElement.onclick = function() {
        // 이벤트 핸들러
    };
} else {
    console.log('요소를 찾을 수 없습니다.');
}



