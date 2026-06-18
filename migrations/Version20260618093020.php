<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260618093020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE training_session (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, scheduled_date DATETIME NOT NULL, planned_distance DOUBLE PRECISION DEFAULT NULL, planned_duration INT DEFAULT NULL, coach_comment LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, athlete_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_D7A45DAFE6BCB8B (athlete_id), INDEX IDX_D7A45DAC54C8C93 (type_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE training_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(7) NOT NULL, icon VARCHAR(50) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE training_session ADD CONSTRAINT FK_D7A45DAFE6BCB8B FOREIGN KEY (athlete_id) REFERENCES athlete (id)');
        $this->addSql('ALTER TABLE training_session ADD CONSTRAINT FK_D7A45DAC54C8C93 FOREIGN KEY (type_id) REFERENCES training_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_session DROP FOREIGN KEY FK_D7A45DAFE6BCB8B');
        $this->addSql('ALTER TABLE training_session DROP FOREIGN KEY FK_D7A45DAC54C8C93');
        $this->addSql('DROP TABLE training_session');
        $this->addSql('DROP TABLE training_type');
    }
}
