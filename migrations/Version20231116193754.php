<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116193754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach ADD domaine_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC960C841E FOREIGN KEY (domaine_id_id) REFERENCES domaine (id)');
        $this->addSql('CREATE INDEX IDX_3F596DCC960C841E ON coach (domaine_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC960C841E');
        $this->addSql('DROP INDEX IDX_3F596DCC960C841E ON coach');
        $this->addSql('ALTER TABLE coach DROP domaine_id_id');
    }
}
