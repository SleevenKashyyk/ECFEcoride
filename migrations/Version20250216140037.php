<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250216140037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD user_id INT DEFAULT NULL, CHANGE note note VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0FB88E14F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0FB88E14F ON avis (user_id)');
        $this->addSql('ALTER TABLE configuration ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE configuration ADD CONSTRAINT FK_A5E2A5D7FB88E14F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A5E2A5D7FB88E14F ON configuration (user_id)');
        $this->addSql('ALTER TABLE covoiturage ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE covoiturage ADD CONSTRAINT FK_28C79E89FB88E14F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_28C79E89FB88E14F ON covoiturage (user_id)');
        $this->addSql('ALTER TABLE parametre ADD configuration_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parametre ADD CONSTRAINT FK_ACC7904173F32DD8 FOREIGN KEY (configuration_id) REFERENCES configuration (id)');
        $this->addSql('CREATE INDEX IDX_ACC7904173F32DD8 ON parametre (configuration_id)');
        $this->addSql('ALTER TABLE role ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AFB88E14F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_57698A6AFB88E14F ON role (user_id)');
        $this->addSql('ALTER TABLE user CHANGE date_naissance date_naissance VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD marque_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, ADD covoiturage_id INT DEFAULT NULL, CHANGE date_premiere_immatriculation date_premiere_immatriculation VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FFB88E14F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F62671590 FOREIGN KEY (covoiturage_id) REFERENCES covoiturage (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F4827B9B2 ON voiture (marque_id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FFB88E14F ON voiture (user_id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F62671590 ON voiture (covoiturage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0FB88E14F');
        $this->addSql('DROP INDEX IDX_8F91ABF0FB88E14F ON avis');
        $this->addSql('ALTER TABLE avis DROP user_id, CHANGE note note TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE parametre DROP FOREIGN KEY FK_ACC7904173F32DD8');
        $this->addSql('DROP INDEX IDX_ACC7904173F32DD8 ON parametre');
        $this->addSql('ALTER TABLE parametre DROP configuration_id');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AFB88E14F');
        $this->addSql('DROP INDEX IDX_57698A6AFB88E14F ON role');
        $this->addSql('ALTER TABLE role DROP user_id');
        $this->addSql('ALTER TABLE user CHANGE date_naissance date_naissance DATE NOT NULL');
        $this->addSql('ALTER TABLE configuration DROP FOREIGN KEY FK_A5E2A5D7FB88E14F');
        $this->addSql('DROP INDEX IDX_A5E2A5D7FB88E14F ON configuration');
        $this->addSql('ALTER TABLE configuration DROP user_id');
        $this->addSql('ALTER TABLE covoiturage DROP FOREIGN KEY FK_28C79E89FB88E14F');
        $this->addSql('DROP INDEX IDX_28C79E89FB88E14F ON covoiturage');
        $this->addSql('ALTER TABLE covoiturage DROP user_id');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F4827B9B2');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FFB88E14F');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F62671590');
        $this->addSql('DROP INDEX IDX_E9E2810F4827B9B2 ON voiture');
        $this->addSql('DROP INDEX IDX_E9E2810FFB88E14F ON voiture');
        $this->addSql('DROP INDEX IDX_E9E2810F62671590 ON voiture');
        $this->addSql('ALTER TABLE voiture DROP marque_id, DROP user_id, DROP covoiturage_id, CHANGE date_premiere_immatriculation date_premiere_immatriculation DATE NOT NULL');
    }
}
