<?php
require_once("Dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะลบ
if ($_POST){
    $id = $_POST['id'];
    $dnum = $_POST['dnum'];
    $dtitle = $_POST['dtitle'];
    $dsd = $_POST['dsd'];
    $dtd = $_POST['dtd'];
    $ds = $_POST['ds'];
    $dfn = $_POST['dfn'];

    $sql = "UPDATE documents
            SET doc_num = ?, 
                doc_title = ?,
                doc_start_date = ?,
                doc_to_date = ?,
                doc_status = ?,
                doc_file_name = ?
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssssi", $dnum, $dtitle, $dsd, $dtd, $ds, $dfn, $id);
    $stmt->execute();

    //enho $mysqli->info; 
    header("location: documents.php");
    //editdocuments.php?id=1&name=witty
} else {
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM documents
            WHERE id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>editdocuments</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Edit an documents</h1>
        <form action="editdocuments.php" method="post">
            <div class="form-group">
                <label for="dnum">เลขที่คำสั่ง//ชื่อคำสั่ง</label>
                <input type="text" class="form-control" name="dnum" id="dnum" value="<?php echo $row->doc_num;?>">
            </div>
            <div class="form-group">
                <label for="dtitle">หมายเลขคำสั่ง</label>
                <input type="text" class="form-control" name="dtitle" id="dtitle" value="<?php echo $row->doc_title;?>">
            </div>
            <div class="form-group">
                <label for="dsd">วันที่เริ่มต้นการดำเนินตามคำสั่ง</label>
                <input type="date" class="form-control" name="dsd" id="dsd" value="<?php echo $row->doc_start_date;?>">
            </div>
            <div class="form-group">
                <label for="dtd">วันที่สิ้นสุดการดำเนินการศำสั่ง</label>
                <input type="date" class="form-control" name="dtd" id="dtd" value="<?php echo $row->doc_to_date;?>">
            </div>
            <div class="form-group">
                <label for="ds">สถานะของคำสั่ง</label>
                <input type="text" class="form-control" name="ds" id="ds" value="<?php echo $row->doc_status;?>">
                <input type = "radio" name="doc_status" id="doc_status" value="Active"
                    <?php if($row->doc_status == "Active")//(echo"checked";)?>> Active
                <input type = "radio" name="doc_status" id="doc_status" value="Expire"
                    <?php if($row->doc_status == "Expire")//(echo"checked";)?>> Expire
            </div>
            <div class="form-group">
                <label for="dfn">ชื่อไฟล์เอกสารคำสั่ง</label>
                <input type="text" class="form-control" name="dfn" id="dfn" value="<?php echo $row->doc_file_name;?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $row->id;?>">
            <button type="submit" class="btn btn-success">Update</button>
        </form>
        <h1 align = 'center'><a href="documents.php">documents</documents></a></h1>
</body>

</html>