<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231025135448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrateur ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE apprenant ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE donnees_administratives ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE donnees_pedagogiques ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE formateur ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE promotion ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE responsable_territorial ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD deleted_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprenant DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE donnees_pedagogiques DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE promotion DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE responsable_territorial DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE donnees_administratives DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE formateur DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE administrateur DROP created_at, DROP updated_at, DROP deleted_at');
    }
}
