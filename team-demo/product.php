<?php

include "config/db.php";
include "includes/header.php";

if (!isset($_GET['id'])) {
    die("Cake not found.");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM cakes WHERE cake_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Cake not found.");
}

$cake = $result->fetch_assoc();

?>

<div class="container">

    <div class="cake-card">

        <img
            src="images/<?php echo htmlspecialchars($cake['image']); ?>"
            alt="<?php echo htmlspecialchars($cake['name']); ?>"
        >

        <div class="cake-card-content">

            <h2>
                <?php echo htmlspecialchars($cake['name']); ?>
            </h2>

            <p>
                <?php echo htmlspecialchars($cake['description']); ?>
            </p>

            <p class="price">
                Rs. <?php echo number_format($cake['price'], 2); ?>
            </p>

            <p>
                Available:
                <?php echo $cake['stock']; ?>
            </p>

            <?php if ($cake['stock'] > 0): ?>

                <form action="cart.php" method="POST">

                    <input
                        type="hidden"
                        name="cake_id"
                        value="<?php echo $cake['cake_id']; ?>"
                    >

                    <input
                        type="hidden"
                        name="action"
                        value="add"
                    >

                    <button class="btn" type="submit">
                        Add to Cart
                    </button>

                </form>

            <?php else: ?>

                <p class="error">Out of stock.</p>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>