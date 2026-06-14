USE cafeteria;

INSERT INTO rooms (room_number, description)
VALUES
('2010', 'First Floor'),
('2011', 'First Floor'),
('2012', 'Second Floor'),
('2013', 'Second Floor');

INSERT INTO categories (name)
VALUES
('Hot Drinks'),
('Cold Drinks'),
('Snacks'),
('Desserts');

INSERT INTO users
(name,email,password,role,extension)
VALUES
(
'Admin User',
'admin@cafeteria.com',
'$2y$10$8K1p/a0m6NnRkK5e5j4M6uA5J4v7x8Yw1mKkM6vB7mQhYy4k3nK9a',
'admin',
'100'
),
(
'Sara Ahmed',
'sara.ahmed@company.com',
'$2y$10$8K1p/a0m6NnRkK5e5j4M6uA5J4v7x8Yw1mKkM6vB7mQhYy4k3nK9a',
'user',
'101'
),
(
'Test User',
'test@company.com',
'$2y$10$8K1p/a0m6NnRkK5e5j4M6uA5J4v7x8Yw1mKkM6vB7mQhYy4k3nK9a',
'user',
'102'
);