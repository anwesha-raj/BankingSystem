<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transfer History</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/table.css">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    body {
      width: 100%;
      height: 100vh;
      background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(img2.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;

    }

    .navbar {
      height: 75px;
      width: 100%;
      background: rgba(32, 32, 33, 0.4);
    }

    .navbar h1 {
      padding: 20px 75px;
      font-size: 26px;
      color: white;
      font-weight: 500;
      text-transform: uppercase;
    }

    .navbar ul {
      float: right;
      margin-right: 20px;
      margin-top: -43px;
    }

    .navbar ul li {
      list-style: none;
      margin: 0 20px;
      display: inline-block;
      line-height: 17px;
      padding: 0px 8px;
    }

    .navbar ul li a {
      text-decoration: none;
      color: white;
      font-size: 20px;
      font-family: 'DM Serif Display', serif;
      transition: 0.4s;
    }

    .navbar ul li a:hover {
      color: rgb(236 220 50);
      background-color: rgba(0, 0, 0, .4);
      padding: 27px 16px;
      border: none;

    }

    footer {
      background-color: rgb(0 0 0 / 30%);
      padding: 4px;
      margin-top: 250px;
    }

    footer p {
      text-align: center;
      color: white;
      font-family: monospace;
      font-size: 14px;
    }

    footer p a {
      text-decoration: none;
      color: aqua;
    }
  </style>
</head>
<nav class="navbar">
  <h1>World Bank</h1>
  <ul>
    <li><a class="active" href="index.php">Home</a></li>
    <li><a href=" https://www.thesparksfoundationsingapore.org/">About Us</a></li>
    <li><a href="customers.php">Customers</a></li>
    <li><a href="transactions.php">Transaction History</a></li>
  </ul>
</nav>
<div class="container">
  <h2 class="text-center pt-4" style="color : white;">Transfer History</h2>

  <br>
  <div class="table-responsive-sm">
    <table class="table table-hover table-striped table-condensed table-bordered">
      <thead style="color : white;">
        <tr>
          <th class="text-center">S.No.</th>
          <th class="text-center">Sender</th>
          <th class="text-center">Receiver</th>
          <th class="text-center">Amount</th>
          <th class="text-center">Date & Time</th>
        </tr>
      </thead>
      <tbody>
        <?php

        include 'config.php';

        $sql = "select * from transaction";

        $query = mysqli_query($conn, $sql);

        while ($rows = mysqli_fetch_assoc($query)) {
        ?>

          <tr style="color : white;">
            <td class="py-2"><?php echo $rows['sno']; ?></td>
            <td class="py-2"><?php echo $rows['sender']; ?></td>
            <td class="py-2"><?php echo $rows['receiver']; ?></td>
            <td class="py-2"><?php echo $rows['balance']; ?> </td>
            <td class="py-2"><?php echo $rows['datetime']; ?> </td>

          <?php
        }

          ?>
      </tbody>
    </table>

  </div>
</div>
<footer>
  <div>
    <p>Copyright © 2023 - Made by <span>Anwesha Raj</span> : <a href="https://www.thesparksfoundationsingapore.org/">The Spark Foundation</a></p>
  </div>

</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>