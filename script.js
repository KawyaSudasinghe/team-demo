/* =========================
   CART
========================= */

let cartCount = 0;

let cartItems = [];


/* Add cake to cart */

function addToCart(cakeId, cakeName, price) {

    cartCount++;


    cartItems.push({
        id: cakeId,
        name: cakeName,
        price: price
    });


    document.getElementById("cart-count").textContent =
        cartCount;


    alert(
        cakeName +
        " has been added to your cart!"
    );


    console.log(cartItems);
}



/* =========================
   SHOW CART
========================= */

function showCart() {

    if (cartItems.length === 0) {

        alert("Your cart is empty.");

        return;
    }


    let message = "Your Cart:\n\n";

    let total = 0;


    cartItems.forEach(function(item, index) {

        message +=
            (index + 1) +
            ". " +
            item.name +
            " - Rs. " +
            item.price +
            "\n";


        total += item.price;

    });


    message +=
        "\nTotal: Rs. " +
        total;


    alert(message);
}



/* =========================
   FAVORITE
========================= */

function toggleFavorite(button) {

    button.classList.toggle("selected");

}



/* =========================
   CAKE DETAILS
========================= */

function showCakeDetails(
    name,
    description,
    size,
    flavor,
    ingredients,
    price
) {


    document.getElementById("modal-name").textContent =
        name;


    document.getElementById("modal-description").textContent =
        description;


    document.getElementById("modal-size").textContent =
        size;


    document.getElementById("modal-flavor").textContent =
        flavor;


    document.getElementById("modal-ingredients").textContent =
        ingredients;


    document.getElementById("modal-price").textContent =
        Number(price).toLocaleString();


    document.getElementById("cake-modal").style.display =
        "flex";

}



/* CLOSE DETAILS */

function closeCakeDetails() {

    document.getElementById("cake-modal").style.display =
        "none";

}



/* CLOSE MODAL WHEN CLICKING OUTSIDE */

window.addEventListener("click", function(event) {

    const modal =
        document.getElementById("cake-modal");


    if (event.target === modal) {

        closeCakeDetails();

    }

});



/* =========================
   NAVIGATION
========================= */

function goToCakes() {

    document.getElementById("cakes").scrollIntoView({
        behavior: "smooth"
    });

}


function goToOrder() {

    document.getElementById("order").scrollIntoView({
        behavior: "smooth"
    });

}


function goToOrderFromModal() {

    closeCakeDetails();

    goToOrder();

}



/* =========================
   ACTIVE NAVIGATION
========================= */

const sections =
    document.querySelectorAll("section");


const navLinks =
    document.querySelectorAll(".nav-link");


window.addEventListener("scroll", function() {

    let current = "";


    sections.forEach(function(section) {

        const sectionTop =
            section.offsetTop - 150;


        const sectionHeight =
            section.clientHeight;


        if (
            window.scrollY >= sectionTop &&
            window.scrollY <
            sectionTop + sectionHeight
        ) {

            current =
                section.getAttribute("id");

        }

    });


    navLinks.forEach(function(link) {

        link.classList.remove("active");


        if (
            link.getAttribute("href") ===
            "#" + current
        ) {

            link.classList.add("active");

        }

    });

});