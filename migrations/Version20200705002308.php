<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705002308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5FAB00C2CE9E9CA ON batiment (num_batiment)');
        $this->addSql('ALTER TABLE chambre DROP type_chambre, DROP statu_chambre, CHANGE num_batiment_id num_batiment_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C509E4FFAFE16 ON chambre (num_chambre)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C1765B63F16F07C ON departement (nom_departement)');
        $this->addSql('ALTER TABLE etudiant ADD id INT AUTO_INCREMENT NOT NULL, DROP date_naissance, CHANGE nom_departement_id nom_departement_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E312B2DC9C ON etudiant (matricule)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F5FAB00C2CE9E9CA ON batiment');
        $this->addSql('DROP INDEX UNIQ_C509E4FFAFE16 ON chambre');
        $this->addSql('ALTER TABLE chambre ADD type_chambre VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD statu_chambre INT NOT NULL, CHANGE num_batiment_id num_batiment_id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_C1765B63F16F07C ON departement');
        $this->addSql('ALTER TABLE etudiant MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_717E22E312B2DC9C ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE etudiant ADD date_naissance DATE NOT NULL, DROP id, CHANGE nom_departement_id nom_departement_id INT NOT NULL');
        $this->addSql('ALTER TABLE etudiant ADD PRIMARY KEY (matricule)');
    }
}
