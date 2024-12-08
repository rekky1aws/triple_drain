<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241208004226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, pinball_id INT NOT NULL, player_id INT NOT NULL, score BIGINT NOT NULL, position INT NOT NULL, top50_points INT DEFAULT NULL, top100_points INT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_329937514BD1277E (pinball_id), INDEX IDX_3299375199E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937514BD1277E FOREIGN KEY (pinball_id) REFERENCES pinball (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_3299375199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('DROP INDEX UNIQ_64C19C15E237E06 ON category');
        $this->addSql('ALTER TABLE pinball DROP FOREIGN KEY FK_2D8B0FAC9777D11E');
        $this->addSql('DROP INDEX IDX_2D8B0FAC9777D11E ON pinball');
        $this->addSql('ALTER TABLE pinball CHANGE category_id_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE pinball ADD CONSTRAINT FK_2D8B0FAC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_2D8B0FAC12469DE2 ON pinball (category_id)');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65B842D717');
        $this->addSql('DROP INDEX IDX_98197A65B842D717 ON player');
        $this->addSql('ALTER TABLE player CHANGE team_id_id team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_98197A65296CD8AE ON player (team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937514BD1277E');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_3299375199E6F5DF');
        $this->addSql('DROP TABLE score');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65296CD8AE');
        $this->addSql('DROP INDEX IDX_98197A65296CD8AE ON player');
        $this->addSql('ALTER TABLE player CHANGE team_id team_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65B842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_98197A65B842D717 ON player (team_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C15E237E06 ON category (name)');
        $this->addSql('ALTER TABLE pinball DROP FOREIGN KEY FK_2D8B0FAC12469DE2');
        $this->addSql('DROP INDEX IDX_2D8B0FAC12469DE2 ON pinball');
        $this->addSql('ALTER TABLE pinball CHANGE category_id category_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE pinball ADD CONSTRAINT FK_2D8B0FAC9777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_2D8B0FAC9777D11E ON pinball (category_id_id)');
    }
}
