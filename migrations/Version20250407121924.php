<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250407121924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE command_line (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, commandes_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_70BE1A7BF347EFB (produit_id), INDEX IDX_70BE1A7B8BF5C2E6 (commandes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, order_number INT NOT NULL, valid TINYINT(1) NOT NULL, date DATETIME NOT NULL, INDEX IDX_35D4282CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE customer_address (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, INDEX IDX_1193CB3FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7B8BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE customer_address ADD CONSTRAINT FK_1193CB3FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7BF347EFB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7B8BF5C2E6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE customer_address DROP FOREIGN KEY FK_1193CB3FA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE command_line
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE commandes
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE customer_address
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
    }
}
