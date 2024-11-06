<?php
// 檢查表單是否通過 GET 方法提交
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // 取得並檢查各欄位的資料
    $gender = isset($_GET['gender']) ? $_GET['gender'] : '未指定';
    $account = isset($_GET['account']) ? $_GET['account'] : '未選擇';
    $vehicle_type = isset($_GET['vehicle_type']) ? htmlspecialchars($_GET['vehicle_type']) : '未填寫';
    $type = isset($_GET['type']) ? $_GET['type'] : '未指定';
    $price = isset($_GET['price']) ? $_GET['price'] : '未選擇';

    // 將拍攝類別與收費標準轉換為易讀的文字
    $type_text = ($type === 's') ? '靜態攝影' : '動態攝影';
    $price_text = ($price === 'daily') ? '靜態精修 30張 $500' : '動態Rolling 10張 $300';

    // 顯示結果
    echo "<h2>表單提交結果：</h2>";
    echo "<p><strong>性別：</strong>" . ($gender === 'M' ? '男生' : '女生') . "</p>";
    echo "<p><strong>預約日期：</strong>" . htmlspecialchars($account) . "</p>";
    echo "<p><strong>車型、車種：</strong>" . $vehicle_type . "</p>";
    echo "<p><strong>拍攝類別：</strong>" . $type_text . "</p>";
    echo "<p><strong>收費標準：</strong>" . $price_text . "</p>";

    // 連接 MySQL 資料庫
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "photography";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // 檢查連接是否成功
    if ($conn->connect_error) {
        die("資料庫連接失敗：" . $conn->connect_error);
    }

    // 插入資料到資料庫
    $sql = "INSERT INTO bookings (gender, account, vehicle_type, type, price) VALUES ('$gender', '$account', '$vehicle_type', '$type', '$price')";
    
    if ($conn->query($sql) === TRUE) {
        echo "表單資料已成功儲存到資料庫！";
    } else {
        echo "錯誤：" . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "<p>表單未提交，請重新填寫。</p>";
}
?>
