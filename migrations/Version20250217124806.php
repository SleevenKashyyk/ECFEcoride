<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250217124806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0FB88E14F');
        $this->addSql('ALTER TABLE configuration DROP FOREIGN KEY FK_A5E2A5D7FB88E14F');
        $this->addSql('ALTER TABLE covoiturage DROP FOREIGN KEY FK_28C79E89FB88E14F');
        $this->addSql('ALTER TABLE parametre DROP FOREIGN KEY FK_ACC7904173F32DD8');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AFB88E14F');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F4827B9B2');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FFB88E14F');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F62671590');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE configuration');
        $this->addSql('DROP TABLE covoiturage');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE parametre');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voiture');
    }
}
