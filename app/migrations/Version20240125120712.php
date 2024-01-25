<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125120712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_annonce (category_id INT NOT NULL, annonce_id INT NOT NULL, INDEX IDX_318DD39B12469DE2 (category_id), INDEX IDX_318DD39B8805AB2F (annonce_id), PRIMARY KEY(category_id, annonce_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_annonce ADD CONSTRAINT FK_318DD39B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_annonce ADD CONSTRAINT FK_318DD39B8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_annonce DROP FOREIGN KEY FK_318DD39B12469DE2');
        $this->addSql('ALTER TABLE category_annonce DROP FOREIGN KEY FK_318DD39B8805AB2F');
        $this->addSql('DROP TABLE category_annonce');
    }
}
