<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123091155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE house_equipements (house_id INT NOT NULL, equipements_id INT NOT NULL, INDEX IDX_41D2349E6BB74515 (house_id), INDEX IDX_41D2349E852CCFF5 (equipements_id), PRIMARY KEY(house_id, equipements_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE house_equipements ADD CONSTRAINT FK_41D2349E6BB74515 FOREIGN KEY (house_id) REFERENCES house (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE house_equipements ADD CONSTRAINT FK_41D2349E852CCFF5 FOREIGN KEY (equipements_id) REFERENCES equipements (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE house_equipements DROP FOREIGN KEY FK_41D2349E6BB74515');
        $this->addSql('ALTER TABLE house_equipements DROP FOREIGN KEY FK_41D2349E852CCFF5');
        $this->addSql('DROP TABLE house_equipements');
    }
}
