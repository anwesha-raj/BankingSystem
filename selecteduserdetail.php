<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn, $sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount) < 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check insufficient balance.
    else if ($amount > $sql1['balance']) {

        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check zero values
    else if ($amount == 0) {

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
    } else {

        // deducting amount from sender's account
        $newbalance = $sql1['balance'] - $amount;
        $sql = "UPDATE users set balance=$newbalance where id=$from";
        mysqli_query($conn, $sql);


        // adding amount to reciever's account
        $newbalance = $sql2['balance'] + $amount;
        $sql = "UPDATE users set balance=$newbalance where id=$to";
        mysqli_query($conn, $sql);

        $sender = $sql1['name'];
        $receiver = $sql2['name'];
        $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script> alert('Hurray! Transaction is Successful');
                                     window.location='transactions.php';
                           </script>";
        }

        $newbalance = 0;
        $amount = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Navigation bar-->
    <nav class="navbar">
        <h1>World Bank</h1>
        <ul>
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href=" https://www.thesparksfoundationsingapore.org/">About Us</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="transactions.php">Transaction History</a></li>
        </ul>
    </nav>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Money Transfer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

    <style type="text/css">
        button {
            border: none;
            background: #d9d9d9;
        }

        button:hover {
            background-color: #777E8B;
            transform: scale(1.1);
            color: white;
        }

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
<div class="container">
    <h2 class="text-center pt-4" style="color : white;">Easy Money Transfer</h2>
    <?php
    include 'config.php';
    $sid = $_GET['id'];
    $sql = "SELECT * FROM  users where id=$sid";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error : " . $sql . "<br>" . mysqli_error($conn);
    }
    $rows = mysqli_fetch_assoc($result);
    ?>
    <form method="post" name="tcredit" class="tabletext"><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr style="color : white;">
                    <th class="text-center">Account No.</th>
                    <th class="text-center">Account Name</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">Account Balane(in Rs.)</th>
                </tr>
                <tr style="color : white;">
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label style="color : white;"><b>Transfer To:</b></label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose account</option>
            <?php
            include 'config.php';
            $sid = $_GET['id'];
            $sql = "SELECT * FROM users where id!=$sid";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "Error " . $sql . "<br>" . mysqli_error($conn);
            }
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id']; ?>">

                    <?php echo $rows['name']; ?> (Balance:
                    <?php echo $rows['balance']; ?> )

                </option>
            <?php
            }
            ?>
            <div>
        </select>
        <br>
        <br>
        <label style="color : white;"><b>Amount:</b></label>
        <input type="number" class="form-control" name="amount" required>
        <br><br>
        <div class="text-center">
            <button class="btn mt-3" name="submit" type="submit" id="myBtn">Transfer Money</button>
        </div>
    </form>
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