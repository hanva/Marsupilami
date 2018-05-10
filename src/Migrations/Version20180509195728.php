<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180509195728 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE friends DROP FOREIGN KEY FK_21EE7069415F1F91');
        $this->addSql('ALTER TABLE friends DROP FOREIGN KEY FK_21EE706953EAB07F');
        $this->addSql('DROP INDEX IDX_21EE7069415F1F91 ON friends');
        $this->addSql('DROP INDEX IDX_21EE706953EAB07F ON friends');
        $this->addSql('ALTER TABLE friends DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE friends ADD user_id INT NOT NULL, ADD friend_user_id INT NOT NULL, DROP user_a_id, DROP user_b_id');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_21EE7069A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_21EE706993D1119E FOREIGN KEY (friend_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_21EE7069A76ED395 ON friends (user_id)');
        $this->addSql('CREATE INDEX IDX_21EE706993D1119E ON friends (friend_user_id)');
        $this->addSql('ALTER TABLE friends ADD PRIMARY KEY (user_id, friend_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE friends DROP FOREIGN KEY FK_21EE7069A76ED395');
        $this->addSql('ALTER TABLE friends DROP FOREIGN KEY FK_21EE706993D1119E');
        $this->addSql('DROP INDEX IDX_21EE7069A76ED395 ON friends');
        $this->addSql('DROP INDEX IDX_21EE706993D1119E ON friends');
        $this->addSql('ALTER TABLE friends DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE friends ADD user_a_id INT NOT NULL, ADD user_b_id INT NOT NULL, DROP user_id, DROP friend_user_id');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_21EE7069415F1F91 FOREIGN KEY (user_a_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_21EE706953EAB07F FOREIGN KEY (user_b_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_21EE7069415F1F91 ON friends (user_a_id)');
        $this->addSql('CREATE INDEX IDX_21EE706953EAB07F ON friends (user_b_id)');
        $this->addSql('ALTER TABLE friends ADD PRIMARY KEY (user_a_id, user_b_id)');
    }
}
