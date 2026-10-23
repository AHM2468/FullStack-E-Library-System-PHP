CREATE DATABASE IF NOT EXISTS e_library
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;
USE e_library;

DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS borrows;
DROP TABLE IF EXISTS users;

CREATE TABLE books (
  ISBN varchar(20) NOT NULL PRIMARY KEY,
  title varchar(150) NOT NULL,
  author varchar(100) NOT NULL,
  category varchar(100) NOT NULL,
  publish_year int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE borrows (
  id int(10) NOT NULL PRIMARY KEY,
  user_id int(10) NOT NULL,
  ISBN varchar(20) NOT NULL,
  borrow_date date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE users (
  id int(10) NOT NULL PRIMARY KEY,
  full_name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO books (ISBN, title, author, category, publish_year) VALUES
('9780132145374', 'Database Processing (12th Edition)', 'David Kroenke', 'Databases', 2011),
('9780134685991', 'Effective Java (3rd Edition)', 'Joshua Bloch', 'Programming', 2017),
('9781118807323', 'Cabling (5th Edition)', 'Bill Woodward', 'Networking', 2014),
('9781284278309', 'Web Programming with HTML, CSS, and JavaScript (Second Edition)', 'John Dean', 'Web Development', 2018),
('9781491957660', 'Python for Data Analysis (2nd Edition)', 'Wes McKinney', 'Programming', 2017);


INSERT INTO users (id, full_name, email, password) VALUES
(1, 'Ahmed AL-Yamani', 'S220041166@seu.edu.sa', '11AA22jj33'),
(2, 'Khaled Taher', 'S210023361@seu.edu.sa', '11KK22hh33'),
(3, 'Mazin Filfilan', 'S220022623@seu.edu.sa', '11MM22aa33'),
(4, 'Mohsen Merdah', 'S200229879@seu.edu.sa', '11MM22oo33');


ALTER TABLE borrows
  MODIFY id int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE users
  MODIFY id int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;