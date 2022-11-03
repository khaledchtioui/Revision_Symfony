<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221103140153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student ADD id INT AUTO_INCREMENT NOT NULL, CHANGE ncs ncs VARCHAR(255) DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON student');
        $this->addSql('ALTER TABLE student DROP id, CHANGE ncs ncs INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE student ADD PRIMARY KEY (ncs)');
    }
}
