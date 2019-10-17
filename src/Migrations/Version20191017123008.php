<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191017123008 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project_translation (id INT AUTO_INCREMENT NOT NULL, locale_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_7CA6B294E559DFD1 (locale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_translation (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, locale_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_3F2070412469DE2 (category_id), INDEX IDX_3F20704E559DFD1 (locale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locale (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, seo_title VARCHAR(255) DEFAULT NULL, seo_description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_translation (id INT AUTO_INCREMENT NOT NULL, blog_id INT NOT NULL, locale_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_6D59D991DAE07E97 (blog_id), INDEX IDX_6D59D991E559DFD1 (locale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_translation (id INT AUTO_INCREMENT NOT NULL, locale_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_78F363C3E559DFD1 (locale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, icon VARCHAR(255) NOT NULL, price INT DEFAULT NULL, seo_title VARCHAR(255) DEFAULT NULL, seo_description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, seo_title VARCHAR(255) DEFAULT NULL, seo_description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_translation ADD CONSTRAINT FK_7CA6B294E559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
        $this->addSql('ALTER TABLE category_translation ADD CONSTRAINT FK_3F2070412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category_translation ADD CONSTRAINT FK_3F20704E559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
        $this->addSql('ALTER TABLE blog_translation ADD CONSTRAINT FK_6D59D991DAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE blog_translation ADD CONSTRAINT FK_6D59D991E559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
        $this->addSql('ALTER TABLE service_translation ADD CONSTRAINT FK_78F363C3E559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
        $this->addSql('INSERT INTO locale (name, short_name) VALUES ("Русский", "ru")');
        $this->addSql('INSERT INTO locale (name, short_name) VALUES ("English", "en")');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project_translation DROP FOREIGN KEY FK_7CA6B294E559DFD1');
        $this->addSql('ALTER TABLE category_translation DROP FOREIGN KEY FK_3F20704E559DFD1');
        $this->addSql('ALTER TABLE blog_translation DROP FOREIGN KEY FK_6D59D991E559DFD1');
        $this->addSql('ALTER TABLE service_translation DROP FOREIGN KEY FK_78F363C3E559DFD1');
        $this->addSql('ALTER TABLE category_translation DROP FOREIGN KEY FK_3F2070412469DE2');
        $this->addSql('ALTER TABLE blog_translation DROP FOREIGN KEY FK_6D59D991DAE07E97');
        $this->addSql('DROP TABLE project_translation');
        $this->addSql('DROP TABLE category_translation');
        $this->addSql('DROP TABLE locale');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE blog_translation');
        $this->addSql('DROP TABLE service_translation');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE blog');
    }
}
