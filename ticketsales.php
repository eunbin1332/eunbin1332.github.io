<?php
// DB 연결
$conn = new mysqli("localhost", "root", "", "classscore");
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 테이블이 존재하면 삭제
$sql = "DROP TABLE IF EXISTS tickets";
$conn->query($sql);

// 테이블 재생성
$sql = "
CREATE TABLE IF NOT EXISTS tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50),
    child_price INT,
    child_quantity INT DEFAULT 0,
    adult_price INT,
    adult_quantity INT DEFAULT 0,
    note VARCHAR(100),
    customer_name VARCHAR(100),
    total_price INT DEFAULT 0,
    purchased_at DATETIME DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
$conn->query($sql);

$conn->close();
?>

<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; }
        .input-wrap {
            width: 800px;
            margin-left: 0 auto;
            position: relative;
        }
        h1 { text-align: center; }
        th, td { text-align: center; }
        table {
            border: 2px solid #000;
            margin-left: 20px auto;
            border-collapse: collapse;
        }
        td, th {
            border: 2px solid #444;
            padding: 8px;
        }
        .result { text-align: left; margin-top: 30px; }
        .top-row {
            display: flex;
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 20px; 
        }
    </style>
</head>
<body>

<div class="input-wrap">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="top-row">
            <div>고객성명: <input type="text" name="고객성명" required></div>
            <button type="submit" class="sum-button">합계 </button>
        </div>

        <table width="800">
            <thead>
                <tr>
                    <th>No</th>
                    <th>구분</th>
                    <th colspan="2">어린이 </th>
                    <th colspan="2">어른 </th>
                    <th>비고</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>입장권</td>
                    <td>7,000</td>
                    <td><select name="ticket1_child"><?php for ($i=0; $i<=10; $i++) echo "<option value='$i'>$i</option>"; ?></select></td>
                    <td>10,000</td>
                    <td><select name="ticket1_adult"><?php for ($i=0; $i<=10; $i++) echo "<option value='$i'>$i</option>"; ?></select></td>
                    <td>입장</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>BIG3</td>
                    <td>12,000</td>
                    <td><select name="ticket2_child"><?php for ($i=0; $i<=10; $i++) echo "<option value='$i'>$i</option>"; ?></select></td>
                    <td>16,000</td>
                    <td><select name="ticket2_adult"><?php for ($i=0; $i<=10; $i++) echo "<option value='$i'>$i</option>"; ?></select></td>
                    <td>입장+놀이자유</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>자유이용권</td>
                    <td>21,000</td>
                    <td><select name="ticket3_child"><?php for ($i=0; $i<=10; $i++) echo "<option value='$i'>$i</option>"; ?></select></td>
                    <td>26,000</td>
                    <td><select name="ticket3_adult"><?php for ($i=0; $i<=10; $i++) echo "<option value='$i'>$i</option>"; ?></select></td>
                    <td>입장+놀이자유</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>연간이용권</td>
                    <td>70,000</td>
                    <td><select name="ticket4_child"><?php for ($i=0; $i<=10; $i++) echo "<option value='$i'>$i</option>"; ?></select></td>
                    <td>90,000</td>
                    <td><select name="ticket4_adult"><?php for ($i=0; $i<=10; $i++) echo "<option value='$i'>$i</option>"; ?></select></td>
                    <td>입장+놀이자유</td>
                </tr>
            </tbody>
        </table>
    </form>

    <div class="result">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // DB 연결 (다시 연결 필요)
            $conn = new mysqli("localhost", "root", "", "classscore");
            $conn->set_charset("utf8mb4");

            if ($conn->connect_error) {
                die("연결 실패: " . $conn->connect_error);
            }

            // 고객명 가져오기
            $name = $_POST["고객성명"];

            // 각 티켓 수량 가져오기
            $ticket1_child = isset($_POST["ticket1_child"]) ? $_POST["ticket1_child"] : 0;
            $ticket1_adult = isset($_POST["ticket1_adult"]) ? $_POST["ticket1_adult"] : 0;
            $ticket2_child = isset($_POST["ticket2_child"]) ? $_POST["ticket2_child"] : 0;
            $ticket2_adult = isset($_POST["ticket2_adult"]) ? $_POST["ticket2_adult"] : 0;
            $ticket3_child = isset($_POST["ticket3_child"]) ? $_POST["ticket3_child"] : 0;
            $ticket3_adult = isset($_POST["ticket3_adult"]) ? $_POST["ticket3_adult"] : 0;
            $ticket4_child = isset($_POST["ticket4_child"]) ? $_POST["ticket4_child"] : 0;
            $ticket4_adult = isset($_POST["ticket4_adult"]) ? $_POST["ticket4_adult"] : 0;
            
            // 가격 배열
            $price = [
                'ticket1_child' => 7000,
                'ticket1_adult' => 10000,
                'ticket2_child' => 12000,
                'ticket2_adult' => 16000,
                'ticket3_child' => 21000,
                'ticket3_adult' => 26000,
                'ticket4_child' => 70000,
                'ticket4_adult' => 90000
            ];

            // 합계 계산
            $total = 
                $ticket1_child * $price['ticket1_child'] +
                $ticket1_adult * $price['ticket1_adult'] +
                $ticket2_child * $price['ticket2_child'] +
                $ticket2_adult * $price['ticket2_adult'] +
                $ticket3_child * $price['ticket3_child'] +
                $ticket3_adult * $price['ticket3_adult'] +
                $ticket4_child * $price['ticket4_child'] +
                $ticket4_adult * $price['ticket4_adult'];

            // 시간 설정
            date_default_timezone_set('Asia/Seoul');
            $time = date("Y년 m월 d일 A h:i");
            $time = str_replace("AM", "오전", $time);
            $time = str_replace("PM", "오후", $time);
            $time .= "분";

            // 결과 출력
            echo "<p><strong>$time</strong></p>";
            echo "<p><strong>$name</strong> 고객님 감사합니다.</p>";

            if ($ticket1_child > 0) echo "<p>어린이 입장권 {$ticket1_child}매</p>";
            if ($ticket1_adult > 0) echo "<p>어른 입장권 {$ticket1_adult}매</p>";
            if ($ticket2_child > 0) echo "<p>어린이 BIG3 {$ticket2_child}매</p>";
            if ($ticket2_adult > 0) echo "<p>어른 BIG3 {$ticket2_adult}매</p>";
            if ($ticket3_child > 0) echo "<p>어린이 자유이용권 {$ticket3_child}매</p>";
            if ($ticket3_adult > 0) echo "<p>어른 자유이용권 {$ticket3_adult}매</p>";
            if ($ticket4_child > 0) echo "<p>어린이 연간이용권 {$ticket4_child}매</p>";
            if ($ticket4_adult > 0) echo "<p>어른 연간이용권 {$ticket4_adult}매</p>";

            echo "<h3>합계: " . number_format($total) . "입니다.</h3>";

            // DB에 저장
            $stmt = $conn->prepare("INSERT INTO tickets (category, child_price, child_quantity, adult_price, adult_quantity, note, customer_name, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            // Insert each ticket category and total price
            if ($ticket1_child > 0 || $ticket1_adult > 0) {
                $cat = "입장권";
                $cp = 7000;
                $ap = 10000;
                $note = "입장";
                $stmt->bind_param("siiisssi", $cat, $cp, $ticket1_child, $ap, $ticket1_adult, $note, $name, $total);
                $stmt->execute();
            }

            if ($ticket2_child > 0 || $ticket2_adult > 0) {
                $cat = "BIG3";
                $cp = 12000;
                $ap = 16000;
                $note = "입장+놀이자유";
                $stmt->bind_param("siiisssi", $cat, $cp, $ticket2_child, $ap, $ticket2_adult, $note, $name, $total);
                $stmt->execute();
            }
              if ($ticket3_child > 0 || $ticket3_adult > 0) {
                $cat = "자유이용권";
                $cp = 21000;
                $ap = 26000;
                $note = "입장+놀이자유";
                $stmt->bind_param("siiisss", $cat, $cp, $ticket3_child, $ap, $ticket3_adult, $note, $name);
                $stmt->execute();
            }

            if ($ticket4_child > 0 || $ticket4_adult > 0) {
                $cat = "연간이용권";
                $cp = 70000;
                $ap = 90000;
                $note = "입장+놀이자유";
                $stmt->bind_param("siiisss", $cat, $cp, $ticket4_child, $ap, $ticket4_adult, $note, $name);
                $stmt->execute();
            }

            // 총합을 데이터베이스에 추가하기
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</div>

</body>
</html>
