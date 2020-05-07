<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505111747 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_artiste (user_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_C40A2B45A76ED395 (user_id), INDEX IDX_C40A2B4521D25844 (artiste_id), PRIMARY KEY(user_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_artiste ADD CONSTRAINT FK_C40A2B45A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_artiste ADD CONSTRAINT FK_C40A2B4521D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste DROP FOREIGN KEY FK_9C07354F15BF9993');
        $this->addSql('DROP INDEX IDX_9C07354F15BF9993 ON artiste');
        $this->addSql('ALTER TABLE artiste DROP followers_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_artiste');
        $this->addSql('ALTER TABLE artiste ADD followers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artiste ADD CONSTRAINT FK_9C07354F15BF9993 FOREIGN KEY (followers_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9C07354F15BF9993 ON artiste (followers_id)');
    }
}