<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250218171728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE avis ADD commentair VARCHAR(255) NOT NULL, CHANGE note note VARCHAR(64) NOT NULL, CHANGE statut statut VARCHAR(64) NOT NULL');
        $this->addSql('DROP INDEX fk_8f91abf0a76ed395 ON avis');
        $this->addSql('CREATE INDEX IDX_8F91ABF0A76ED395 ON avis (user_id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE configuration DROP FOREIGN KEY FK_A5E2A5D7A76ED395');
        $this->addSql('DROP INDEX fk_a5e2a5d7a76ed395 ON configuration');
        $this->addSql('CREATE INDEX IDX_A5E2A5D7A76ED395 ON configuration (user_id)');
        $this->addSql('ALTER TABLE configuration ADD CONSTRAINT FK_A5E2A5D7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE covoiturage DROP FOREIGN KEY FK_28C79E89A76ED395');
        $this->addSql('DROP INDEX fk_28c79e89a76ed395 ON covoiturage');
        $this->addSql('CREATE INDEX IDX_28C79E89A76ED395 ON covoiturage (user_id)');
        $this->addSql('ALTER TABLE covoiturage ADD CONSTRAINT FK_28C79E89A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE nom nom VARCHAR(64) NOT NULL, CHANGE prenom prenom VARCHAR(64) NOT NULL, CHANGE telephone telephone VARCHAR(64) NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE date_naissance date_naissance VARCHAR(64) NOT NULL, CHANGE photo photo LONGBLOB NOT NULL, CHANGE pseudo pseudo VARCHAR(64) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE avis DROP commentair, CHANGE note note TINYINT(1) NOT NULL, CHANGE statut statut VARCHAR(64) DEFAULT NULL');
        $this->addSql('DROP INDEX idx_8f91abf0a76ed395 ON avis');
        $this->addSql('CREATE INDEX FK_8F91ABF0A76ED395 ON avis (user_id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE configuration DROP FOREIGN KEY FK_A5E2A5D7A76ED395');
        $this->addSql('DROP INDEX idx_a5e2a5d7a76ed395 ON configuration');
        $this->addSql('CREATE INDEX FK_A5E2A5D7A76ED395 ON configuration (user_id)');
        $this->addSql('ALTER TABLE configuration ADD CONSTRAINT FK_A5E2A5D7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE covoiturage DROP FOREIGN KEY FK_28C79E89A76ED395');
        $this->addSql('DROP INDEX idx_28c79e89a76ed395 ON covoiturage');
        $this->addSql('CREATE INDEX FK_28C79E89A76ED395 ON covoiturage (user_id)');
        $this->addSql('ALTER TABLE covoiturage ADD CONSTRAINT FK_28C79E89A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE nom nom VARCHAR(64) DEFAULT NULL, CHANGE prenom prenom VARCHAR(64) DEFAULT NULL, CHANGE telephone telephone VARCHAR(64) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE date_naissance date_naissance VARCHAR(64) DEFAULT NULL, CHANGE photo photo LONGBLOB DEFAULT NULL, CHANGE pseudo pseudo VARCHAR(64) DEFAULT NULL');
    }
}
