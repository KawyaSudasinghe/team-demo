<?php

include "config/db.php";
include "includes/header.php";

$sql = "SELECT cakes.*, categories.category_name
        FROM cakes
        LEFT JOIN categories
        ON cakes.category_id = categories.category_id
        ORDER BY cakes.created_at DESC";

$result = $conn->query($sql);

?>

<div class="container">

    <h2 class="section-title">
        Our Cakes
    </h2>

    <div class="cake-grid">

        <?php while ($cake = $result->fetch_assoc()): ?>

            <div class="cake-card">

                <img
                    src="images/<?php echo htmlspecialchars($cake['image']); ?>"
                    alt="<?php echo htmlspecialchars($cake['name']); ?>"
                >

                <div class="cake-card-content">

                    <h3>
                        <?php echo htmlspecialchars($cake['name']); ?>
                    </h3>

                    <p>
                        <?php echo htmlspecialchars($cake['description']); ?>
                    </p>

                    <p class="price">
                        Rs. <?php echo number_format($cake['price'], 2); ?>
                    </p>

                    <a
                        href="product.php?id=<?php echo $cake['cake_id']; ?>"
                        class="btn"
                    >
                        View Details
                    </a>

                </div>

            </div>

        <?php endwhile; ?>

    </div>

</div>

<?php include "includes/footer.php"; ?>