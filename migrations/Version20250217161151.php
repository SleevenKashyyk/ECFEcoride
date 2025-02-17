<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250217161151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0FB88E14F');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE configuration DROP FOREIGN KEY FK_A5E2A5D7FB88E14F');
        $this->addSql('ALTER TABLE configuration ADD CONSTRAINT FK_A5E2A5D7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE covoiturage DROP FOREIGN KEY FK_28C79E89FB88E14F');
        $this->addSql('ALTER TABLE covoiturage ADD CONSTRAINT FK_28C79E89A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(64) NOT NULL, ADD prenom VARCHAR(64) NOT NULL, ADD telephone VARCHAR(64) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD date_naissance VARCHAR(64) NOT NULL, ADD photo LONGBLOB NOT NULL, ADD pseudo VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FFB88E14F');
        $this->addSql('DROP INDEX IDX_E9E2810FFB88E14F ON voiture');
        $this->addSql('ALTER TABLE voiture CHANGE utilisateur_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FA76ED395 ON voiture (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0FB88E14F FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE configuration DROP FOREIGN KEY FK_A5E2A5D7A76ED395');
        $this->addSql('ALTER TABLE configuration ADD CONSTRAINT FK_A5E2A5D7FB88E14F FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE covoiturage DROP FOREIGN KEY FK_28C79E89A76ED395');
        $this->addSql('ALTER TABLE covoiturage ADD CONSTRAINT FK_28C79E89FB88E14F FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE user DROP nom, DROP prenom, DROP telephone, DROP adresse, DROP date_naissance, DROP photo, DROP pseudo');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FA76ED395');
        $this->addSql('DROP INDEX IDX_E9E2810FA76ED395 ON voiture');
        $this->addSql('ALTER TABLE voiture CHANGE user_id utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FFB88E14F ON voiture (utilisateur_id)');
    }
}
