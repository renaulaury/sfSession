<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250120130936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, libelle_category VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intern (id INT AUTO_INCREMENT NOT NULL, name_intern VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, date_birth DATETIME NOT NULL, sex VARCHAR(1) NOT NULL, city VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, libelle_module VARCHAR(100) NOT NULL, INDEX IDX_C24262812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program (id INT AUTO_INCREMENT NOT NULL, session_id INT DEFAULT NULL, module_id INT DEFAULT NULL, nb_day INT NOT NULL, INDEX IDX_92ED7784613FECDF (session_id), INDEX IDX_92ED7784AFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, training_id INT DEFAULT NULL, trainer_id INT DEFAULT NULL, libelle_session VARCHAR(100) NOT NULL, nb_place INT NOT NULL, date_begin DATETIME NOT NULL, date_end DATETIME NOT NULL, INDEX IDX_D044D5D4BEFD98D1 (training_id), INDEX IDX_D044D5D4FB08EDF6 (trainer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_intern (session_id INT NOT NULL, intern_id INT NOT NULL, INDEX IDX_CA12556F613FECDF (session_id), INDEX IDX_CA12556F525DD4B4 (intern_id), PRIMARY KEY(session_id, intern_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trainer (id INT AUTO_INCREMENT NOT NULL, name_trainer VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, libelle_training VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nickname VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4FB08EDF6 FOREIGN KEY (trainer_id) REFERENCES trainer (id)');
        $this->addSql('ALTER TABLE session_intern ADD CONSTRAINT FK_CA12556F613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_intern ADD CONSTRAINT FK_CA12556F525DD4B4 FOREIGN KEY (intern_id) REFERENCES intern (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262812469DE2');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784613FECDF');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784AFC2B591');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4BEFD98D1');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4FB08EDF6');
        $this->addSql('ALTER TABLE session_intern DROP FOREIGN KEY FK_CA12556F613FECDF');
        $this->addSql('ALTER TABLE session_intern DROP FOREIGN KEY FK_CA12556F525DD4B4');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE intern');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE session_intern');
        $this->addSql('DROP TABLE trainer');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
