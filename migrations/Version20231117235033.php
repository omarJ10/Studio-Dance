<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117235033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contacttt (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, avis VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_personnel (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date DATE NOT NULL, UNIQUE INDEX UNIQ_F5CFB89619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historique_personnel ADD CONSTRAINT FK_F5CFB89619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE `admin` CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE coach ADD image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique_personnel DROP FOREIGN KEY FK_F5CFB89619EB6921');
        $this->addSql('DROP TABLE contacttt');
        $this->addSql('DROP TABLE historique_personnel');
        $this->addSql('ALTER TABLE `admin` CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE coach DROP image');
    }
}
