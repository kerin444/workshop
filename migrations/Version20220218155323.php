<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220218155323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, contact VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE device (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, created_by_id INT NOT NULL, description VARCHAR(255) DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, serial_number VARCHAR(255) DEFAULT NULL, date_buy DATE DEFAULT NULL, problem LONGTEXT DEFAULT NULL, diagnosis LONGTEXT DEFAULT NULL, solution LONGTEXT DEFAULT NULL, quote_number INT DEFAULT NULL, quote_date DATE DEFAULT NULL, quote_amount INT DEFAULT NULL, repair_delay INT DEFAULT NULL, repair_date DATE DEFAULT NULL, return_date DATE DEFAULT NULL, client_feedback VARCHAR(255) DEFAULT NULL, client_feedback_date DATE DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_92FB68E19EB6921 (client_id), INDEX IDX_92FB68EB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68EB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68E19EB6921');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68EB03A8386');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE device');
        $this->addSql('DROP TABLE user');
    }
}
