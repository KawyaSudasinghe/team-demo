CREATE DATABASE cake_shop;

USE cake_shop;


-- =========================
-- CAKES TABLE
-- =========================

CREATE TABLE cakes (
    cake_id INT AUTO_INCREMENT PRIMARY KEY,
    cake_name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50),
    size VARCHAR(50),
    flavor VARCHAR(100),
    ingredients VARCHAR(255),
    image VARCHAR(500),
    available INT DEFAULT 1
);


-- =========================
-- CUSTOMERS TABLE
-- =========================

CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    address VARCHAR(255)
);


-- =========================
-- ORDERS TABLE
-- =========================

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    cake_id INT NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (customer_id)
        REFERENCES customers(customer_id),

    FOREIGN KEY (cake_id)
        REFERENCES cakes(cake_id)
);


-- =========================
-- CAKE DATA
-- =========================

INSERT INTO cakes
(cake_name, description, price, category, size, flavor, ingredients, image)
VALUES

(
    'Chocolate Delight',
    'Rich chocolate sponge layered with creamy chocolate frosting.',
    2500.00,
    'Chocolate',
    '1 kg',
    'Chocolate',
    'Chocolate sponge, cocoa, butter, cream, sugar',
    'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=800&q=85'
),

(
    'Red Velvet',
    'Classic red velvet cake with smooth cream cheese frosting.',
    2700.00,
    'Red Velvet',
    '1 kg',
    'Red Velvet',
    'Red velvet sponge, cream cheese, butter, sugar',
    'https://popmenucloud.com/vidcgmtx/587e62d3-7e81-446c-bfc5-063b6f197296.png'
),

(
    'Strawberry Dream',
    'Soft vanilla cake filled with fresh strawberries and cream.',
    2800.00,
    'Fruit',
    '1 kg',
    'Strawberry',
    'Vanilla sponge, strawberries, fresh cream, sugar',
    'https://images.unsplash.com/photo-1565958011703-44f9829ba187?auto=format&fit=crop&w=800&q=85'
),

(
    'Vanilla Dream',
    'Classic vanilla sponge cake covered with delicious buttercream.',
    2200.00,
    'Vanilla',
    '1 kg',
    'Vanilla',
    'Vanilla sponge, buttercream, vanilla essence, sugar',
    'https://cdn.shoplightspeed.com/shops/613568/files/75807708/1652x1652x2/norohy-norohy-madagascar-vanilla-beans-44-oz.jpg'
),

(
    'Black Forest',
    'Chocolate cake with cherries, chocolate shavings and whipped cream.',
    3000.00,
    'Chocolate',
    '1.5 kg',
    'Chocolate & Cherry',
    'Chocolate sponge, cherries, cream, chocolate shavings',
    'https://images.unsplash.com/photo-1571115177098-24ec42ed204d?auto=format&fit=crop&w=800&q=85'
),

(
    'Strawberry Rose',
    'Elegant strawberry cake decorated with fresh cream and strawberries.',
    3200.00,
    'Special',
    '1.5 kg',
    'Strawberry',
    'Vanilla sponge, strawberries, cream, strawberry syrup',
    'https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?auto=format&fit=crop&w=800&q=85'
);