<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170115095350 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer ADD ip_address VARCHAR(100) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE phone phone VARCHAR(20) DEFAULT NULL, CHANGE billing billing LONGTEXT DEFAULT NULL, CHANGE delivery_address delivery_address VARCHAR(255) DEFAULT NULL, CHANGE pick_up_address pick_up_address VARCHAR(255) DEFAULT NULL, CHANGE driver_license driver_license VARCHAR(100) DEFAULT NULL, CHANGE passport passport VARCHAR(100) DEFAULT NULL, CHANGE driving_licence_expiration_date driving_licence_expiration_date DATETIME DEFAULT NULL, CHANGE aditional_phone additional_phone VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE booking ADD pickup_location_latitude DOUBLE PRECISION DEFAULT NULL, ADD pickup_location_longitude DOUBLE PRECISION DEFAULT NULL, ADD drop_off_location_latitude DOUBLE PRECISION DEFAULT NULL, ADD drop_off_location_longitude DOUBLE PRECISION DEFAULT NULL, ADD services_requested VARCHAR(255) DEFAULT NULL, ADD special_requirements VARCHAR(255) DEFAULT NULL, ADD customer_ip_address VARCHAR(255) DEFAULT NULL, ADD unit_number VARCHAR(255) DEFAULT NULL, ADD booking_status VARCHAR(255) DEFAULT NULL, CHANGE pick_up_location pick_up_location VARCHAR(255) DEFAULT NULL, CHANGE drop_off_location drop_off_location VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking DROP pickup_location_latitude, DROP pickup_location_longitude, DROP drop_off_location_latitude, DROP drop_off_location_longitude, DROP services_requested, DROP special_requirements, DROP customer_ip_address, DROP unit_number, DROP booking_status, CHANGE pick_up_location pick_up_location VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE drop_off_location drop_off_location VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE customer DROP ip_address, CHANGE email email VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE phone phone VARCHAR(20) NOT NULL COLLATE utf8_unicode_ci, CHANGE billing billing LONGTEXT NOT NULL COLLATE utf8_unicode_ci, CHANGE delivery_address delivery_address VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE pick_up_address pick_up_address VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE driver_license driver_license VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE driving_licence_expiration_date driving_licence_expiration_date DATETIME NOT NULL, CHANGE passport passport VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE additional_phone aditional_phone VARCHAR(20) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
