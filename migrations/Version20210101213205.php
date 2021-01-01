<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210101213205 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968187AADB1B');
        $this->addSql('CREATE TABLE game (gameID INT AUTO_INCREMENT NOT NULL, gameDate DATE NOT NULL, homeClubGoals INT NOT NULL, awayClubGoals INT NOT NULL, competitionID INT NOT NULL, homeID INT NOT NULL, awayID INT NOT NULL, INDEX IDX_232B318CDED5252A (competitionID), INDEX IDX_232B318C995D9BD8 (homeID), INDEX IDX_232B318CB128F3FF (awayID), PRIMARY KEY(gameID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CDED5252A FOREIGN KEY (competitionID) REFERENCES competition (competitionID)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C995D9BD8 FOREIGN KEY (homeID) REFERENCES club (clubID)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CB128F3FF FOREIGN KEY (awayID) REFERENCES club (clubID)');
        $this->addSql('DROP TABLE `match`');
        $this->addSql('DROP INDEX IDX_82D7968187AADB1B ON performance');
        $this->addSql('ALTER TABLE performance CHANGE matchid gameID INT NOT NULL');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D79681D73B976C FOREIGN KEY (gameID) REFERENCES game (gameID)');
        $this->addSql('CREATE INDEX IDX_82D79681D73B976C ON performance (gameID)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D79681D73B976C');
        $this->addSql('CREATE TABLE `match` (matchID INT AUTO_INCREMENT NOT NULL, matchDate DATE NOT NULL, competitionID INT NOT NULL, homeID INT NOT NULL, awayID INT NOT NULL, homeClubGoals INT NOT NULL, awayClubGoals INT NOT NULL, INDEX IDX_7A5BC505995D9BD8 (homeID), INDEX IDX_7A5BC505B128F3FF (awayID), INDEX IDX_7A5BC505DED5252A (competitionID), PRIMARY KEY(matchID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505995D9BD8 FOREIGN KEY (homeID) REFERENCES club (clubid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505B128F3FF FOREIGN KEY (awayID) REFERENCES club (clubid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505DED5252A FOREIGN KEY (competitionID) REFERENCES competition (competitionid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP INDEX IDX_82D79681D73B976C ON performance');
        $this->addSql('ALTER TABLE performance CHANGE gameid matchID INT NOT NULL');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968187AADB1B FOREIGN KEY (matchID) REFERENCES `match` (matchid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_82D7968187AADB1B ON performance (matchID)');
    }
}
