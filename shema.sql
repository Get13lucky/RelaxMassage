CREATE TABLE services_category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    photo VARCHAR(255)  
);

CREATE TABLE service (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,  
    time INT NOT NULL,  
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES services_category(id)
);


CREATE TABLE massagers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    photo VARCHAR(255)
);


CREATE TABLE profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE future_order (
    id INT AUTO_INCREMENT PRIMARY KEY,
    profile_id INT,
    service_id INT,
    massager_id INT,
    order_date DATETIME NOT NULL,  
    status ENUM('В ожидание', 'подтверждено', 'отмененно') DEFAULT 'В ожидание',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10, 2) NOT NULL,  
    service_duration INT NOT NULL,  
    FOREIGN KEY (profile_id) REFERENCES profile(id),
    FOREIGN KEY (service_id) REFERENCES service(id),
    FOREIGN KEY (massager_id) REFERENCES massagers(id)
);


CREATE TABLE last_order (
    id INT AUTO_INCREMENT PRIMARY KEY,
    profile_id INT,
    service_id INT,
    massager_id INT,
    order_date DATETIME NOT NULL,  
    status ENUM('выполненный', 'отмененный') DEFAULT 'выполненный',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10, 2) NOT NULL,  
    service_duration INT NOT NULL,  
    FOREIGN KEY (profile_id) REFERENCES profile(id),
    FOREIGN KEY (service_id) REFERENCES service(id),
    FOREIGN KEY (massager_id) REFERENCES massagers(id)
);
