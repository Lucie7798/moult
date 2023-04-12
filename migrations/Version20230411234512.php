<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230411234512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_image (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, accessory_id INT NOT NULL, path VARCHAR(255) NOT NULL, position INT NOT NULL, INDEX IDX_EF9A1F8F4584665A (product_id), INDEX IDX_EF9A1F8F27E8CC78 (accessory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_image ADD CONSTRAINT FK_EF9A1F8F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE item_image ADD CONSTRAINT FK_EF9A1F8F27E8CC78 FOREIGN KEY (accessory_id) REFERENCES accessory (id)');
        $this->addSql('ALTER TABLE product_image DROP FOREIGN KEY FK_64617F0327E8CC78');
        $this->addSql('ALTER TABLE product_image DROP FOREIGN KEY FK_64617F034584665A');
        $this->addSql('DROP TABLE product_image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_image (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, accessory_id INT NOT NULL, path VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, position INT NOT NULL, INDEX IDX_64617F034584665A (product_id), INDEX IDX_64617F0327E8CC78 (accessory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F0327E8CC78 FOREIGN KEY (accessory_id) REFERENCES accessory (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F034584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE item_image DROP FOREIGN KEY FK_EF9A1F8F4584665A');
        $this->addSql('ALTER TABLE item_image DROP FOREIGN KEY FK_EF9A1F8F27E8CC78');
        $this->addSql('DROP TABLE item_image');
    }
}
