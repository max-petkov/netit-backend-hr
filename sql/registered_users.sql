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

ALTER TABLE tb_companies ADD address VARCHAR(50) DEFAULT "-";
ALTER TABLE tb_companies ADD website VARCHAR(255) DEFAULT "-";
ALTER TABLE tb_companies ADD slogan VARCHAR(50);
ALTER TABLE tb_companies ADD company_history VARCHAR(500);
ALTER TABLE tb_companies ADD company_mission VARCHAR(255);
ALTER TABLE tb_companies ADD frontend_branch VARCHAR(10);
ALTER TABLE tb_companies ADD backend_branch VARCHAR(10);
ALTER TABLE tb_companies ADD fullstack_branch VARCHAR(10);
ALTER TABLE tb_companies ADD qa_branch VARCHAR(10);
ALTER TABLE tb_companies ADD mobdev_branch VARCHAR(10);
ALTER TABLE tb_companies ADD ux_ui_branch VARCHAR(10);

-- ALTER TABLE tb_companies DROP company_it_branches;
-- ALTER TABLE tb_companies DROP COLUMN slogan;
-- ALTER TABLE tb_companies DROP COLUMN company_history;
-- ALTER TABLE tb_companies DROP COLUMN company_mission;
-- ALTER TABLE tb_employees DROP COLUMN website;
-- ALTER TABLE tb_employees DROP COLUMN short_introduction;

truncate table tb_companies;

SELECT * FROM tb_employees;
SELECT * FROM tb_companies;

