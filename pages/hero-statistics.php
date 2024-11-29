<!-- Name: Fahd Adel Alghamdi -->
<!-- ID: 2135938 -->
<!-- Section: CS1 -->
<!-- Date: 9/22/2024 -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <title>Hero Statistics</title>
    <link rel="stylesheet" href="../CSS/styles.css" />
    <link rel="stylesheet" href="../CSS/print.css" media="print" />
</head>

<?php include  '../includes/header.php'; ?>

<body>
    <main>
        <h1>Hero Statistics</h1>
        <table class="hero-stats-table">
            <caption>Hero Performance Metrics</caption>
            <thead>
                <tr>
                    <th>Hero Name & Icon</th>
                    <th>Average Winrate</th>
                    <th>Average Pickrate</th>
                    <th>Hero Complexity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="heroes-abrams.php" style="text-decoration: none; color: inherit;">
                            <img src="../images/abrams-icon.png" alt="Abrams Icon" class="hero-icon" />
                            <span>Abrams</span>
                        </a>
                    </td>
                    <td>52.7%</td>
                    <td>53%</td>
                    <td>Easy</td>
                </tr>
                <tr>
                    <td>
                        <a href="heroes-bebop.php" style="text-decoration: none; color: inherit;">
                            <img src="../images/bebop-icon.png" alt="Bebop Icon" class="hero-icon" />
                            <span>Bebop</span>
                        </a>
                    </td>
                    <td>49.7%</td>
                    <td>68%</td>
                    <td>Complex</td>
                </tr>
                <tr>
                    <td>
                        <a href="heroes-dynamo.php" style="text-decoration: none; color: inherit;">
                            <img src="../images/dynamo-icon.png" alt="Dynamo Icon" class="hero-icon" />
                            <span>Dynamo</span>
                        </a>
                    </td>
                    <td>50.4%</td>
                    <td>49%</td>
                    <td>Medium</td>
                </tr>

            </tbody>
        </table>
    </main>
    <?php include  '../includes/footer.php'; ?>
</body>

</html>