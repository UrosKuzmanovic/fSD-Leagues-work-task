<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210108192437 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club ADD created_by VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE game ADD created_by VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968199E6F5DF');
        $this->addSql('ALTER TABLE performance ADD created_by VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE place ADD created_by VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE player ADD created_by VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club DROP created_by');
        $this->addSql('ALTER TABLE game DROP created_by');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968199E6F5DF');
        $this->addSql('ALTER TABLE performance DROP created_by');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place DROP created_by');
        $this->addSql('ALTER TABLE player DROP created_by');
    }
}
