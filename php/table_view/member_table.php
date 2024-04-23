<?php
function createMemberTable($rows) {
    $name = 'member';
    // 경로 설정 예시 (실제 프로젝트에서는 외부 설정 파일 등에서 관리)
    $deleteProcessPath = '../php/table_edit/delete_process.php';
    $addProcessPath = 'table_edit/add_process.php';
    $editProcessPath = 'table_edit/edit_process.php';

    echo "<form action='" . htmlspecialchars($deleteProcessPath) . "' method='post'>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th><input type='checkbox' id='selectAll' onclick='toggleSelectAll(this)'></th>"; // 전체 선택 체크박스 추가
    echo "<th>이름</th>";
    echo "<th>ID</th>";
    echo "<th>별명</th>";
    echo "<th>이메일</th>";
    echo "<th>비밀번호</th>";
    echo "<th>가입일</th>";
    echo "<th>위치</th>";
    echo "<th>권한</th>";
    echo "<th></th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='selected[]' value='" . htmlspecialchars($row['id']) . "'></td>";
        echo "<td>" . htmlspecialchars($row['irum']) . "</td>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nickname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pwd']) . "</td>";
        echo "<td>" . date('Y-m-d', strtotime($row['date'])) . "</td>";
        echo "<td>" . htmlspecialchars($row['location']) . "</td>";
        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
        echo "<td><button type='button' onclick='location.href=\"" . htmlspecialchars($editProcessPath) . "?table=" . htmlspecialchars($name) . "&id=" . htmlspecialchars($row['id']) . "\"'>수정</button></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "<br>";
    echo "<input type='hidden' name='table' value='$name'>";
    echo "<button type='submit' name='delete' value='delete' style='margin-right: 5px;'>선택 삭제</button>";
    echo "<button type='button' style='margin-right: 5px;' onclick='location.href=\"" . htmlspecialchars($addProcessPath) . "?table=$name\"'>추가</button>";
    echo "</form>";

    // JavaScript 함수 추가
    echo "<script>
    function toggleSelectAll(source) {
        var checkboxes = document.querySelectorAll('input[type=\"checkbox\"][name=\"selected[]\"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
    </script>";
}
?>