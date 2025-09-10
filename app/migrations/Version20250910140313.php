<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250910140313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercise (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, muscle_group VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, equipment VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise_set (id INT AUTO_INCREMENT NOT NULL, workout_exercise_id INT NOT NULL, sets_number INT NOT NULL, reps INT NOT NULL, weight DOUBLE PRECISION DEFAULT NULL, duration INT DEFAULT NULL, distance DOUBLE PRECISION DEFAULT NULL, completed TINYINT(1) NOT NULL, INDEX IDX_704B80A0E435DB6B (workout_exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workout (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, date DATETIME DEFAULT NULL, notes LONGTEXT DEFAULT NULL, INDEX IDX_649FFB72A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workout_exercise (id INT AUTO_INCREMENT NOT NULL, workout_id INT DEFAULT NULL, exercise_id INT DEFAULT NULL, order_in_workout INT NOT NULL, notes LONGTEXT DEFAULT NULL, INDEX IDX_76AB38AAA6CCCFC9 (workout_id), INDEX IDX_76AB38AAE934951A (exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercise_set ADD CONSTRAINT FK_704B80A0E435DB6B FOREIGN KEY (workout_exercise_id) REFERENCES workout_exercise (id)');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB72A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE workout_exercise ADD CONSTRAINT FK_76AB38AAA6CCCFC9 FOREIGN KEY (workout_id) REFERENCES workout (id)');
        $this->addSql('ALTER TABLE workout_exercise ADD CONSTRAINT FK_76AB38AAE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise_set DROP FOREIGN KEY FK_704B80A0E435DB6B');
        $this->addSql('ALTER TABLE workout DROP FOREIGN KEY FK_649FFB72A76ED395');
        $this->addSql('ALTER TABLE workout_exercise DROP FOREIGN KEY FK_76AB38AAA6CCCFC9');
        $this->addSql('ALTER TABLE workout_exercise DROP FOREIGN KEY FK_76AB38AAE934951A');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE exercise_set');
        $this->addSql('DROP TABLE workout');
        $this->addSql('DROP TABLE workout_exercise');
    }
}
