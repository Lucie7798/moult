<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230419135608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sleeve_option (id INT AUTO_INCREMENT NOT NULL, jacket_id INT NOT NULL, sleeve_id INT NOT NULL, INDEX IDX_1634AEC2C7E7C584 (jacket_id), INDEX IDX_1634AEC2CABEAD9D (sleeve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sleeve_option ADD CONSTRAINT FK_1634AEC2C7E7C584 FOREIGN KEY (jacket_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE sleeve_option ADD CONSTRAINT FK_1634AEC2CABEAD9D FOREIGN KEY (sleeve_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sleeve_option DROP FOREIGN KEY FK_1634AEC2C7E7C584');
        $this->addSql('ALTER TABLE sleeve_option DROP FOREIGN KEY FK_1634AEC2CABEAD9D');
        $this->addSql('DROP TABLE sleeve_option');
    }
}
