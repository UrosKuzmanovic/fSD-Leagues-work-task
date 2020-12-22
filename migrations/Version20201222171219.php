<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201222171219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nastup CHANGE ocena_igraca ocenaIgraca NUMERIC(3, 1) NOT NULL');
        $this->addSql('ALTER TABLE takmicenje CHANGE naziv_takmicenja nazivTakmicenja VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE utakmica CHANGE datum_odigravanja datumOdigravanja DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nastup CHANGE ocenaigraca ocena_igraca NUMERIC(3, 1) NOT NULL');
        $this->addSql('ALTER TABLE takmicenje CHANGE nazivtakmicenja naziv_takmicenja VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE utakmica CHANGE datumodigravanja datum_odigravanja DATE NOT NULL');
    }
}
