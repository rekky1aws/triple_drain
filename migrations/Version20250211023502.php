<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250211023502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_64C19C15E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE csv_import (id INT AUTO_INCREMENT NOT NULL, imported_by_id INT NOT NULL, imported_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', filename VARCHAR(255) NOT NULL, INDEX IDX_835A46E274953CEA (imported_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pinball (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2D8B0FAC5E237E06 (name), INDEX IDX_2D8B0FAC12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, has_cheated TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_98197A6586CC499D (pseudo), INDEX IDX_98197A65296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, pinball_id INT NOT NULL, player_id INT NOT NULL, value BIGINT NOT NULL, position INT DEFAULT NULL, top50_points INT DEFAULT NULL, top100_points INT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_329937514BD1277E (pinball_id), INDEX IDX_3299375199E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C4E0A61F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE csv_import ADD CONSTRAINT FK_835A46E274953CEA FOREIGN KEY (imported_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pinball ADD CONSTRAINT FK_2D8B0FAC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937514BD1277E FOREIGN KEY (pinball_id) REFERENCES pinball (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_3299375199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE csv_import DROP FOREIGN KEY FK_835A46E274953CEA');
        $this->addSql('ALTER TABLE pinball DROP FOREIGN KEY FK_2D8B0FAC12469DE2');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65296CD8AE');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937514BD1277E');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_3299375199E6F5DF');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE csv_import');
        $this->addSql('DROP TABLE pinball');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
