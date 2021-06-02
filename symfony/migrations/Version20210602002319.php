<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210602002319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE team ALTER id SET NOT NULL');
        $this->addSql('ALTER TABLE team ALTER first_name SET NOT NULL');
        $this->addSql('ALTER TABLE team ALTER last_name SET NOT NULL');
        $this->addSql('ALTER TABLE team ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE team ALTER id DROP NOT NULL');
        $this->addSql('ALTER TABLE team ALTER first_name DROP NOT NULL');
        $this->addSql('ALTER TABLE team ALTER last_name DROP NOT NULL');
    }
}
