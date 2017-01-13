<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170113162914 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, daily_miles INT NOT NULL, default_pick_up_date DATETIME DEFAULT NULL, default_drop_off_date DATETIME DEFAULT NULL, default_min_rent_days INT NOT NULL, tax_rate INT NOT NULL, deposit_amount_rate INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer ADD driving_licence_expiration_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD week_day_price INT NOT NULL, ADD week_end_price INT NOT NULL, ADD photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE booking ADD status VARCHAR(255) NOT NULL, ADD pick_up_location VARCHAR(255) NOT NULL, ADD drop_off_location VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE settings');
        $this->addSql('ALTER TABLE booking DROP status, DROP pick_up_location, DROP drop_off_location');
        $this->addSql('ALTER TABLE customer DROP driving_licence_expiration_date');
        $this->addSql('ALTER TABLE vehicle DROP week_day_price, DROP week_end_price, DROP photo');
    }
}
