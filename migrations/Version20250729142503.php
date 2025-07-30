<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250729142503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C53D045F7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interests (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, user_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', cover_id INT DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, birthdate DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', status VARCHAR(255) NOT NULL, bio LONGTEXT DEFAULT NULL, following LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8157AA0FA76ED395 (user_id), UNIQUE INDEX UNIQ_8157AA0F922726E9 (cover_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_interests (profile_id INT NOT NULL, interests_id INT NOT NULL, INDEX IDX_742BEC91CCFA12B8 (profile_id), INDEX IDX_742BEC91734F135E (interests_id), PRIMARY KEY(profile_id, interests_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, verified TINYINT(1) DEFAULT NULL, status INT NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F922726E9 FOREIGN KEY (cover_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE profile_interests ADD CONSTRAINT FK_742BEC91CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile_interests ADD CONSTRAINT FK_742BEC91734F135E FOREIGN KEY (interests_id) REFERENCES interests (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F7E3C61F9');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FA76ED395');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F922726E9');
        $this->addSql('ALTER TABLE profile_interests DROP FOREIGN KEY FK_742BEC91CCFA12B8');
        $this->addSql('ALTER TABLE profile_interests DROP FOREIGN KEY FK_742BEC91734F135E');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE interests');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE profile_interests');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE user');
    }
}
