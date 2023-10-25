<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231025132610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responsable_territorial ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE responsable_territorial ADD CONSTRAINT FK_94B42B4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_94B42B4A76ED395 ON responsable_territorial (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responsable_territorial DROP FOREIGN KEY FK_94B42B4A76ED395');
        $this->addSql('DROP INDEX UNIQ_94B42B4A76ED395 ON responsable_territorial');
        $this->addSql('ALTER TABLE responsable_territorial DROP user_id');
    }
}
