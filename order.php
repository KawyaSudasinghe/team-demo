<?php

include "db.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    /* =========================
       GET CUSTOMER DATA
    ========================= */

    $name =
        $_POST["name"];

    $email =
        $_POST["email"];

    $phone =
        $_POST["phone"];

    $address =
        $_POST["address"];

    $cake_id =
        $_POST["cake_id"];

    $quantity =
        $_POST["quantity"];


    /* =========================
       GET CAKE PRICE
    ========================= */

    $sql =
        "SELECT cake_name, price
         FROM cakes
         WHERE cake_id = ?";


    $stmt =
        $conn->prepare($sql);


    $stmt->bind_param(
        "i",
        $cake_id
    );


    $stmt->execute();


    $result =
        $stmt->get_result();


    if ($result->num_rows == 0) {

        die("Cake not found.");

    }


    $cake =
        $result->fetch_assoc();


    $cake_name =
        $cake["cake_name"];


    $price =
        $cake["price"];


    /* =========================
       CALCULATE TOTAL
    ========================= */

    $total_price =
        $price * $quantity;



    /* =========================
       INSERT CUSTOMER
    ========================= */

    $customerSQL =
        "INSERT INTO customers
        (name, email, phone, address)
        VALUES (?, ?, ?, ?)";


    $customerStmt =
        $conn->prepare($customerSQL);


    $customerStmt->bind_param(
        "ssss",
        $name,
        $email,
        $phone,
        $address
    );


    $customerStmt->execute();


    $customer_id =
        $conn->insert_id;



    /* =========================
       INSERT ORDER
    ========================= */

    $orderSQL =
        "INSERT INTO orders
        (customer_id, cake_id, quantity, total_price)
        VALUES (?, ?, ?, ?)";


    $orderStmt =
        $conn->prepare($orderSQL);


    $orderStmt->bind_param(
        "iiid",
        $customer_id,
        $cake_id,
        $quantity,
        $total_price
    );


    if ($orderStmt->execute()) {

?>

<!DOCTYPE html>

<html>

<head>

    <title>Order Successful</title>

    <link rel="stylesheet"
          href="style.css">

</head>


<body>

    <section class="order-section">

        <h2>
            Order Successful! 🎂
        </h2>


        <div class="heart-line">
            ───── ♥ ─────
        </div>


        <p>

            Thank you,
            <strong>
                <?php echo htmlspecialchars($name); ?>
            </strong>

        </p>


        <br>


        <p>
            Cake:
            <strong>
                <?php echo htmlspecialchars($cake_name); ?>
            </strong>
        </p>


        <p>
            Quantity:
            <strong>
                <?php echo $quantity; ?>
            </strong>
        </p>


        <p>
            Total:
            <strong>
                Rs.
                <?php echo number_format($total_price, 2); ?>
            </strong>
        </p>


        <br>


        <a href="index.php"
           class="main-btn">

            Back to Home

        </a>

    </section>

</body>

</html>

<?php

    } else {

        echo "Error placing order: "
             . $orderStmt->error;

    }

}

?>