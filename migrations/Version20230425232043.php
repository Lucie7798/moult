<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425232043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        // Create product_size and product_color tables for ManyToMany relationships
        $this->addSql('CREATE TABLE product_size (product_id INT NOT NULL, size_id INT NOT NULL, INDEX IDX_942C5A504584665A (product_id), INDEX IDX_942C5A50498DA827 (size_id), PRIMARY KEY(product_id, size_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_color (product_id INT NOT NULL, color_id INT NOT NULL, INDEX IDX_B5D8388B4584665A (product_id), INDEX IDX_B5D8388B7ADA1FB5 (color_id), PRIMARY KEY(product_id, color_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('ALTER TABLE product_size ADD CONSTRAINT FK_942C5A504584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_size ADD CONSTRAINT FK_942C5A50498DA827 FOREIGN KEY (size_id) REFERENCES size (id) ON DELETE CASCADE');
        
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_B5D8388B4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_B5D8388B7ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE size');
        
        $this->addSql('DROP TABLE product_size');
        $this->addSql('DROP TABLE product_color');
    }
}
