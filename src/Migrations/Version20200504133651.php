<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504133651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artiste ADD followers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artiste ADD CONSTRAINT FK_9C07354F15BF9993 FOREIGN KEY (followers_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9C07354F15BF9993 ON artiste (followers_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artiste DROP FOREIGN KEY FK_9C07354F15BF9993');
        $this->addSql('DROP INDEX IDX_9C07354F15BF9993 ON artiste');
        $this->addSql('ALTER TABLE artiste DROP followers_id');
    }
}
