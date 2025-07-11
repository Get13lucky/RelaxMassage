
INSERT INTO services_category (name, photo) 
VALUES 
    ('Тайский массаж для мужчин и женщин', 'path/to/photo_category1.jpg'),
    ('Тайский массаж для детей', 'path/to/photo_category2.jpg'),
    ('Тайский массаж для влюбленных', 'path/to/photo_category3.jpg'),
    ('СПА-программы', 'path/to/photo_category4.jpg');


INSERT INTO service (name, price, time, category_id) 
VALUES
    ('Тайский массаж для мужчин', 3000.00, 60, 1),
    ('Тайский массаж для женщин', 3500.00, 70, 1),
    ('Тайский массаж для пар', 4500.00, 90, 1),
    ('Тайский массаж для детей (0-3 года)', 1500.00, 30, 2),
    ('Тайский массаж для детей (4-6 лет)', 2000.00, 40, 2),
    ('Тайский массаж для детей (7-12 лет)', 2500.00, 50, 2),
    ('Тайский массаж для влюбленных (пар)', 5000.00, 90, 3),
    ('Тайский массаж для пары с ароматерапией', 5500.00, 100, 3),
    ('Тайский массаж для влюбленных с медом', 6000.00, 120, 3),
    ('СПА программа для отдыха и релаксации', 7000.00, 120, 4),
    ('Антистресс СПА программа', 7500.00, 130, 4),
    ('СПА программа с обертыванием', 8000.00, 150, 4);



UPDATE services_category 
SET photo = REPLACE(photo, 'Relax/', '/Relax/')
WHERE photo LIKE 'Relax/%';

ALTER TABLE profile
ADD COLUMN password VARCHAR(255) NOT NULL;

INSERT INTO massagers (name, photo) 
VALUES 
('Anna', 'images/Master_1.png'), 
('Rose', 'images/Master_2.png'),
 ('Thaya', 'images/Master_3.png');
