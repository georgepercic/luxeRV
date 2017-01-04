<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170103233440 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE invoice ADD tax DOUBLE PRECISION DEFAULT NULL, ADD status VARCHAR(255) NOT NULL, DROP vat, CHANGE booking_id booking_id INT DEFAULT NULL, CHANGE equipment_rent equipment_rent DOUBLE PRECISION DEFAULT NULL, CHANGE insurance_cost insurance_cost DOUBLE PRECISION DEFAULT NULL, CHANGE service_tax service_tax DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517443301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_906517443301C60 ON invoice (booking_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517443301C60');
        $this->addSql('DROP INDEX UNIQ_906517443301C60 ON invoice');
        $this->addSql('ALTER TABLE invoice ADD vat DOUBLE PRECISION NOT NULL, DROP tax, DROP status, CHANGE booking_id booking_id INT NOT NULL, CHANGE equipment_rent equipment_rent DOUBLE PRECISION NOT NULL, CHANGE insurance_cost insurance_cost DOUBLE PRECISION NOT NULL, CHANGE service_tax service_tax DOUBLE PRECISION NOT NULL');
    }
}
