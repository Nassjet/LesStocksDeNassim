<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250407115639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, produit_id INT NOT NULL, type VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, alt LONGTEXT DEFAULT NULL, INDEX IDX_6A2CA10CBCF5E72D (categorie_id), INDEX IDX_6A2CA10CF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CBCF5E72D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CF347EFB
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE media
        SQL);
    }
}
