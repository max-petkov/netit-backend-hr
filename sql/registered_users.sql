CREATE DATABASE registered_users;
USE registered_users;

CREATE TABLE tb_employees(
	id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(255),
    password VARCHAR(50)
);

CREATE TABLE tb_companies(
	id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    company_name VARCHAR(255),
    company_it_branches VARCHAR(255),
    company_description VARCHAR(500),
    email VARCHAR(255),
    password VARCHAR(50)
);

ALTER TABLE tb_employees ADD address VARCHAR(50) DEFAULT "-";
ALTER TABLE tb_employees ADD website VARCHAR(255) DEFAULT "-";
ALTER TABLE tb_employees ADD short_introduction VARCHAR(500) DEFAULT "- 👋 Hi, I’m ...
- 👀 I’m interested in ...
- 🌱 I’m currently learning ...
- 💞️ I’m looking to collaborate on ...
- 📫 How to reach me ...";

ALTER TABLE tb_employees DROP COLUMN address;
ALTER TABLE tb_employees DROP COLUMN website;
ALTER TABLE tb_employees DROP COLUMN short_introduction;

SELECT * FROM tb_employees;
SELECT * FROM tb_companies;

