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
    published_date VARCHAR(10),
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
    job_id INT,
    job_seeker_id INT,
    is_applied VARCHAR(1)
); 

SELECT * FROM tb_job_seeker_profile;

SELECT * FROM tb_published_jobs ORDER BY id DESC;
SELECT * FROM tb_company_profile;