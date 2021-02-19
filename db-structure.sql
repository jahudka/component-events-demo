CREATE TABLE carts (
    id serial PRIMARY KEY NOT NULL,
    shipping_method character varying(6) NOT NULL
);

CREATE TABLE products (
    id serial PRIMARY KEY NOT NULL,
    name character varying(255) NOT NULL,
    unit_price numeric(10,5) NOT NULL
);

CREATE TABLE cart_items (
    id serial PRIMARY KEY NOT NULL,
    cart_id integer NOT NULL,
    product_id integer NOT NULL,
    quantity integer NOT NULL,
    CONSTRAINT fk_cart FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE,
    CONSTRAINT fk_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

INSERT INTO products (id, name, unit_price) VALUES
    (1, 'Pointless Hat', 50.00000),
    (2, 'Half A Study In Pink', 120.00000),
    (3, 'Your Sister''s Bathrobe', 90.00000);
