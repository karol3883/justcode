<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230106132012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notification_counter ADD notification_id INT NOT NULL');
        $this->addSql('ALTER TABLE notification_counter ADD CONSTRAINT FK_D43C1ECFEF1A9D84 FOREIGN KEY (notification_id) REFERENCES notification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D43C1ECFEF1A9D84 ON notification_counter (notification_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE notification_counter DROP CONSTRAINT FK_D43C1ECFEF1A9D84');
        $this->addSql('DROP INDEX IDX_D43C1ECFEF1A9D84');
        $this->addSql('ALTER TABLE notification_counter DROP notification_id');
    }
}
