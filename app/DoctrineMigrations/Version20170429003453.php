<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170429003453 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer_account DROP FOREIGN KEY FK_61EBF21AA76ED395');
        $this->addSql('DROP INDEX UNIQ_61EBF21AA76ED395 ON customer_account');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer_account ADD CONSTRAINT FK_61EBF21AA76ED395 FOREIGN KEY (user_id) REFERENCES category (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_61EBF21AA76ED395 ON customer_account (user_id)');
    }
}
