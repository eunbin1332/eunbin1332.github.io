<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body></body>
</html>
<?php
$n = 30;
for($i=0; $i<$n; $i++){
    $data[$i] = rand(10,100);
    echo("$data[$i] <br>");

}
sort($data);
echo("sorting...<br>");
for($i=0; $i<$n; $i++) {
    echo("$data[$i] ");
}
?>


