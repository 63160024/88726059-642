<?php
if ($_POST) {
  $n1 = $_POST['n1'];
  $n2 = $_POST['n2'];
} else {
  $n1 = $_GET['n1'];
  $n2 = $_GET['n2'];
}
echo $n1 + $n2;