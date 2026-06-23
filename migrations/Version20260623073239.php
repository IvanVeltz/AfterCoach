<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260623073239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE completed_session (id INT AUTO_INCREMENT NOT NULL, actual_distance DOUBLE PRECISION DEFAULT NULL, actual_duration INT DEFAULT NULL, athlete_comment LONGTEXT DEFAULT NULL, completed_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, training_session_id INT NOT NULL, UNIQUE INDEX UNIQ_97483EB0DB8156B9 (training_session_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE completed_session ADD CONSTRAINT FK_97483EB0DB8156B9 FOREIGN KEY (training_session_id) REFERENCES training_session (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE completed_session DROP FOREIGN KEY FK_97483EB0DB8156B9');
        $this->addSql('DROP TABLE completed_session');
    }
}
