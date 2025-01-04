<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250101223328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE interests (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_interests (profile_id INT NOT NULL, interests_id INT NOT NULL, INDEX IDX_742BEC91CCFA12B8 (profile_id), INDEX IDX_742BEC91734F135E (interests_id), PRIMARY KEY(profile_id, interests_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profile_interests ADD CONSTRAINT FK_742BEC91CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile_interests ADD CONSTRAINT FK_742BEC91734F135E FOREIGN KEY (interests_id) REFERENCES interests (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_interests DROP FOREIGN KEY FK_742BEC91CCFA12B8');
        $this->addSql('ALTER TABLE profile_interests DROP FOREIGN KEY FK_742BEC91734F135E');
        $this->addSql('DROP TABLE interests');
        $this->addSql('DROP TABLE profile_interests');
    }
}
