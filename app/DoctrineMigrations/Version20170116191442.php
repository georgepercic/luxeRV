<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170116191442 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicle ADD unit_number VARCHAR(255) DEFAULT NULL, ADD licence_number VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE booking DROP status');
        $this->addSql('ALTER TABLE settings CHANGE default_pick_up_time default_pick_up_time TIME DEFAULT NULL, CHANGE default_drop_off_time default_drop_off_time TIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking ADD status VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE settings CHANGE default_pick_up_time default_pick_up_time INT DEFAULT NULL, CHANGE default_drop_off_time default_drop_off_time INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle DROP unit_number, DROP licence_number');
    }
}
