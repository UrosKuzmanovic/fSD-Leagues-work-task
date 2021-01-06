<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210106132813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968199E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_82D7968199E6F5DF ON performance (player_id)');
        $this->addSql('ALTER TABLE player MODIFY playerID INT NOT NULL');
        $this->addSql('ALTER TABLE player DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE player ADD id INT NOT NULL, DROP playerID');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user ADD discr VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968199E6F5DF');
        $this->addSql('DROP INDEX IDX_82D7968199E6F5DF ON performance');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65BF396750');
        $this->addSql('ALTER TABLE player DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE player ADD playerID INT AUTO_INCREMENT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE player ADD PRIMARY KEY (playerID)');
        $this->addSql('ALTER TABLE user DROP discr');
    }
}
