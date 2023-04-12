<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230412184046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_image DROP FOREIGN KEY FK_EF9A1F8F27E8CC78');
        $this->addSql('ALTER TABLE accessory DROP FOREIGN KEY FK_A1B1251C12469DE2');
        $this->addSql('ALTER TABLE accessory DROP FOREIGN KEY FK_A1B1251C708A0E0');
        $this->addSql('DROP TABLE accessory');
        $this->addSql('DROP INDEX IDX_EF9A1F8F27E8CC78 ON item_image');
        $this->addSql('ALTER TABLE item_image DROP accessory_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accessory (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, gender_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, price DOUBLE PRECISION NOT NULL, INDEX IDX_A1B1251C12469DE2 (category_id), INDEX IDX_A1B1251C708A0E0 (gender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE accessory ADD CONSTRAINT FK_A1B1251C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE accessory ADD CONSTRAINT FK_A1B1251C708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE item_image ADD accessory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item_image ADD CONSTRAINT FK_EF9A1F8F27E8CC78 FOREIGN KEY (accessory_id) REFERENCES accessory (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EF9A1F8F27E8CC78 ON item_image (accessory_id)');
    }
}
