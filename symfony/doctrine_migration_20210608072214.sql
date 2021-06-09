-- Doctrine Migration File Generated on 2021-06-08 07:22:14

-- Version DoctrineMigrations\Version20210608072210
CREATE SEQUENCE posts_id_seq INCREMENT BY 1 MINVALUE 1 START 1;
CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1;
CREATE TABLE posts (id INT NOT NULL, post_author INT DEFAULT 0 NOT NULL, post_content TEXT DEFAULT '' NOT NULL, post_title VARCHAR(64) DEFAULT '' NOT NULL, post_status VARCHAR(16) DEFAULT 'darft' NOT NULL, post_excerpt VARCHAR(255) DEFAULT '' NOT NULL, post_thumb VARCHAR(150) DEFAULT '' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id));
CREATE TABLE team (id INT NOT NULL, first_name VARCHAR(64) DEFAULT '' NOT NULL, last_name VARCHAR(64) DEFAULT '' NOT NULL, email VARCHAR(100) DEFAULT '' NOT NULL, department VARCHAR(100) DEFAULT '' NOT NULL, role SMALLINT DEFAULT 0 NOT NULL, photo VARCHAR(150) DEFAULT '' NOT NULL, description TEXT DEFAULT '' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id));
