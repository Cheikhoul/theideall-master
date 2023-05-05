<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220316093929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD team_name VARCHAR(64) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity CHANGE name name VARCHAR(96) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE description description VARCHAR(256) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE activity_type activity_type VARCHAR(32) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE event CHANGE name name VARCHAR(96) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE language language VARCHAR(32) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE customer customer VARCHAR(96) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE registration CHANGE status status VARCHAR(32) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE user DROP team_name, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE firstname firstname VARCHAR(96) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE lastname lastname VARCHAR(96) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE phonenumber phonenumber VARCHAR(12) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE address address VARCHAR(512) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE activity_type activity_type VARCHAR(32) NOT NULL COLLATE `utf8_unicode_ci`');
    }
}
