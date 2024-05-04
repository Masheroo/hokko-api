<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503132048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE course RENAME COLUMN preview TO preview_filename');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE course RENAME COLUMN preview_filename TO preview');
    }
}
