<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250215100450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Generate database schema';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE years (
            id INT AUTO_INCREMENT NOT NULL,
            name SMALLINT UNSIGNED NOT NULL,
            PRIMARY KEY(id))
            DEFAULT CHARACTER SET utf8mb4
            COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE prefectures (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(25) NOT NULL,
            PRIMARY KEY(id))
            DEFAULT CHARACTER SET utf8mb4
            COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE populations (
            id INT AUTO_INCREMENT NOT NULL,
            year_id INT NOT NULL,
            prefecture_id INT NOT NULL,
            value INT NOT NULL,
            PRIMARY KEY(id),
            CONSTRAINT FK_POPULATION_YEAR FOREIGN KEY (year_id) REFERENCES years (id),
            CONSTRAINT FK_POPULATION_PREFECTURE FOREIGN KEY (prefecture_id) REFERENCES prefectures (id))
            DEFAULT CHARACTER SET utf8mb4
            COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
