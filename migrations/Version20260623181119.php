<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260623181119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE training_exercise (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, exercise_type VARCHAR(255) NOT NULL, position INT NOT NULL, duration INT DEFAULT NULL, distance DOUBLE PRECISION DEFAULT NULL, repetitions INT DEFAULT NULL, target_pace_seconds INT DEFAULT NULL, recovery_duration INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, training_session_id INT NOT NULL, INDEX IDX_49BFC68BDB8156B9 (training_session_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE training_exercise ADD CONSTRAINT FK_49BFC68BDB8156B9 FOREIGN KEY (training_session_id) REFERENCES training_session (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_exercise DROP FOREIGN KEY FK_49BFC68BDB8156B9');
        $this->addSql('DROP TABLE training_exercise');
    }
}
