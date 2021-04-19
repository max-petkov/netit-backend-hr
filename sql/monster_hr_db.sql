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
    password VARCHAR(50),
    file_name VARCHAR(255),
    file_mime VARCHAR(255),
    file_size INT,
    file_data MEDIUMBLOB
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

CREATE TABLE tb_msg_box_job_seeker(
	id INT AUTO_INCREMENT PRIMARY KEY,
    send_date DATE,
    hr_id INT,
    job_seeker_id INT,
    subject VARCHAR(255),
    inbox_msg VARCHAR(1000),
    is_viewed VARCHAR(1),
    sent_msg VARCHAR(1000)
);

CREATE TABLE tb_msg_box_hr(
	id INT AUTO_INCREMENT PRIMARY KEY,
    send_date DATE,
    hr_id INT,
    company_id INT,
    job_seeker_id INT,
    subject VARCHAR(255),
    inbox_msg VARCHAR(1000),
    is_viewed VARCHAR(1),
    sent_msg VARCHAR(1000)
);

CREATE TABLE tb_msg_box_company(
	id INT AUTO_INCREMENT PRIMARY KEY,
    send_date DATE,
    hr_id INT,
    company_id INT,
    subject VARCHAR(255),
    inbox_msg VARCHAR(1000),
    is_viewed VARCHAR(1),
    sent_msg VARCHAR(1000)
);

SELECT * FROM tb_msg_box_hr;
SELECT * FROM tb_msg_box_job_seeker;
SELECT * FROM tb_hr;
SELECT * FROM tb_applied_jobs;
SELECT * FROM tb_job_seeker_profile;
SELECT * FROM tb_published_jobs;
SELECT * FROM tb_company_profile;

-- Got a packet bigger than 'max_allowed_packet' bytes in C:\xampp\htdocs\netit-backend-hr\src\upload-file.php:15
set global net_buffer_length=1000000; 
set global max_allowed_packet=1000000000; 