<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608072210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE posts_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE posts (id INT NOT NULL, post_author INT DEFAULT 0 NOT NULL, post_content TEXT DEFAULT \'\' NOT NULL, post_title VARCHAR(64) DEFAULT \'\' NOT NULL, post_status VARCHAR(16) DEFAULT \'darft\' NOT NULL, post_excerpt VARCHAR(255) DEFAULT \'\' NOT NULL, post_thumb VARCHAR(150) DEFAULT \'\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, first_name VARCHAR(64) DEFAULT \'\' NOT NULL, last_name VARCHAR(64) DEFAULT \'\' NOT NULL, email VARCHAR(100) DEFAULT \'\' NOT NULL, department VARCHAR(100) DEFAULT \'\' NOT NULL, role SMALLINT DEFAULT 0 NOT NULL, photo VARCHAR(150) DEFAULT \'\' NOT NULL, description TEXT DEFAULT \'\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE posts_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE team');
    }
}
