<?php

include "db.php";

$sql = "SELECT * FROM cakes WHERE available = 1";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Sweet Cravings</title>

    <link rel="stylesheet" href="/Cakeshop/style.css?v=2">

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Poppins:wght@400;500;600&family=Pacifico&display=swap"
          rel="stylesheet">

</head>

<body>


<!-- ================= NAVBAR ================= -->

<header class="navbar">

    <div class="logo">

        <div class="cake-icon">
            🎂
        </div>

        <div>

            <h1>Sweet Cravings</h1>

            <p>
                ♥ Your Happiness, Our Cakes ♥
            </p>

        </div>

    </div>


    <nav>

        <a href="#home"
           class="nav-link active">
            Home
        </a>

        <a href="#cakes"
           class="nav-link">
            Cakes
        </a>

        <a href="#about"
           class="nav-link">
            About Us
        </a>

        <a href="#order"
           class="nav-link">
            Order Now
        </a>

        <a href="#contact"
           class="nav-link">
            Contact
        </a>

    </nav>


    <button class="cart"
            onclick="showCart()">

        🛒 Cart
        (<span id="cart-count">0</span>)

    </button>

</header>



<!-- ================= HOME ================= -->

<section id="home"
         class="hero">


    <div class="hero-text">

        <h2>
            Sweet Moments
            <br>
            Begin With Cake
        </h2>


        <div class="heart-line">
            ───── ♥ ─────
        </div>


        <p>

            Delicious cakes made with love
            <br>

            for your special moments.

        </p>


        <button class="main-btn"
                onclick="goToCakes()">

            Explore Our Cakes

        </button>

    </div>


    <div class="hero-image">

        <img
        src="https://images.openai.com/static-rsc-4/r4ul8XYb4InNJZ0QNP654jHNQeFZMnhuCp9QrlhGtgLFy7M208goL_hirEgM3FZsq6OhyXefRLXE0qhKxbBkA24R1SvTNRlCYROcgTW0A8A0Aqw61zv6vM0PZQn3O8Jiymoa5dD8BJJJLz2VDdEgYSP4JjiDu84v6zrmQlZDNqHtgDxHkZaGs16feK73K-wp?purpose=fullsize">

    </div>

</section>



<!-- ================= CAKES ================= -->

<section id="cakes"
         class="cakes-section">


    <h2>
        Our Delicious Cakes
    </h2>


    <div class="heart-line">
        ───── ♥ ─────
    </div>


    <p class="section-description">

        Freshly baked cakes made especially for you.

    </p>



    <div class="cake-container">


        <?php

        if ($result->num_rows > 0) {

            while ($cake = $result->fetch_assoc()) {

        ?>


        <!-- CAKE CARD -->

        <div class="cake-card">


            <div class="cake-image">

                <img
                src="<?php echo $cake['image']; ?>"
                alt="<?php echo htmlspecialchars($cake['cake_name']); ?>">


                <button
                class="favorite"
                onclick="toggleFavorite(this)">

                    ♥
                    
                </button>

            </div>



            <h3>

                <?php
                echo htmlspecialchars($cake['cake_name']);
                ?>

            </h3>



            <p>

                <?php
                echo htmlspecialchars($cake['description']);
                ?>

            </p>


            <div class="cake-details">

                <span>
                    🎂
                    <?php echo htmlspecialchars($cake['size']); ?>
                </span>

                <span>
                    🍰
                    <?php echo htmlspecialchars($cake['flavor']); ?>
                </span>

                <span>
                    📂
                    <?php echo htmlspecialchars($cake['category']); ?>
                </span>

            </div>



            <button
                class="details-btn"
                onclick="showCakeDetails(
                    '<?php echo htmlspecialchars($cake['cake_name'], ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($cake['description'], ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($cake['size'], ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($cake['flavor'], ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($cake['ingredients'], ENT_QUOTES); ?>',
                    <?php echo $cake['price']; ?>
                )">

                View Details

            </button>



            <h4>

                Rs.
                <?php
                echo number_format($cake['price'], 2);
                ?>

            </h4>



            <button
                class="order-btn"
                onclick="addToCart(
                    <?php echo $cake['cake_id']; ?>,
                    '<?php echo htmlspecialchars($cake['cake_name'], ENT_QUOTES); ?>',
                    <?php echo $cake['price']; ?>
                )">

                🛒 Order Now

            </button>


        </div>


        <?php

            }

        } else {

            echo "<p>No cakes available.</p>";

        }

        ?>

    </div>

</section>



<!-- ================= CAKE DETAILS MODAL ================= -->

