CREATE DATABASE bookstore;
USE bookstore;


CREATE TABLE books (
    isbn VARCHAR(13) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    image VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    quantity INT DEFAULT 10,
    price DECIMAL(10,2)
);
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    PASSWORD VARCHAR(255)
);

INSERT INTO admins (name,PASSWORD) VALUES
('Mahdi','$2a$12$Afy2ldZNYszJ/jnLrPwgpueyGHllYFK5Wxd2lqVeZcJiEvIpBsZR2'),
('Mohammed','$2a$12$SztjAJXrNfm5JqaouYF.munPzQ/LKT5wghwlN/57m8g/1RowssuYq'),
('Hussain','$2a$12$HxlNWsE53VFBx.tUBRJjSe8boEhTcEC4gmADfuo0w6C5GJpxKIjoS'),
('Jaffer','$2a$12$rA0/67ErBSXshwXg7gN6iuMq4EwUDwnGsKfAc8SVneIX6ImACF6z6');


INSERT INTO books (isbn, title, year, image, description, price) VALUES
('9789770928295', 'Moby-Dick', 2010, 'image1.jpg', 'The novel is a detailed narrative of a vengeful sea captains obsessive quest to hunt down a giant white sperm whale that bit off his leg. The captains relentless pursuit, despite the warnings and concerns of his crew, leads them on a dangerous journey across the seas.',5.99),
('9788088849230', 'Miserables', 1949, 'the-miserables-novel.jpg','Les Misérables tells the powerful story of Jean Valjean’s journey from prisoner to redemption against the backdrop of injustice, poverty, and revolution in 19th-century France.',12.5),
('9780460873314', 'POOR FOLK', 1844, 'image3.jpg', 'A deeply moving novel that lays bare the struggles of the poor with raw emotion and profound insight—Dostoyevskys first masterpiece!Written in the form of an epistolary novel, Poor Folk is a poignant and tragic tale of poverty, love, and human resilience.',9.99);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    book_title VARCHAR(255),
    total_price DECIMAL(10,2),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);