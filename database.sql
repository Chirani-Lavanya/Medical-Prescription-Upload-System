CREATE DATABASE IF NOT EXISTS prescription_system;
USE prescription_system;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  address TEXT,
  contact VARCHAR(20),
  dob DATE,
  password VARCHAR(255),
  role ENUM('user','pharmacy') DEFAULT 'user'
);

CREATE TABLE prescriptions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  note TEXT,
  delivery_address TEXT,
  delivery_time VARCHAR(50),
  image1 VARCHAR(255),
  image2 VARCHAR(255),
  image3 VARCHAR(255),
  image4 VARCHAR(255),
  image5 VARCHAR(255),
  status ENUM('pending','quoted') DEFAULT 'pending',
  FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE quotations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  prescription_id INT,
  pharmacy_id INT,
  details TEXT,
  total DECIMAL(10,2),
  status ENUM('pending','accepted','rejected') DEFAULT 'pending',
  FOREIGN KEY(prescription_id) REFERENCES prescriptions(id),
  FOREIGN KEY(pharmacy_id) REFERENCES users(id)
);
