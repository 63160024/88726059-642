<?php
require_once("Dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะเพิ่ม
if ($_POST){
    //print_r($_POST);
    $dnum = $_POST['dnum'];
    $dtitle = $_POST['dtitle'];
    $dsd = $_POST['dsd'];
    $dtd = $_POST['dtd'];
    $ds = $_POST['ds'];
    $dfn = $_POST['dfn'];

    // insert a record by prepare and bind
    // The argument may be one of four types:
    //  i - integer
    //  d - double
    //  s - string
    //  b - BLOB

    // ในส่วนของ INTO ให้กำหนดให้ตรงกับชื่อคอลัมน์ในตาราง documents
    // ต้องแน่ใจว่าคำสั่ง INSERT ทำงานใด้ถูกต้อง - ให้ทดสอบก่อน
    $sql ="INSERT 
            INTO documents (doc_num, doc_title, doc_start_date, doc_to_date, doc_status, doc_file_name) 
            VALUES (?, ?, ? , ?, ?, ?);";       
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssss", $dnum, $dtitle, $dsd, $dtd,  $ds, $dfn);
    $stmt->execute();

    // redirect ไปยัง documents.php
    header("location: documents.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>newdocuments</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Add an documents</h1>
        <form action="newdocuments.php" method="post">
            <div class="form-group">
                <label for="dnum">เลขที่คำสั่ง//ชื่อคำสั่ง</label>
                <input type="text" class="form-control" name="dnum" id="dnum">
            </div>
            <div class="form-group">
                <label for="dtitle">หมายเลขคำสั่ง</label>
                <input type="text" class="form-control" name="dtitle" id="dtitle">
            </div>
            <div class="form-group">
                <label for="dsd">วันที่เริ่มต้นการดำเนินตามคำสั่ง</label>
                <input type="date" class="form-control" name="dsd" id="dsd">
            </div>
            <div class="form-group">
                <label for="dtd">วันที่สิ้นสุดการดำเนินการศำสั่ง</label>
                <input type="date" class="form-control" name="dtd" id="dtd">
            </div>
            <div class="form-group">
                <label for="ds">สถานะของคำสั่ง</label>
                <input type="text" class="form-control" name="ds" id="ds">
            </div>
            <div class="form-group">
                <label for="dfn">ชื่อไฟล์เอกสารคำสั่ง</label>
                <input type="text" class="form-control" name="dfn" id="dfn">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
        <h1 align = 'center'><a href="documents.php">documents</documents></a></h1>
</body>

</html>