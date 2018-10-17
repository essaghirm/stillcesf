<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181010151033 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE meeting ADD project_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E139166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E139A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F515E139166D1F9C ON meeting (project_id)');
        $this->addSql('CREATE INDEX IDX_F515E139A76ED395 ON meeting (user_id)');
        $this->addSql('ALTER TABLE photo ADD project_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_14B78418166D1F9C ON photo (project_id)');
        $this->addSql('CREATE INDEX IDX_14B78418A76ED395 ON photo (user_id)');
        $this->addSql('ALTER TABLE project ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EEA76ED395 ON project (user_id)');
        $this->addSql('ALTER TABLE task ADD project_id INT DEFAULT NULL, ADD creator INT DEFAULT NULL, ADD attached_to INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25BC06EA63 FOREIGN KEY (creator) REFERENCES user (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25FEA0059A FOREIGN KEY (attached_to) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_527EDB25166D1F9C ON task (project_id)');
        $this->addSql('CREATE INDEX IDX_527EDB25BC06EA63 ON task (creator)');
        $this->addSql('CREATE INDEX IDX_527EDB25FEA0059A ON task (attached_to)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE meeting DROP FOREIGN KEY FK_F515E139166D1F9C');
        $this->addSql('ALTER TABLE meeting DROP FOREIGN KEY FK_F515E139A76ED395');
        $this->addSql('DROP INDEX IDX_F515E139166D1F9C ON meeting');
        $this->addSql('DROP INDEX IDX_F515E139A76ED395 ON meeting');
        $this->addSql('ALTER TABLE meeting DROP project_id, DROP user_id');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418166D1F9C');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418A76ED395');
        $this->addSql('DROP INDEX IDX_14B78418166D1F9C ON photo');
        $this->addSql('DROP INDEX IDX_14B78418A76ED395 ON photo');
        $this->addSql('ALTER TABLE photo DROP project_id, DROP user_id');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEA76ED395');
        $this->addSql('DROP INDEX IDX_2FB3D0EEA76ED395 ON project');
        $this->addSql('ALTER TABLE project DROP user_id');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25166D1F9C');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25BC06EA63');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25FEA0059A');
        $this->addSql('DROP INDEX IDX_527EDB25166D1F9C ON task');
        $this->addSql('DROP INDEX IDX_527EDB25BC06EA63 ON task');
        $this->addSql('DROP INDEX IDX_527EDB25FEA0059A ON task');
        $this->addSql('ALTER TABLE task DROP project_id, DROP creator, DROP attached_to');
    }
}
