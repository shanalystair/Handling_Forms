<?php
$a = "";
$b = "";
$c = "";
$result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];

    
    $result = ($b * $b) - (4 * $a * $c);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Discriminant Calculator</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #ffffff; 
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 40px;
        }

        .card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            width: 800px;
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        h1 {
            text-align: center;
            font-size: 48px;
            margin-bottom: 25px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #444;
        }

        .formula-box {
            font-size: 33px;
            text-align: center;
            background: #ffd3d3; 
            padding: 25px;
            border-radius: 18px;
            border: 2px solid #d13a3a; 
            margin-bottom: 35px;
            font-weight: 600;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
        }

        .row {
            margin-bottom: 28px;
        }

        label {
            font-size: 32px;
            width: 50px;
            display: inline-block;
            font-weight: bold;
            color: #333;
        }

        input[type="number"] {
            width: 520px;
            height: 60px;
            font-size: 28px;
            padding-left: 15px;
            border-radius: 12px;
            border: 2px solid #777;
            transition: 0.2s ease;
        }

        input[type="number"]:focus {
            border-color: #5a3ef1;
            box-shadow: 0 0 10px rgba(90,62,241,0.3);
            outline: none;
        }

        input[type="submit"] {
            display: block;
            margin: 0 auto;
            margin-top: 25px;
            font-size: 34px;
            padding: 12px 50px;
            background: #4c40f7;
            color: white;
            border-radius: 15px;
            border: none;
            cursor: pointer;
            transition: 0.25s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        input[type="submit"]:hover {
            background: #362dd6;
            transform: translateY(-2px);
        }

        .result {
            margin-top: 35px;
            font-size: 55px;
            font-weight: bold;
            text-align: center;
            background: #d7ffe0;
            padding: 25px;
            border-radius: 18px;
            border: 3px solid #ccc;
            box-shadow: inset 0 0 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="card">

    <h1>Discriminant Calculator</h1>

    <div class="formula-box">
        Formula:
        <br><br>
        D = b² − 4ac
        <br><br>

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

    <?php if ($result !== ""): ?>
        <div class="result">
            <?php echo $result; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>

