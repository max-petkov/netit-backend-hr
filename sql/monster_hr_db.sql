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