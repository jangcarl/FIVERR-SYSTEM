-- Clean up (drop in correct order to avoid FK errors)
DROP TABLE IF EXISTS offers;
DROP TABLE IF EXISTS proposals;
DROP TABLE IF EXISTS subcategories;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS fiverr_clone_users;

-- Categories table
CREATE TABLE categories (
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(255) NOT NULL
);

-- Users table
CREATE TABLE fiverr_clone_users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255),
  email VARCHAR(255) UNIQUE NOT NULL,
  password TEXT,
  is_client TINYINT(1),
  bio_description TEXT,
  display_picture TEXT,
  contact_number VARCHAR(255),
  date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  role ENUM('administrator','client','freelancer') DEFAULT 'client'
);

-- Subcategories table
CREATE TABLE subcategories (
  subcategory_id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT NOT NULL,
  subcategory_name VARCHAR(255) NOT NULL,
  FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

-- Proposals table
CREATE TABLE proposals (
  proposal_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  description TEXT,
  image TEXT,
  min_price INT,
  max_price INT,
  view_count INT DEFAULT 0,
  date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  category_id INT,
  subcategory_id INT,
  FOREIGN KEY (user_id) REFERENCES fiverr_clone_users(user_id),
  FOREIGN KEY (category_id) REFERENCES categories(category_id),
  FOREIGN KEY (subcategory_id) REFERENCES subcategories(subcategory_id)
);

-- Offers table
CREATE TABLE offers (
  offer_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  description TEXT,
  proposal_id INT,
  date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_offer_per_client (user_id, proposal_id),
  FOREIGN KEY (user_id) REFERENCES fiverr_clone_users(user_id),
  FOREIGN KEY (proposal_id) REFERENCES proposals(proposal_id)
);

-- =====================
-- INSERT DUMP DATA
-- =====================

-- Categories
INSERT INTO categories (category_name) VALUES
('Web Development'),
('Graphic Design'),
('Writing & Translation');

-- Subcategories
INSERT INTO subcategories (category_id, subcategory_name) VALUES
(1, 'Frontend Development'),
(1, 'Backend Development'),
(2, 'Logo Design'),
(2, 'Illustration'),
(3, 'Copywriting'),
(3, 'Technical Writing');

-- Users
INSERT INTO fiverr_clone_users (username, email, password, is_client, bio_description, role) VALUES
('alice', 'alice@example.com', 'password123', 0, 'Full-stack developer', 'freelancer'),
('bob', 'bob@example.com', 'password123', 1, 'Looking for website work', 'client'),
('charlie', 'charlie@example.com', 'password123', 0, 'Graphic designer', 'freelancer');

-- Proposals
INSERT INTO proposals (user_id, description, image, min_price, max_price, category_id, subcategory_id) VALUES
(1, 'I will build a responsive website', 'web1.png', 100, 300, 1, 1),
(1, 'I will create REST APIs', 'web2.png', 200, 500, 1, 2),
(3, 'I will design a modern logo', 'logo1.png', 50, 150, 2, 3),
(3, 'I will create detailed illustrations', 'illu1.png', 80, 250, 2, 4);

-- Offers
INSERT INTO offers (user_id, description, proposal_id) VALUES
(2, 'Interested in a website build project', 1),
(2, 'Need API integration for my app', 2);
