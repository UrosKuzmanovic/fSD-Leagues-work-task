<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201224202916 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nastup DROP FOREIGN KEY FK_F51A2058CA0CEDF');
        $this->addSql('ALTER TABLE igrac DROP FOREIGN KEY FK_BD9FBA1C88BFA53');
        $this->addSql('ALTER TABLE utakmica DROP FOREIGN KEY FK_4ED098DD4D7BA530');
        $this->addSql('ALTER TABLE utakmica DROP FOREIGN KEY FK_4ED098DDC529C0E6');
        $this->addSql('ALTER TABLE igrac DROP FOREIGN KEY FK_BD9FBA1669A3CBE');
        $this->addSql('ALTER TABLE klub DROP FOREIGN KEY FK_7D5A109D669A3CBE');
        $this->addSql('ALTER TABLE utakmica DROP FOREIGN KEY FK_4ED098DD8A4792C');
        $this->addSql('ALTER TABLE nastup DROP FOREIGN KEY FK_F51A205DB918DCE');
        $this->addSql('CREATE TABLE club (clubID INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, placeID INT NOT NULL, INDEX IDX_B8EE38729DE5BE6A (placeID), PRIMARY KEY(clubID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition (competitionID INT AUTO_INCREMENT NOT NULL, competitionName VARCHAR(255) NOT NULL, PRIMARY KEY(competitionID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `game` (matchID INT AUTO_INCREMENT NOT NULL, matchDate DATE NOT NULL, home_club_goals INT NOT NULL, away_club_goals INT NOT NULL, competitionID INT NOT NULL, homeID INT NOT NULL, awayID INT NOT NULL, INDEX IDX_7A5BC505DED5252A (competitionID), INDEX IDX_7A5BC505995D9BD8 (homeID), INDEX IDX_7A5BC505B128F3FF (awayID), PRIMARY KEY(matchID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (performanceID INT AUTO_INCREMENT NOT NULL, playerRating NUMERIC(3, 1) NOT NULL, playerID INT NOT NULL, matchID INT NOT NULL, INDEX IDX_82D79681B989FCE3 (playerID), INDEX IDX_82D7968187AADB1B (matchID), PRIMARY KEY(performanceID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (placeID INT AUTO_INCREMENT NOT NULL, ptt INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(placeID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (playerID INT AUTO_INCREMENT NOT NULL, firstName VARCHAR(255) NOT NULL, lastName VARCHAR(255) NOT NULL, jmbg VARCHAR(13) NOT NULL, dateOfBirth DATE NOT NULL, positions VARCHAR(255) NOT NULL, placeID INT NOT NULL, clubID INT NOT NULL, INDEX IDX_98197A659DE5BE6A (placeID), INDEX IDX_98197A6524D8783E (clubID), PRIMARY KEY(playerID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE38729DE5BE6A FOREIGN KEY (placeID) REFERENCES place (placeID)');
        $this->addSql('ALTER TABLE `game` ADD CONSTRAINT FK_7A5BC505DED5252A FOREIGN KEY (competitionID) REFERENCES competition (competitionID)');
        $this->addSql('ALTER TABLE `game` ADD CONSTRAINT FK_7A5BC505995D9BD8 FOREIGN KEY (homeID) REFERENCES club (clubID)');
        $this->addSql('ALTER TABLE `game` ADD CONSTRAINT FK_7A5BC505B128F3FF FOREIGN KEY (awayID) REFERENCES club (clubID)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D79681B989FCE3 FOREIGN KEY (playerID) REFERENCES player (playerID)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968187AADB1B FOREIGN KEY (matchID) REFERENCES `game` (matchID)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A659DE5BE6A FOREIGN KEY (placeID) REFERENCES place (placeID)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6524D8783E FOREIGN KEY (clubID) REFERENCES club (clubID)');
        $this->addSql('DROP TABLE igrac');
        $this->addSql('DROP TABLE klub');
        $this->addSql('DROP TABLE mesto');
        $this->addSql('DROP TABLE nastup');
        $this->addSql('DROP TABLE takmicenje');
        $this->addSql('DROP TABLE utakmica');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `game` DROP FOREIGN KEY FK_7A5BC505995D9BD8');
        $this->addSql('ALTER TABLE `game` DROP FOREIGN KEY FK_7A5BC505B128F3FF');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6524D8783E');
        $this->addSql('ALTER TABLE `game` DROP FOREIGN KEY FK_7A5BC505DED5252A');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968187AADB1B');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE38729DE5BE6A');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A659DE5BE6A');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D79681B989FCE3');
        $this->addSql('CREATE TABLE igrac (igracID INT AUTO_INCREMENT NOT NULL, ime VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prezime VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, jmbg VARCHAR(13) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, datumRodj DATE NOT NULL, mestoID INT NOT NULL, klubID INT NOT NULL, pozicija VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_BD9FBA1669A3CBE (mestoID), INDEX IDX_BD9FBA1C88BFA53 (klubID), PRIMARY KEY(igracID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE klub (klubID INT AUTO_INCREMENT NOT NULL, naziv VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mestoID INT NOT NULL, INDEX IDX_7D5A109D669A3CBE (mestoID), PRIMARY KEY(klubID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mesto (mestoID INT AUTO_INCREMENT NOT NULL, ptt INT NOT NULL, naziv VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(mestoID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE nastup (nastupID INT AUTO_INCREMENT NOT NULL, ocenaIgraca NUMERIC(3, 1) NOT NULL, igracID INT NOT NULL, utakmicaID INT NOT NULL, INDEX IDX_F51A2058CA0CEDF (igracID), INDEX IDX_F51A205DB918DCE (utakmicaID), PRIMARY KEY(nastupID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE takmicenje (takmicenjeID INT AUTO_INCREMENT NOT NULL, nazivTakmicenja VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(takmicenjeID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utakmica (utakmicaID INT AUTO_INCREMENT NOT NULL, datumOdigravanja DATE NOT NULL, takmicenjeID INT NOT NULL, domacinID INT NOT NULL, gostID INT NOT NULL, broj_golova_domacin INT NOT NULL, broj_golova_gost INT NOT NULL, INDEX IDX_4ED098DD4D7BA530 (domacinID), INDEX IDX_4ED098DD8A4792C (takmicenjeID), INDEX IDX_4ED098DDC529C0E6 (gostID), PRIMARY KEY(utakmicaID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE igrac ADD CONSTRAINT FK_BD9FBA1669A3CBE FOREIGN KEY (mestoID) REFERENCES mesto (mestoid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE igrac ADD CONSTRAINT FK_BD9FBA1C88BFA53 FOREIGN KEY (klubID) REFERENCES klub (klubid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE klub ADD CONSTRAINT FK_7D5A109D669A3CBE FOREIGN KEY (mestoID) REFERENCES mesto (mestoid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE nastup ADD CONSTRAINT FK_F51A2058CA0CEDF FOREIGN KEY (igracID) REFERENCES igrac (igracid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE nastup ADD CONSTRAINT FK_F51A205DB918DCE FOREIGN KEY (utakmicaID) REFERENCES utakmica (utakmicaid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE utakmica ADD CONSTRAINT FK_4ED098DD4D7BA530 FOREIGN KEY (domacinID) REFERENCES klub (klubid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE utakmica ADD CONSTRAINT FK_4ED098DD8A4792C FOREIGN KEY (takmicenjeID) REFERENCES takmicenje (takmicenjeid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE utakmica ADD CONSTRAINT FK_4ED098DDC529C0E6 FOREIGN KEY (gostID) REFERENCES klub (klubid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE `game`');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE player');
    }
}
