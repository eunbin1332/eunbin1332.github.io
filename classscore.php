<!DOCTYPE HTML>  
<html>
<body>  

<?php 

$nameErr= "";
$name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  고객성명: <input type="text" name="고객성명" value="<?php echo $name;?>">
  <?php echo $nameErr;?></span>
</form>
<style>
   form{text-align: table;}
</style>
</body>
</html>

<?php
$link = mysqli_connect("localhost", 'root', '','classscore');
$_GET['order'] = isset($order) ? $_GET['order'] : null;
?>


<html>
<head>
    <meta charset="utf-8">
    <title>classscore</title>
    <style>
        .input-wrap {
            width: 960px;
            margin: 0 auto;
        }
        h1 { text-align: center; }
        th, td { text-align: center; }
        table {
            border: 2px solid #000;
            margin: 0 auto;
            border-collapse: collapse;
        }
        td, th {
            border: 2px solid #444444;
        }
        a { text-decoration: none; }
    </style>
</head>
<body>
    <div class="input-wrap">
        <form action="classscore.php" method="POST">
            <table width = "600">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>구분</th>
                        <th colspan='2'>어린이</th>
                        <th colspan='2'>어른</th>
                        <th colspan='2'>비고</th>
                        
                    </tr>
                </thead>
                <tbody >
                    <tr>
                        <td>1</td>
                        <td>입장권</td>
                        <td>7,000</td>
                        <td>
                        <p>
                        <select name="select">
                        <option value="Option 1" selected>1</option>
                        <option value="Option 2">2</option>
                        <option value="Option 3">3</option>
                        <option value="Option 4">4</option>
                        </select>
                        </p>
                        </td>
                        <td>10,000</td>
                        <td>
                        <p>
                        <select name="select">
                        <option value="Option 1" selected>1</option>
                        <option value="Option 2">2</option>
                        <option value="Option 3">3</option>
                        <option value="Option 4">4</option>
                        </select>
                        </p>
                        </td>
                        <td>입장</td>
                    </tr>
                    <tr>
                        <td>
                        2
                        </td>
                        <td>BIG3</td>
                        <td>12,000</td>
                        <td>
                        <p>
                        <select name="select">
                        <option value="Option 1" selected>1</option>
                        <option value="Option 2">2</option>
                        <option value="Option 3">3</option>
                        <option value="Option 4">4</option>
                        </select>
                        </p>
                        </td>
                        <td>16,000</td>
                        <td>
                        <p>
                        <select name="select">
                        <option value="Option 1" selected>1</option>
                        <option value="Option 2">2</option>
                        <option value="Option 3">3</option>
                        <option value="Option 4">4</option>
                        </select>
                        </p>
                        </td>
                        <td>입장+놀이자유</td>
                    </tr>
                    <tr>
                        <td>
                        3
                        </td>
                        <td>자유이용권</td>
                        <td>21,000</td>
                        <td>
                        <p>
                        <select name="select">
                        <option value="Option 1" selected>1</option>
                        <option value="Option 2">2</option>
                        <option value="Option 3">3</option>
                        <option value="Option 4">4</option>
                        </select>
                        </p>
                        </td>
                        <td>26,000</td>
                        <td>
                        <p>
                        <select name="select">
                        <option value="Option 1" selected>1</option>
                        <option value="Option 2">2</option>
                        <option value="Option 3">3</option>
                        <option value="Option 4">4</option>
                        </select>
                        </p>
                        </td>
                        <td>입장+놀이자유</td>
                    </tr>
                    <tr>
                        <td>
                        4
                        </td>
                        <td>연간이용권권</td>
                        <td>70,000</td>
                        <td>
                        <p>
                        <select name="select">
                        <option value="Option 1" selected>1</option>
                        <option value="Option 2">2</option>
                        <option value="Option 3">3</option>
                        <option value="Option 4">4</option>
                        </select>
                        </p>
                        </td>
                        <td>90,000</td>
                        <td>
                        <p>
                        <select name="select">
                        <option value="Option 1" selected>1</option>
                        <option value="Option 2">2</option>
                        <option value="Option 3">3</option>
                        <option value="Option 4">4</option>
                        </select>
                        </p>
                        </td>
                        <td>입장+놀이자유</td>
                    </tr>
                </tbody>
            </table>
       </form>
       <?php echo date("h:i:sa"); ?>


        
    </div>
</body>
</html>




