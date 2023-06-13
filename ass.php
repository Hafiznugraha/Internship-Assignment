<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css.css">
    <title>Electricity Rate Calculator</title>
    
</head>
<body>
    <section>
    <div class="box1">
        <form method="post">
            
            <h1>Electricity Rate Calculator</h1>
            <div class="input">
                <label for="voltage">Voltage (Voltage)</label>
                <input type="number" step="any" name="voltage" id="voltage" value="<?php echo $_POST['voltage'] ?? ''; ?>" required><br><br>
            </div>
            <div class="input">
                <label for="current">Current (Ampere)</label>
                <input type="number" step="any" name="current" id="current" value="<?php echo $_POST['current'] ?? ''; ?>"required><br><br>
            </div>
            <div class="input">
                <label for="current_rate">Current Rate (sen/kWh)</label>
                <input type="number" step="any" name="current_rate" id="current_rate" value="<?php echo $_POST['current_rate'] ?? ''; ?>" required><br><br>
            </div>
            <button type="submit" value="Calculate">Calculate</button>
        </form>
    </div>
    

    <table border="1" class="table_box table table-primary">
        <thead>
            <tr>
                <th>#</th>
                <th>Hour</th>
                <th>Energy(kWh)</th>
                <th>Total(RM)</th>
            </tr>
        </thead>
        <tbody>
        
        <?php
            
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // User inputs for voltage, current, and current rate
            $voltage = $_POST["voltage"];
            $current = $_POST["current"];
            $current_rate = $_POST["current_rate"];
            $hour = 1;
            $energyperday = 0;

            // To calculate the total power, energy, and current rate
            $power = $voltage * $current;
            $energy = $power * $hour * 1000;
            $totalhourly = $energy * ($current_rate / 100);
            ?>

            <div class="box2">
                <p id="power"><?php echo "Power(kW): " . $power / 1000 ?></p>
                <p id="rate"><?php echo "Rate(RM): " . $current_rate / 100 ?></p>
            </div>

            <?php
            $totalhourly = 0;
            $energy = 0;

            // To Calculate power and energy consumption for each hour in a 24-hour period
            for ($hour = 1; $hour <= 24; $hour++) {

                // To Calculate energy consumed for this hour
                $energy = ($power * $hour) / 1000;
                $energyperday += $energy;

                // To Calculate total for this hour
                $total_hourly = $energy * ($current_rate / 100);
                
                ?>
                
                <tr>
                    <td><p><?php echo $hour . PHP_EOL; ?></p></td>
                    <td><p><?php echo $hour . PHP_EOL; ?></p></td>
                    <td><p><?php echo $energy  . PHP_EOL; ?></p></td>
                    <td><p><?php echo round($total_hourly, 2) . PHP_EOL; ?></p></td>
                </tr>
                
                <?php
            }
            ?>
            
            <!-- To display total energy for a day -->
            <tr>
                <p><td colspan="3" align="right"><p><?php echo "Energy per day(kWh):" . PHP_EOL; ?></p></td>
                <td><p><?php echo round($energyperday, 2) . PHP_EOL; ?></p></td>
            </tr>
            
            <?php
        }
        ?>
        
        </tbody>
    </table>
</section>
    
</body>
</html>
