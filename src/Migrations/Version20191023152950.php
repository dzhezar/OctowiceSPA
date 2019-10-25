<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191023152950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project_block_translation (id INT AUTO_INCREMENT NOT NULL, project_block_id INT NOT NULL, locale_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_5AB74C8BD4A309D7 (project_block_id), INDEX IDX_5AB74C8BE559DFD1 (locale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_block (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, color VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_904E9EBC166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_block_translation ADD CONSTRAINT FK_5AB74C8BD4A309D7 FOREIGN KEY (project_block_id) REFERENCES project_block (id)');
        $this->addSql('ALTER TABLE project_block_translation ADD CONSTRAINT FK_5AB74C8BE559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
        $this->addSql('ALTER TABLE project_block ADD CONSTRAINT FK_904E9EBC166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project_block_translation DROP FOREIGN KEY FK_5AB74C8BD4A309D7');
        $this->addSql('DROP TABLE project_block_translation');
        $this->addSql('DROP TABLE project_block');
    }
}
