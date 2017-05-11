<?php

require_once __DIR__ . '/vendor/autoload.php';

?>
<!-- CODIGO DO EXEMPLO OBTIDO NO REPOSITORIO: https://gist.github.com/jkuip/43bb6716e0e907f74b49 -->
<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="public/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container" style="margin-top: 50px">

    <?php

    // If the submit button has been pressed
    if(isset($_POST['submit']))
    {
        // Check number values
        if(is_numeric($_POST['number1']) && is_numeric($_POST['number2']))
        {
            // Calculate total
            if($_POST['operation'] == 'plus')
            {
                $total = $_POST['number1'] + $_POST['number2'];
            }
            if($_POST['operation'] == 'minus')
            {
                $total = $_POST['number1'] - $_POST['number2'];
            }
            if($_POST['operation'] == 'times')
            {
                $total = $_POST['number1'] * $_POST['number2'];
            }
            if($_POST['operation'] == 'divided by')
            {
                $total = $_POST['number1'] / $_POST['number2'];
            }

            // Print total to the browser
            echo "<h1>{$_POST['number1']} {$_POST['operation']} {$_POST['number2']} equals {$total}</h1>";

        } else {

            // Print error message to the browser
            echo 'Numeric values are required';

        }
    }

    ?>

    <!-- Calculator form -->
    <form method="post" action="calculator.php">
        <input name="number1" type="text" class="form-control" style="width: 150px; display: inline" />
        <select name="operation">
            <option value="plus">Plus</option>
            <option value="minus">Minus</option>
            <option value="times">Times</option>
            <option value="divided by">Divided By</option>
        </select>
        <input name="number2" type="text" class="form-control" style="width: 150px; display: inline" />
        <input name="submit" type="submit" value="Calculate" class="btn btn-primary" />
    </form>

</div>

</body>
</html>