<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201224203559 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `match` ADD homeClubGoals INT NOT NULL, ADD awayClubGoals INT NOT NULL, DROP home_club_goals, DROP away_club_goals');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `match` ADD home_club_goals INT NOT NULL, ADD away_club_goals INT NOT NULL, DROP homeClubGoals, DROP awayClubGoals');
    }
}
