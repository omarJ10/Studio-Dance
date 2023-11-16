<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115224126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, coments VARCHAR(255) NOT NULL, rating INT NOT NULL, date_heure VARCHAR(255) NOT NULL, INDEX IDX_8F91ABF019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domaine (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('DROP TABLE contacttt');
        $this->addSql('ALTER TABLE client ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD telephone INT NOT NULL');
        $this->addSql('ALTER TABLE coach ADD offre_id INT DEFAULT NULL, ADD domaine_id INT DEFAULT NULL, ADD img VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id)');
        $this->addSql('CREATE INDEX IDX_3F596DCC4CC8505A ON coach (offre_id)');
        $this->addSql('CREATE INDEX IDX_3F596DCC4272FC9F ON coach (domaine_id)');
        $this->addSql('ALTER TABLE cours ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offre ADD date_fin VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC4272FC9F');
        $this->addSql('CREATE TABLE contacttt (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, avis VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF019EB6921');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('ALTER TABLE client DROP nom, DROP prenom, DROP telephone');
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC4CC8505A');
        $this->addSql('DROP INDEX IDX_3F596DCC4CC8505A ON coach');
        $this->addSql('DROP INDEX IDX_3F596DCC4272FC9F ON coach');
        $this->addSql('ALTER TABLE coach DROP offre_id, DROP domaine_id, DROP img');
        $this->addSql('ALTER TABLE offre DROP date_fin');
        $this->addSql('ALTER TABLE cours DROP description');
    }
}
