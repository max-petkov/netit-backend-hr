CREATE DATABASE registered_users;
USE registered_users;

CREATE TABLE employees(
	id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(255),
    password VARCHAR(50)
);

CREATE TABLE companies(
	id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    company_name VARCHAR(255),
    company_it_branches VARCHAR(255),
    company_description VARCHAR(500),
    email VARCHAR(255),
    password VARCHAR(50)
);

ALTER TABLE tb_employees ADD address VARCHAR(50);
ALTER TABLE tb_employees ADD website VARCHAR(255);
ALTER TABLE tb_employees ADD short_description VARCHAR(500);



RENAME TABLE `employees` TO `tb_employees`;
RENAME TABLE `companies` TO `tb_companies`;

SELECT * FROM tb_employees;
SELECT * FROM tb_companies;

