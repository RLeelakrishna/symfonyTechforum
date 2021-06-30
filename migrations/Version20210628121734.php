<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210628121734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer_comments ADD answer_id INT NOT NULL');
        $this->addSql('ALTER TABLE answer_comments ADD CONSTRAINT FK_78D4974FAA334807 FOREIGN KEY (answer_id) REFERENCES answers (id)');
        $this->addSql('CREATE INDEX IDX_78D4974FAA334807 ON answer_comments (answer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer_comments DROP FOREIGN KEY FK_78D4974FAA334807');
        $this->addSql('DROP INDEX IDX_78D4974FAA334807 ON answer_comments');
        $this->addSql('ALTER TABLE answer_comments DROP answer_id');
    }
}