<div id="cake-modal"
     class="modal">


    <div class="modal-content">


        <button class="close-btn"
                onclick="closeCakeDetails()">

            ×

        </button>


        <h2 id="modal-name">
            Cake Name
        </h2>


        <div class="heart-line">
            ───── ♥ ─────
        </div>


        <p id="modal-description">
        </p>


        <div class="modal-details">

            <p>
                🎂 <strong>Size:</strong>
                <span id="modal-size"></span>
            </p>

            <p>
                🍰 <strong>Flavor:</strong>
                <span id="modal-flavor"></span>
            </p>

            <p>
                🥣 <strong>Ingredients:</strong>
                <span id="modal-ingredients"></span>
            </p>

            <p>
                💰 <strong>Price:</strong>
                Rs.
                <span id="modal-price"></span>
            </p>

        </div>


        <button class="main-btn"
                onclick="goToOrderFromModal()">

            Order This Cake

        </button>

    </div>

</div>



<!-- ================= ABOUT ================= -->

<section id="about"
         class="about-section">


    <div class="about-image">

        <img
        src="https://images.unsplash.com/photo-1558301211-0d8c8ddee6ec?auto=format&fit=crop&w=900&q=85"
        alt="Cakes in bakery">

    </div>


    <div class="about-text">

        <h2>
            About Sweet Cravings
        </h2>


        <div class="heart-line">
            ───── ♥ ─────
        </div>


        <p>

            Welcome to Sweet Cravings,
            where every cake is made with
            love and care.

        </p>


        <p>

            We create delicious cakes using
            quality ingredients and beautiful
            designs to make your special
            moments even sweeter.

        </p>


        <p>

            Whether it is a birthday,
            anniversary, graduation or simply
            a day when you want something sweet,
            we are here for you.

        </p>


        <button class="main-btn"
                onclick="goToOrder()">

            Order Your Cake

        </button>

    </div>

</section>



<!-- ================= ORDER ================= -->

<section id="order"
         class="order-section">


    <h2>
        Order Your Cake
    </h2>


    <div class="heart-line">
        ───── ♥ ─────
    </div>


    <form
        action="order.php"
        method="POST"
        id="order-form">


        <label for="name">
            Your Name
        </label>

        <input
            type="text"
            name="name"
            id="name"
            placeholder="Enter your name"
            required>



        <label for="email">
            Email
        </label>

        <input
            type="email"
            name="email"
            id="email"
            placeholder="Enter your email"
            required>



        <label for="phone">
            Phone Number
        </label>

        <input
            type="text"
            name="phone"
            id="phone"
            placeholder="Enter your phone number"
            required>



        <label for="address">
            Delivery Address
        </label>

        <input
            type="text"
            name="address"
            id="address"
            placeholder="Enter delivery address"
            required>



        <label for="cake">
            Choose Cake
        </label>

        <select
            name="cake_id"
            id="cake"
            required>

            <option value="">
                Select a cake
            </option>


            <?php

            $cakeResult =
                $conn->query(
                    "SELECT cake_id, cake_name, price
                     FROM cakes
                     WHERE available = 1"
                );


            while ($cake = $cakeResult->fetch_assoc()) {

            ?>

                <option
                    value="<?php echo $cake['cake_id']; ?>">

                    <?php
                    echo htmlspecialchars($cake['cake_name']);
                    ?>

                    -
                    Rs.
                    <?php
                    echo number_format($cake['price'], 2);
                    ?>

                </option>

            <?php

            }

            ?>

        </select>



        <label for="quantity">
            Quantity
        </label>

        <input
            type="number"
            name="quantity"
            id="quantity"
            min="1"
            value="1"
            required>



        <label for="message">
            Special Request
        </label>

        <textarea
            name="message"
            id="message"
            placeholder="Any special cake requirements?">
        </textarea>



        <button
            type="submit"
            class="main-btn">

            Place Order

        </button>


    </form>

</section>



<!-- ================= CONTACT ================= -->

<section id="contact"
         class="contact-section">


    <h2>
        Contact Us
    </h2>


    <div class="heart-line">
        ───── ♥ ─────
    </div>


    <p>
        We would love to hear from you!
    </p>


    <div class="contact-info">

        <p>
            📞 +94 717766760
        </p>

        <p>
            📧 sweetcravings@gmail.com
        </p>

        <p>
            📍 Colombo, Sri Lanka
        </p>

    </div>

</section>



<!-- ================= FOOTER ================= -->

<footer>

    <h3>
        Sweet Cravings
    </h3>

    <p>
        ♥ Your Happiness, Our Cakes ♥
    </p>

    <p>
        © 2026 Sweet Cravings.
        All Rights Reserved.
    </p>

</footer>



<script src="script.js"></script>

</body>

</html>