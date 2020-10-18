<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201017183805 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires ADD article_id INT DEFAULT NULL, ADD auteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C47294869C FOREIGN KEY (article_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C460BB6FE6 FOREIGN KEY (auteur_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C47294869C ON commentaires (article_id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C460BB6FE6 ON commentaires (auteur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C47294869C');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C460BB6FE6');
        $this->addSql('DROP INDEX IDX_D9BEC0C47294869C ON commentaires');
        $this->addSql('DROP INDEX IDX_D9BEC0C460BB6FE6 ON commentaires');
        $this->addSql('ALTER TABLE commentaires DROP article_id, DROP auteur_id');
    }
}
