<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509150730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sleeve_option DROP FOREIGN KEY FK_1634AEC2C7E7C584');
        $this->addSql('DROP INDEX IDX_1634AEC2C7E7C584 ON sleeve_option');
        $this->addSql('ALTER TABLE sleeve_option CHANGE jacket_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE sleeve_option ADD CONSTRAINT FK_1634AEC24584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_1634AEC24584665A ON sleeve_option (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sleeve_option DROP FOREIGN KEY FK_1634AEC24584665A');
        $this->addSql('DROP INDEX IDX_1634AEC24584665A ON sleeve_option');
        $this->addSql('ALTER TABLE sleeve_option CHANGE product_id jacket_id INT NOT NULL');
        $this->addSql('ALTER TABLE sleeve_option ADD CONSTRAINT FK_1634AEC2C7E7C584 FOREIGN KEY (jacket_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1634AEC2C7E7C584 ON sleeve_option (jacket_id)');
    }
}
