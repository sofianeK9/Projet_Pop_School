<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231025132828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprenant ADD donnees_administratives_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apprenant ADD CONSTRAINT FK_C4EB462ED12A4DA0 FOREIGN KEY (donnees_administratives_id) REFERENCES donnees_administratives (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4EB462ED12A4DA0 ON apprenant (donnees_administratives_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprenant DROP FOREIGN KEY FK_C4EB462ED12A4DA0');
        $this->addSql('DROP INDEX UNIQ_C4EB462ED12A4DA0 ON apprenant');
        $this->addSql('ALTER TABLE apprenant DROP donnees_administratives_id');
    }
}
