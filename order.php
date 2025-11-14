<!DOCTYPE html>
<html>
<head>
    <title>Gourmet Grub Order System</title>
    <style>
       
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f4f9; 
            color: #333; 
            margin: 0;
            padding: 30px;
            font-size: 18px; 
            line-height: 1.6;
        }

       
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
        }

        /* Headings */
        h1 {
            text-align: center;
            color: #d9534f; 
            font-size: 36px;
            margin-bottom: 30px;
            border-bottom: 2px solid #d9534f;
            padding-bottom: 10px;
        }

        h2 {
            color: #555;
            text-align: center;
            margin-top: 20px;
        }

        
        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%; 
            max-width: 500px; 
            margin: 20px auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            border: none;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #d9534f; 
            color: white;
            font-size: 20px;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8; 
        }
        
       
        form {
            max-width: 400px;
            margin: 40px auto;
            padding: 25px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="number"], select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: #007bff; 
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3; 
        }

        
        .receipt-box {
            border: 3px dashed #6c757d;
            padding: 30px;
            max-width: 400px;
            margin: 40px auto 20px auto;
            background-color: #e9ecef;
            border-radius: 10px;
        }

        .receipt-title {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .receipt-box p {
            margin: 8px 0;
            font-size: 18px;
        }

        .receipt-box strong {
            color: #333;
        }

        .receipt-box .change-text {
            font-size: 24px;
            font-weight: bold;
            color: #0275d8; 
        }
        
        
        .error-message {
            color: #dc3545;
            text-align: center;
            font-size: 22px;
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #dc3545;
            background-color: #f8d7da;
            border-radius: 5px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1><span style="color:#5cb85c;">&#x1F374;</span> Gourmet Grub Order System</h1>

    <h2 style="color:#555; text-align: center;">Menu & Prices</h2>

    <table>
        <tr>
            <th>Order</th>
            <th>Amount</th>
        </tr>
        <tr><td>Burger</td><td>50</td></tr>
        <tr><td>Fries</td><td>75</td></tr>
        <tr><td>Steak</td><td>150</td></tr>
        <tr><td>Salad</td><td>100</td></tr>
        <tr><td>Soda</td><td>25</td></tr>
        <tr><td>Pizza Slice</td><td>90</td></tr>
    </table>

    <form method="POST">
        <label for="order">Select an order</label>
        <select name="order" id="order">
            <option value="Burger">Burger</option>
            <option value="Fries">Fries</option>
            <option value="Steak">Steak</option>
            <option value="Salad">Salad</option>
            <option value="Soda">Soda</option>
            <option value="Pizza Slice">Pizza Slice</option>
        </select>

        <label for="qty">Quantity</label>
        <input type="number" name="qty" id="qty" required min="1">

        <label for="cash">Cash</label>
        <input type="number" name="cash" id="cash" required min="1">

        <button type="submit">Process Order</button>
    </form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $order = $_POST["order"];
    $qty = $_POST["qty"];
    $cash = $_POST["cash"];

    
    $prices = [
        "Burger" => 50,
        "Fries" => 75,
        "Steak" => 150,
        "Salad" => 100,
        "Soda" => 25,
        "Pizza Slice" => 90
    ];

    
    if (!isset($prices[$order]) || $qty <= 0) {
        echo "<div class='error-message'>&#x26A0; Invalid order or quantity. Please check your selection.</div>";
    } else {
        $price = $prices[$order];
        $total = $price * $qty;

        if ($cash < $total) {
            echo "<div class='error-message'>&#x26A0; Not enough cash. Transaction cancelled. Total is $total.</div>";
        } else {
            $change = $cash - $total;
            $date = date("m/d/Y h:i:s a");
?>
            <div class="receipt-box">
                <div class="receipt-title">RECEIPT</div>
                <p><strong>Item:</strong> <?= $order ?> (x<?= $qty ?>)</p>
                <hr style="border: 1px solid #ccc; margin: 10px 0;">
                <p><strong>Total Due:</strong> <?= $total ?></p>
                <p><strong>Cash Paid:</strong> <?= $cash ?></p>
                <p class="change-text"><strong>CHANGE:</strong> <?= $change ?></p>
                <br>
                <p style="text-align: center; font-size: 14px;"><em><?= $date ?></em></p>
            </div>
<?php
        }
    }
}
?>
</div>

</body>

</html>
