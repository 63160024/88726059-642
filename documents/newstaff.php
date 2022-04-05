<?php
require_once("Dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะเพิ่ม
if ($_POST){
    //print_r($_POST);
    $sc = $_POST['sc'];
    $flname = $_POST['flname'];

    // insert a record by prepare and bind
    // The argument may be one of four types:
    //  i - integer
    //  d - double
    //  s - string
    //  b - BLOB

    // ในส่วนของ INTO ให้กำหนดให้ตรงกับชื่อคอลัมน์ในตาราง actor
    // ต้องแน่ใจว่าคำสั่ง INSERT ทำงานใด้ถูกต้อง - ให้ทดสอบก่อน
    $sql ="INSERT 
            INTO staff (stf_code, stf_name) 
            VALUES (?, ?);";       
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $sc, $flname);
    $stmt->execute();

    // redirect ไปยัง actor.php
    header("location: staff.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>newstaff</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Add an staff</h1>
        <form action="newstaff.php" method="post">
            <div class="form-group">
                <label for="sc">ลำดับคณะกรรมการ</label>
                <input type="text" class="form-control" name="sc" id="sc">
            </div>
            <div class="form-group">
                <label for="flname">ชื่อและนามสกุล</label>
                <input type="text" class="form-control" name="flname" id="flname">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
        <h1 align = 'center'><a href="staff.php">staff</staff></a></h1>
</body>

</html>