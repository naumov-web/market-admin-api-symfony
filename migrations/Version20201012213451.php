<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201012213451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "files_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "product_parameter_values_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_parameters_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "products_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "files" (id INT NOT NULL, name VARCHAR(1000) NOT NULL, path VARCHAR(2000) NOT NULL, mime VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "product_categories" (id INT NOT NULL, name VARCHAR(1000) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "product_parameter_values" (id INT NOT NULL, product_id INT NOT NULL, product_parameter_id INT NOT NULL, value VARCHAR(1000) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_505522EB4584665A ON "product_parameter_values" (product_id)');
        $this->addSql('CREATE INDEX IDX_505522EBF1F2F9BD ON "product_parameter_values" (product_parameter_id)');
        $this->addSql('CREATE TABLE "product_parameters" (id INT NOT NULL, name VARCHAR(1000) NOT NULL, type_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "products" (id INT NOT NULL, product_category_id INT NOT NULL, name VARCHAR(1000) NOT NULL, description TEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B3BA5A5ABE6903FD ON "products" (product_category_id)');
        $this->addSql('CREATE TABLE product_files (product_id INT NOT NULL, file_id INT NOT NULL, PRIMARY KEY(product_id, file_id))');
        $this->addSql('CREATE INDEX IDX_A7693B054584665A ON product_files (product_id)');
        $this->addSql('CREATE INDEX IDX_A7693B0593CB796C ON product_files (file_id)');
        $this->addSql('CREATE TABLE "users" (id INT NOT NULL, email VARCHAR(1000) NOT NULL, phone VARCHAR(50) NOT NULL, name VARCHAR(200) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON "users" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9444F97DD ON "users" (phone)');
        $this->addSql('ALTER TABLE "product_parameter_values" ADD CONSTRAINT FK_505522EB4584665A FOREIGN KEY (product_id) REFERENCES "products" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "product_parameter_values" ADD CONSTRAINT FK_505522EBF1F2F9BD FOREIGN KEY (product_parameter_id) REFERENCES "product_parameters" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "products" ADD CONSTRAINT FK_B3BA5A5ABE6903FD FOREIGN KEY (product_category_id) REFERENCES "product_categories" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_files ADD CONSTRAINT FK_A7693B054584665A FOREIGN KEY (product_id) REFERENCES "products" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_files ADD CONSTRAINT FK_A7693B0593CB796C FOREIGN KEY (file_id) REFERENCES "files" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product_files DROP CONSTRAINT FK_A7693B0593CB796C');
        $this->addSql('ALTER TABLE "products" DROP CONSTRAINT FK_B3BA5A5ABE6903FD');
        $this->addSql('ALTER TABLE "product_parameter_values" DROP CONSTRAINT FK_505522EBF1F2F9BD');
        $this->addSql('ALTER TABLE "product_parameter_values" DROP CONSTRAINT FK_505522EB4584665A');
        $this->addSql('ALTER TABLE product_files DROP CONSTRAINT FK_A7693B054584665A');
        $this->addSql('DROP SEQUENCE "files_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE product_categories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "product_parameter_values_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE product_parameters_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "products_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP TABLE "files"');
        $this->addSql('DROP TABLE "product_categories"');
        $this->addSql('DROP TABLE "product_parameter_values"');
        $this->addSql('DROP TABLE "product_parameters"');
        $this->addSql('DROP TABLE "products"');
        $this->addSql('DROP TABLE product_files');
        $this->addSql('DROP TABLE "users"');
    }
}
