<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201012204148 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "product_parameter_values_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "product_parameter_values" (id INT NOT NULL, product_id INT NOT NULL, product_parameter_id INT NOT NULL, value VARCHAR(1000) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_505522EB4584665A ON "product_parameter_values" (product_id)');
        $this->addSql('CREATE INDEX IDX_505522EBF1F2F9BD ON "product_parameter_values" (product_parameter_id)');
        $this->addSql('ALTER TABLE "product_parameter_values" ADD CONSTRAINT FK_505522EB4584665A FOREIGN KEY (product_id) REFERENCES "products" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "product_parameter_values" ADD CONSTRAINT FK_505522EBF1F2F9BD FOREIGN KEY (product_parameter_id) REFERENCES "product_parameters" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_categories ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE product_parameters ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE products ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "product_parameter_values_id_seq" CASCADE');
        $this->addSql('DROP TABLE "product_parameter_values"');
        $this->addSql('CREATE SEQUENCE product_parameters_id_seq');
        $this->addSql('SELECT setval(\'product_parameters_id_seq\', (SELECT MAX(id) FROM "product_parameters"))');
        $this->addSql('ALTER TABLE "product_parameters" ALTER id SET DEFAULT nextval(\'product_parameters_id_seq\')');
        $this->addSql('CREATE SEQUENCE product_categories_id_seq');
        $this->addSql('SELECT setval(\'product_categories_id_seq\', (SELECT MAX(id) FROM "product_categories"))');
        $this->addSql('ALTER TABLE "product_categories" ALTER id SET DEFAULT nextval(\'product_categories_id_seq\')');
        $this->addSql('CREATE SEQUENCE products_id_seq');
        $this->addSql('SELECT setval(\'products_id_seq\', (SELECT MAX(id) FROM "products"))');
        $this->addSql('ALTER TABLE "products" ALTER id SET DEFAULT nextval(\'products_id_seq\')');
    }
}
