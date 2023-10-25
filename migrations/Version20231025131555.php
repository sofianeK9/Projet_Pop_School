<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231025131555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE donnees_administratives (id INT AUTO_INCREMENT NOT NULL, lieu_naissance VARCHAR(190) NOT NULL, email VARCHAR(190) NOT NULL, pays_naissance VARCHAR(190) NOT NULL, adresse VARCHAR(190) NOT NULL, code_postal VARCHAR(190) NOT NULL, commune VARCHAR(190) NOT NULL, nationalite VARCHAR(190) NOT NULL, situation_professionnelle VARCHAR(190) NOT NULL, numero_pole_emploi VARCHAR(190) NOT NULL, derniere_classe_suivie VARCHAR(190) NOT NULL, dernier_diplome_obtenu VARCHAR(190) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE donnees_administratives');
    }
}
