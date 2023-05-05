<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220311105225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(96) NOT NULL, start_date DATETIME NOT NULL, duration_minute INT NOT NULL, language VARCHAR(32) NOT NULL, required_user INT NOT NULL, customer VARCHAR(96) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, event_id INT NOT NULL, status VARCHAR(32) NOT NULL, INDEX IDX_62A8A7A7A76ED395 (user_id), INDEX IDX_62A8A7A771F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A771F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A771F7E88B');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE registration');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE firstname firstname VARCHAR(96) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE lastname lastname VARCHAR(96) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE phonenumber phonenumber VARCHAR(12) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE address address VARCHAR(512) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE activity_type activity_type VARCHAR(32) NOT NULL COLLATE `utf8_unicode_ci`');
    }
}
