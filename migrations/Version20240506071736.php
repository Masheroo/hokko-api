<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506071736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lesson_block (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, course_id INT NOT NULL, INDEX IDX_C9FD43A5591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE lesson_block ADD CONSTRAINT FK_C9FD43A5591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3591CC992');
        $this->addSql('DROP INDEX IDX_F87474F3591CC992 ON lesson');
        $this->addSql('ALTER TABLE lesson CHANGE course_id block_id INT NOT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3E9ED820C FOREIGN KEY (block_id) REFERENCES lesson_block (id)');
        $this->addSql('CREATE INDEX IDX_F87474F3E9ED820C ON lesson (block_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson_block DROP FOREIGN KEY FK_C9FD43A5591CC992');
        $this->addSql('DROP TABLE lesson_block');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3E9ED820C');
        $this->addSql('DROP INDEX IDX_F87474F3E9ED820C ON lesson');
        $this->addSql('ALTER TABLE lesson CHANGE block_id course_id INT NOT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F87474F3591CC992 ON lesson (course_id)');
    }
}
