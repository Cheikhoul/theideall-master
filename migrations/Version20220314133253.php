<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220314133253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // admin@mail.com:adminpassword
        $this->addSql("INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `phonenumber`, `address`, `activity_type`, `bilingual`, `status`) VALUES (NULL, 'admin@mail.com', '[\"ROLE_ADMIN\"]', '$2y$13$9vk.d1WdaZ8P8pbjicazIOq6QQlqpIS4dRTg1wYu/lsuKmAoYgNFG', 'Admin', 'Admin', NULL, 'N/A', 'N/A', '0', '1')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
