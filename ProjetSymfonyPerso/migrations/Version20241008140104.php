<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241008140104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE antecedent_medical (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, numero_dossier VARCHAR(255) NOT NULL, observation VARCHAR(255) NOT NULL, INDEX IDX_CACA2B746B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, realisation_exo_patient_id INT DEFAULT NULL, question VARCHAR(255) DEFAULT NULL, reponse VARCHAR(255) DEFAULT NULL, theme_exo VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E418C74D8CF00A23 (realisation_exo_patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin (id INT NOT NULL, inami VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT NOT NULL, medecin_t_id INT DEFAULT NULL, INDEX IDX_1ADAD7EB97F942A5 (medecin_t_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_exercice (patient_id INT NOT NULL, exercice_id INT NOT NULL, INDEX IDX_D39D9FE86B899279 (patient_id), INDEX IDX_D39D9FE889D40298 (exercice_id), PRIMARY KEY(patient_id, exercice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisation_exo_patient (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, date DATETIME NOT NULL, feedback VARCHAR(255) DEFAULT NULL, resultat VARCHAR(255) DEFAULT NULL, INDEX IDX_E14F0B886B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE antecedent_medical ADD CONSTRAINT FK_CACA2B746B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D8CF00A23 FOREIGN KEY (realisation_exo_patient_id) REFERENCES realisation_exo_patient (id)');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C6BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB97F942A5 FOREIGN KEY (medecin_t_id) REFERENCES medecin (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_exercice ADD CONSTRAINT FK_D39D9FE86B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_exercice ADD CONSTRAINT FK_D39D9FE889D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE realisation_exo_patient ADD CONSTRAINT FK_E14F0B886B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE antecedent_medical DROP FOREIGN KEY FK_CACA2B746B899279');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D8CF00A23');
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C6BF396750');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB97F942A5');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBBF396750');
        $this->addSql('ALTER TABLE patient_exercice DROP FOREIGN KEY FK_D39D9FE86B899279');
        $this->addSql('ALTER TABLE patient_exercice DROP FOREIGN KEY FK_D39D9FE889D40298');
        $this->addSql('ALTER TABLE realisation_exo_patient DROP FOREIGN KEY FK_E14F0B886B899279');
        $this->addSql('DROP TABLE antecedent_medical');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE patient_exercice');
        $this->addSql('DROP TABLE realisation_exo_patient');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
