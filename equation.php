<?php
$a = "";
$b = "";
$c = "";
$result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];

    // Compute discriminant
    $result = ($b * $b) - (4 * $a * $c);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Discriminant Calculator</title>
    <style>
        body {
            font-family: Georgia, serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            padding-top: 40px;
        }

        .card {
            background: white;
            width: 750px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        h1 {
            text-align: center;
            font-size: 45px;
            margin-bottom: 20px;
        }

        .formula-box {
            font-size: 35px;
            text-align: center;
            background: #fff6c4;
            padding: 20px;
            border-radius: 15px;
            border: 2px solid #e0c300;
            margin-bottom: 30px;
        }

        .row {
            margin-bottom: 25px;
        }

        label {
            font-size: 35px;
            width: 50px;
            display: inline-block;
            font-weight: bold;
        }

        input[type="number"] {
            width: 500px;
            height: 55px;
            font-size: 30px;
            padding-left: 15px;
            border-radius: 10px;
            border: 2px solid #666;
        }

        input[type="submit"] {
            display: block;
            margin: 0 auto;
            margin-top: 20px;
            font-size: 32px;
            padding: 10px 40px;
            background: #222;
            color: white;
            border-radius: 12px;
            border: none;
            cursor: pointer;
        }

        .result {
            margin-top: 30px;
            font-size: 50px;
            font-weight: bold;
            text-align: center;
            background: #d6ffd8;
            padding: 20px;
            border-radius: 15px;
            border: 2px solid #59b35a;
        }
    </style>
</head>
<body>

<div class="card">

    <h1>Discriminant of a Quadratic Equation</h1>

    <!-- ✔ Dynamic Formula Box -->
    <div class="formula-box">
        Formula:  
        <br><br>
        D = b² − 4ac 
        <br><br>

        <!-- ✔ Shows updated values after clicking Compute -->
        <?php if ($a !== "" && $b !== "" && $c !== ""): ?>
            D = (<?php echo $b; ?>)² − 4(<?php echo $a; ?>)(<?php echo $c; ?>)
        <?php else: ?>
            D = (b)² − 4(a)(c)
        <?php endif; ?>
    </div>

    <form method="POST">

        <div class="row">
            <label>a</label>
            <input type="number" name="a" value="<?php echo $a; ?>" required>
        </div>

        <div class="row">
            <label>b</label>
            <input type="number" name="b" value="<?php echo $b; ?>" required>
        </div>

        <div class="row">
            <label>c</label>
            <input type="number" name="c" value="<?php echo $c; ?>" required>
        </div>

        <input type="submit" value="Compute">

    </form>

    <!-- ✔ Final Result -->
    <?php if ($result !== ""): ?>
        <div class="result">
        <?php echo $result; ?></div>
    <?php endif; ?>

</div>

</body>
</html>
