<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426000208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_size RENAME INDEX idx_942c5a504584665a TO IDX_7A2806CB4584665A');
        $this->addSql('ALTER TABLE product_size RENAME INDEX idx_942c5a50498da827 TO IDX_7A2806CB498DA827');
        $this->addSql('ALTER TABLE product_color RENAME INDEX idx_b5d8388b4584665a TO IDX_C70A33B54584665A');
        $this->addSql('ALTER TABLE product_color RENAME INDEX idx_b5d8388b7ada1fb5 TO IDX_C70A33B57ADA1FB5');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_size RENAME INDEX idx_7a2806cb4584665a TO IDX_942C5A504584665A');
        $this->addSql('ALTER TABLE product_size RENAME INDEX idx_7a2806cb498da827 TO IDX_942C5A50498DA827');
        $this->addSql('ALTER TABLE product_color RENAME INDEX idx_c70a33b54584665a TO IDX_B5D8388B4584665A');
        $this->addSql('ALTER TABLE product_color RENAME INDEX idx_c70a33b57ada1fb5 TO IDX_B5D8388B7ADA1FB5');
    }
}
