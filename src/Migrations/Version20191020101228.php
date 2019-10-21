<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020101228 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE school_class CHANGE number number SMALLINT DEFAULT NULL, CHANGE letter letter VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD class_id INT DEFAULT NULL, CHANGE second_name second_name VARCHAR(255) DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE patronymic patronymic VARCHAR(255) DEFAULT NULL, CHANGE sex sex VARCHAR(255) DEFAULT NULL, CHANGE birthday birthday DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33EA000B10 FOREIGN KEY (class_id) REFERENCES school_class (id)');
        $this->addSql('CREATE INDEX IDX_B723AF33EA000B10 ON student (class_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE school_class CHANGE number number SMALLINT DEFAULT NULL, CHANGE letter letter VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33EA000B10');
        $this->addSql('DROP INDEX IDX_B723AF33EA000B10 ON student');
        $this->addSql('ALTER TABLE student DROP class_id, CHANGE second_name second_name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE name name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE patronymic patronymic VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE sex sex VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE birthday birthday DATETIME DEFAULT \'NULL\'');
    }
}
