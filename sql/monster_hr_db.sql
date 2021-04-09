CREATE DATABASE monster_hr_db;
USE monster_hr_db;

CREATE TABLE tb_job_seeker_profile (
	id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(255),
    address VARCHAR(50) DEFAULT "-",
    website VARCHAR(255) DEFAULT "-",
    short_introduction VARCHAR(1000) DEFAULT "- 👋 Hi, I’m ...
- 👀 I’m interested in ...
- 🌱 I’m currently learning ...
- 💞️ I’m looking to collaborate on ...
- 📫 How to reach me ...",
    password VARCHAR(50)
);

CREATE TABLE tb_company_profile (
	id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    company_name VARCHAR(255),
    company_description VARCHAR(1000),
    email VARCHAR(255),
    address VARCHAR(50) DEFAULT "-",
	website VARCHAR(255) DEFAULT "-",
	slogan VARCHAR(50),
	company_history VARCHAR(1000),
	company_mission VARCHAR(1000),
	frontend_branch VARCHAR(10),
	backend_branch VARCHAR(10),
	fullstack_branch VARCHAR(10),
	qa_branch VARCHAR(10),
	mobdev_branch VARCHAR(10),
	ux_ui_branch VARCHAR(10),
    password VARCHAR(50)
);

CREATE TABLE tb_published_jobs (
	id INT PRIMARY KEY AUTO_INCREMENT,
    published_date DATE,
    company_id VARCHAR(1000),
    company_username VARCHAR(50),
    company_name VARCHAR(255),
    company_email VARCHAR(255),
    job_title VARCHAR(255),
    job_time VARCHAR(20),
    frontend_tag VARCHAR(10),
    backend_tag VARCHAR(10),
    fullstack_tag VARCHAR(10),
    qa_tag VARCHAR(10),
    mobdev_tag VARCHAR(10),
    ux_ui_tag VARCHAR(10),
    job_salary VARCHAR(100),
    job_description VARCHAR(1000),
    is_active VARCHAR(1) DEFAULT 'Y',
    random_chars CHAR(32)
);

CREATE TABLE tb_applied_jobs (
	applied_id INT AUTO_INCREMENT PRIMARY KEY,
    applied_date DATE,
    job_id INT,
    job_seeker_id INT,
    motivation_speech VARCHAR(1000),
    is_applied VARCHAR(1),
    is_interviewed VARCHAR (1),
    is_approved VARCHAR (1)
);

CREATE TABLE tb_hr (
	id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT,
    username VARCHAR(50),
    email VARCHAR(255),
    password VARCHAR(50)
);
SELECT a.*, b.id, b.username, c.*, d.*, e.* FROM tb_hr AS a 
INNER JOIN tb_company_profile AS b 
ON b.id=a.company_id
INNER JOIN tb_published_jobs AS c 
ON c.company_id=b.id
INNER JOIN tb_applied_jobs AS d
ON d.job_id = c.id
INNER JOIN tb_job_seeker_profile AS e
ON d.job_seeker_id = e.id
WHERE a.id=2 AND d.is_approved IS null AND d.is_interviewed IS null;


-- TRUNCATE TABLE tb_published_jobs;
TRUNCATE TABLE tb_applied_jobs;
SELECT * FROM tb_hr;
SELECT * FROM tb_applied_jobs;
SELECT * FROM tb_job_seeker_profile;
SELECT * FROM tb_published_jobs;
SELECT * FROM tb_company_profile;