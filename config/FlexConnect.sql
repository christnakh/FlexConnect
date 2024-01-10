CREATE DATABASE IF NOT EXISTS NEOM;

USE NEOM;

CREATE TABLE User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    username VARCHAR(255) UNIQUE,
    phone_number VARCHAR(12),
    email VARCHAR(255),
    role VARCHAR(255),
    password VARCHAR(255),
    balance DECIMAL(10, 2) DEFAULT 0.00
)ENGINE = INNODB;

CREATE TABLE Work (
    id INT AUTO_INCREMENT PRIMARY KEY,
    work_name VARCHAR(255)
);

CREATE TABLE User_Work (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    work_id INT,
    location VARCHAR(255),
    active BOOLEAN DEFAULT TRUE,
    cv_file BLOB,
    FOREIGN KEY (user_id) REFERENCES User(id),
    FOREIGN KEY (work_id) REFERENCES Work(id)
);


CREATE TABLE Work_Booking_Time (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    work_id INT,
    day_of_week VARCHAR(255),
    booking_datetime DATETIME,
    FOREIGN KEY (user_id) REFERENCES User(id),
    FOREIGN KEY (work_id) REFERENCES Work(id)
);

CREATE TABLE Work_Booking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id_client INT,
    user_id_worker INT,
    work_id INT,
    time_slot_id INT,
    booking_datetime DATETIME,
    FOREIGN KEY (user_id_client) REFERENCES User(id),
    FOREIGN KEY (user_id_worker) REFERENCES User(id),
    FOREIGN KEY (work_id) REFERENCES Work(id),
    FOREIGN KEY (time_slot_id) REFERENCES Work_Booking_Time(id)
);

CREATE TABLE Work_Review (
    id INT AUTO_INCREMENT PRIMARY KEY,
    work_booking_id INT,
    user_id_client INT,
    stars INT,
    comment TEXT,
    review_date DATE,
    FOREIGN KEY (work_booking_id) REFERENCES Work_Booking(id),
    FOREIGN KEY (user_id_client) REFERENCES User(id)
);

INSERT INTO User (first_name, last_name, username, email, role, password, balance, cv_file) VALUES ('John', 'Doe', 'john.doe', 'john@example.com', 'worker', 'password123', 1000.00, 'john_cv.pdf');
INSERT INTO User (first_name, last_name, username, email, role, password, balance, cv_file) VALUES ('Alice', 'Smith', 'alice', 'alice@example.com', 'client', 'alicepass', 0.00, 'alice_cv.pdf');

INSERT INTO Work (work_name) VALUES ('Programming');
INSERT INTO Work (work_name) VALUES ('Graphic Design');

INSERT INTO User_Work (user_id, work_id, location, active) VALUES (1, 1, NULL, TRUE);
INSERT INTO User_Work (user_id, work_id, location, active) VALUES (2, 1, NULL, TRUE);

INSERT INTO Work_Booking_Time (user_id, work_id, day_of_week, booking_datetime) VALUES (1, 1, 'Monday', '2023-12-12 09:00:00');
INSERT INTO Work_Booking_Time (user_id, work_id, day_of_week, booking_datetime) VALUES (1, 1, 'Tuesday', '2023-12-13 10:00:00');

INSERT INTO Work_Booking (user_id_client, user_id_worker, work_id, time_slot_id, booking_datetime) VALUES (2, 1, 1, 1, '2023-12-12 09:00:00');

INSERT INTO Work_Review (work_booking_id, user_id_client, stars, comment, review_date) VALUES (1, 2, 4, 'Great job!', '2023-12-12');
