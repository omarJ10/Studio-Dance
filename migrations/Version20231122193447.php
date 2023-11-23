<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122193447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC960C841E');
        $this->addSql('DROP INDEX IDX_3F596DCC960C841E ON coach');
        $this->addSql('ALTER TABLE coach CHANGE domaine_id_id domaine_id INT NOT NULL');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id)');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_3F596DCC4272FC9F ON coach (domaine_id)');
        $this->addSql('CREATE INDEX IDX_3F596DCC4CC8505A ON coach (offre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC4272FC9F');
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC4CC8505A');
        $this->addSql('DROP INDEX IDX_3F596DCC4272FC9F ON coach');
        $this->addSql('DROP INDEX IDX_3F596DCC4CC8505A ON coach');
        $this->addSql('ALTER TABLE coach CHANGE domaine_id domaine_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC960C841E FOREIGN KEY (domaine_id_id) REFERENCES domaine (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3F596DCC960C841E ON coach (domaine_id_id)');
    }
}
