<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price</title>
    <link rel="stylesheet" href="CSS\price.css">
    <script src="Grafik/demo/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- navbar dan dropdown -->
    <nav>
        <div class="logo">
            <!-- <img src="../New folder/img/logoku (2).png" alt="">Nature -->
            <h3>Crafting Digital Dreams - Price</h3>
        </div>
        <label for="btn" class="icon">
            <span class="fa fa-bars"></span>
        </label>
        <input type="checkbox" id="btn">
        <ul>
            <li><a href="index.php">Back to Home</a></li>
        </ul>
    </nav>



    <!-- tabel -->
    <div class="container7">

        <h2>Price</h2>
        <div class="table-container">
            <br>
            <table class="table-responsive">
                <thead>
                    <tr">
                        <td rowspan="2">No</td>
                        <td rowspan="2">Name</td>
                        <td rowspan="2">Price</td>
                        </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Web Design</td>
                        <td>Rp 5.000.000 - Rp 10.000.000</td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>UI/UX design</td>
                        <td>Rp 3.000.000 - Rp 7.000.000</td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>App Design</td>
                        <td>Rp 12.000.000 - Rp 50.000.000</td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>Kalkulator BMI</td>
                        <td>Rp 500.000 - Rp 5.000.000</td>
                    </tr>

                    <tr>
                        <td>5</td>
                        <td>Personal Website</td>
                        <td>Rp 1.000.000 - Rp 10.000.000</td>
                    </tr>

                    <tr>
                        <td>6</td>
                        <td>App Management Event</td>
                        <td>Rp 10.000.000 - Rp 20.000.000</td>
                    </tr>

                    <tr>
                        <td>7</td>
                        <td>Design Custom</td>
                        <td>Rp 200.000 - Rp 20.000.000</td>
                    </tr>

                    <tr>
                        <td>8</td>
                        <td>Special Features</td>
                        <td>Rp 3.000.000 - Rp 8.000.000</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>


    <!-- footer -->
    <footer>
        <p>Copyright &copy; 2025 - Tri Cahya Armanditha</p>
    </footer>



</body>

</html>