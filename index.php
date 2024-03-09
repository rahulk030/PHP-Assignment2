<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 500px; 
            margin: auto;
            padding: 20px;
            background-color: #3268A9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .result-box {
            padding: 20px; 
            background-color: #4caf50;
            border-radius: 4px;
            color: #fff;
            height: 60px;
            width: 57px;
        }
    </style>
</head>
<body>
    <?php
        // Initialize variables to hold user input and default radio button value
        $numbers = '';
        $function = '1'; // AutoSum selected by default
        $result = '';

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve user input
            $numbers = $_POST['numbers'];
            $function = $_POST['function'];

            // Trim spaces before and after the input
            $numbers = trim($numbers);

            // Convert the input string into an array of numbers
            $numbersArray = explode(" ", $numbers);

            // Remove any empty elements and non-numeric values
            $numbersArray = array_filter($numbersArray, function($value) {
                return is_numeric($value);
            });

            // Perform the selected calculation based on the chosen function
            switch ($function) {
                case '1':
                    $result = array_sum($numbersArray);
                    break;
                case '2':
                    $result = array_sum($numbersArray) / count($numbersArray);
                    break;
                case '3':
                    $result = max($numbersArray);
                    break;
                case '4':
                    $result = min($numbersArray);
                    break;
                default:
                    $result = 'Invalid operation';
            }
        }
    ?>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="numbers">Enter numbers separated by space:</label>
            <input type="text" id="numbers" name="numbers" value="<?php echo $numbers; ?>" required>
            <br>
            <label for="autoSum">AutoSum</label>
            <input type="radio" id="autoSum" name="function" value="1" <?php if ($function === '1') echo 'checked'; ?>>
            <label for="average">Average</label>
            <input type="radio" id="average" name="function" value="2" <?php if ($function === '2') echo 'checked'; ?>>
            <label for="max">Max</label>
            <input type="radio" id="max" name="function" value="3" <?php if ($function === '3') echo 'checked'; ?>>
            <label for="min">Min</label>
            <input type="radio" id="min" name="function" value="4" <?php if ($function === '4') echo 'checked'; ?>>
            <br>
            <input type="submit" value="Calculate">
        </form>
        <div class="result-box">
            <?php
                // Display the result if it's calculated
                if (!empty($result)) {
                    echo "<p>Result: $result</p>";
                }
            ?>
        </div>
    </div>
</body>
</html>
