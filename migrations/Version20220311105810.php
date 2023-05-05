<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220311105810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(96) NOT NULL, description VARCHAR(256) DEFAULT NULL, activity_type VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD activity_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA781C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA781C06096 ON event (activity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA781C06096');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP INDEX IDX_3BAE0AA781C06096 ON event');
        $this->addSql('ALTER TABLE event DROP activity_id, CHANGE name name VARCHAR(96) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE language language VARCHAR(32) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE customer customer VARCHAR(96) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE registration CHANGE status status VARCHAR(32) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE firstname firstname VARCHAR(96) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE lastname lastname VARCHAR(96) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE phonenumber phonenumber VARCHAR(12) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE address address VARCHAR(512) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE activity_type activity_type VARCHAR(32) NOT NULL COLLATE `utf8_unicode_ci`');
    }
}
