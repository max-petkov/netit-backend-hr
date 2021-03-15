CREATE DATABASE registered_users;
USE registered_users;

CREATE TABLE employees(
	employee_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(255),
    password VARCHAR(50)
);

CREATE TABLE companies(
	company_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    company_name VARCHAR(255),
    company_it_branches VARCHAR(255),
    company_description VARCHAR(500),
    email VARCHAR(255),
    password VARCHAR(50)
);

SELECT * FROM employees;

SELECT * FROM companies;

