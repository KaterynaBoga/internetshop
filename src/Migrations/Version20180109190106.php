<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180109190106 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE feedbacks (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(250) DEFAULT \'\' NOT NULL, email VARCHAR(250) DEFAULT \'\' NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product CHANGE image_name image_name VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE image_size image_size INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE feedbacks');
        $this->addSql('ALTER TABLE product CHANGE image_name image_name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE image_size image_size INT NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
    }
}
