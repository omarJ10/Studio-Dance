<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121110022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach ADD offre_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC286E79CC FOREIGN KEY (offre_id_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_3F596DCC286E79CC ON coach (offre_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC286E79CC');
        $this->addSql('DROP INDEX IDX_3F596DCC286E79CC ON coach');
        $this->addSql('ALTER TABLE coach DROP offre_id_id');
    }
}
