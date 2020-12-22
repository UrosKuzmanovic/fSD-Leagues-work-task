<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201222170921 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE igrac (igracID INT AUTO_INCREMENT NOT NULL, ime VARCHAR(255) NOT NULL, prezime VARCHAR(255) NOT NULL, jmbg VARCHAR(13) NOT NULL, datum_rodj DATE NOT NULL, pozicija VARCHAR(255) NOT NULL, mestoID INT NOT NULL, klubID INT NOT NULL, INDEX IDX_BD9FBA1669A3CBE (mestoID), INDEX IDX_BD9FBA1C88BFA53 (klubID), PRIMARY KEY(igracID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE klub (klubID INT AUTO_INCREMENT NOT NULL, naziv VARCHAR(255) NOT NULL, mestoID INT NOT NULL, INDEX IDX_7D5A109D669A3CBE (mestoID), PRIMARY KEY(klubID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mesto (mestoID INT AUTO_INCREMENT NOT NULL, ptt INT NOT NULL, naziv VARCHAR(255) NOT NULL, PRIMARY KEY(mestoID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nastup (nastupID INT AUTO_INCREMENT NOT NULL, ocena_igraca NUMERIC(3, 1) NOT NULL, igracID INT NOT NULL, utakmicaID INT NOT NULL, INDEX IDX_F51A2058CA0CEDF (igracID), INDEX IDX_F51A205DB918DCE (utakmicaID), PRIMARY KEY(nastupID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE takmicenje (takmicenjeID INT AUTO_INCREMENT NOT NULL, naziv_takmicenja VARCHAR(255) NOT NULL, PRIMARY KEY(takmicenjeID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utakmica (utakmicaID INT AUTO_INCREMENT NOT NULL, datum_odigravanja DATE NOT NULL, takmicenjeID INT NOT NULL, domacinID INT NOT NULL, gostID INT NOT NULL, INDEX IDX_4ED098DD8A4792C (takmicenjeID), INDEX IDX_4ED098DD4D7BA530 (domacinID), INDEX IDX_4ED098DDC529C0E6 (gostID), PRIMARY KEY(utakmicaID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE igrac ADD CONSTRAINT FK_BD9FBA1669A3CBE FOREIGN KEY (mestoID) REFERENCES mesto (mestoID)');
        $this->addSql('ALTER TABLE igrac ADD CONSTRAINT FK_BD9FBA1C88BFA53 FOREIGN KEY (klubID) REFERENCES klub (klubID)');
        $this->addSql('ALTER TABLE klub ADD CONSTRAINT FK_7D5A109D669A3CBE FOREIGN KEY (mestoID) REFERENCES mesto (mestoID)');
        $this->addSql('ALTER TABLE nastup ADD CONSTRAINT FK_F51A2058CA0CEDF FOREIGN KEY (igracID) REFERENCES igrac (igracID)');
        $this->addSql('ALTER TABLE nastup ADD CONSTRAINT FK_F51A205DB918DCE FOREIGN KEY (utakmicaID) REFERENCES utakmica (utakmicaID)');
        $this->addSql('ALTER TABLE utakmica ADD CONSTRAINT FK_4ED098DD8A4792C FOREIGN KEY (takmicenjeID) REFERENCES takmicenje (takmicenjeID)');
        $this->addSql('ALTER TABLE utakmica ADD CONSTRAINT FK_4ED098DD4D7BA530 FOREIGN KEY (domacinID) REFERENCES klub (klubID)');
        $this->addSql('ALTER TABLE utakmica ADD CONSTRAINT FK_4ED098DDC529C0E6 FOREIGN KEY (gostID) REFERENCES klub (klubID)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nastup DROP FOREIGN KEY FK_F51A2058CA0CEDF');
        $this->addSql('ALTER TABLE igrac DROP FOREIGN KEY FK_BD9FBA1C88BFA53');
        $this->addSql('ALTER TABLE utakmica DROP FOREIGN KEY FK_4ED098DD4D7BA530');
        $this->addSql('ALTER TABLE utakmica DROP FOREIGN KEY FK_4ED098DDC529C0E6');
        $this->addSql('ALTER TABLE igrac DROP FOREIGN KEY FK_BD9FBA1669A3CBE');
        $this->addSql('ALTER TABLE klub DROP FOREIGN KEY FK_7D5A109D669A3CBE');
        $this->addSql('ALTER TABLE utakmica DROP FOREIGN KEY FK_4ED098DD8A4792C');
        $this->addSql('ALTER TABLE nastup DROP FOREIGN KEY FK_F51A205DB918DCE');
        $this->addSql('DROP TABLE igrac');
        $this->addSql('DROP TABLE klub');
        $this->addSql('DROP TABLE mesto');
        $this->addSql('DROP TABLE nastup');
        $this->addSql('DROP TABLE takmicenje');
        $this->addSql('DROP TABLE utakmica');
    }
}
