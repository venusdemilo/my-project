<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190114104516 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY mouvement_ibfk_1');
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY mouvement_ibfk_2');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE compta');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE ecriture');
        $this->addSql('DROP TABLE mouvement');
        $this->addSql('DROP TABLE personnages');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compta (prixproduit SMALLINT NOT NULL, remise SMALLINT NOT NULL, autresachats SMALLINT NOT NULL, acompte SMALLINT NOT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE compte (numCpte VARCHAR(5) NOT NULL COLLATE latin1_swedish_ci, intCmpte TEXT NOT NULL COLLATE latin1_swedish_ci, typCpte TINYINT(1) NOT NULL, PRIMARY KEY(numCpte)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ecriture (numEcr INT AUTO_INCREMENT NOT NULL, datEcr DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, libEcr TEXT NOT NULL COLLATE latin1_swedish_ci, INDEX numEcr (numEcr), PRIMARY KEY(numEcr)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mouvement (ecriture INT NOT NULL, compte VARCHAR(5) NOT NULL COLLATE latin1_swedish_ci, debit NUMERIC(10, 0) DEFAULT \'0\' NOT NULL, credit NUMERIC(10, 0) DEFAULT \'0\' NOT NULL, INDEX compte (compte), INDEX IDX_5B51FC3E3098DEB (ecriture), PRIMARY KEY(ecriture, compte)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE personnages (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL COLLATE utf8_general_ci, degats TINYINT(1) DEFAULT \'0\' NOT NULL, UNIQUE INDEX nom (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT mouvement_ibfk_1 FOREIGN KEY (compte) REFERENCES compte (numCpte) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT mouvement_ibfk_2 FOREIGN KEY (ecriture) REFERENCES ecriture (numEcr) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP TABLE product');
    }
}
