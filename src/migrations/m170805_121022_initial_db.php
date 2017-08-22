<?php
use yii\db\Schema;
use yii\db\Migration;

class m170805_121022_initial_db extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable(
            '{{%production_category}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => $this->string()->notNull(),
            ],
            $tableOptions
        );
        
        $this->createTable(
            '{{%production_component}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => $this->string()->notNull(),
                'amount' => $this->integer(),
                'price' => $this->decimal(11, 2),
            ],
            $tableOptions
        );
        
        $this->createTable(
            '{{%production_template}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => $this->string()->notNull(),
                'category_id' => $this->integer(),
                'model_name' => $this->string(),
                'model_id' => $this->integer(),
                'price' => $this->decimal(11, 2),
                'sku' => $this->string(),
                'code' => $this->string(),
            ],
            $tableOptions
        );
        
        $this->createTable(
            '{{%production_template_element}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => $this->string()->notNull(),
                'template_id' => $this->integer()->notNull(),
                'component_id' => $this->integer()->notNull(),
                'amount' => $this->integer(),
            ],
            $tableOptions
        );
        
        $this->createTable(
            '{{%production_product}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => $this->integer(),
                'category_id' => $this->integer(),
                'status' => $this->integer(),
                'sku' => $this->string(),
                'code' => $this->string(),
                'price' => $this->decimal(11, 2),
                'model_name' => $this->string(),
                'model_id' => $this->integer(),
                'component_id' => $this->integer(),
                'template_id' => $this->integer()->notNull(),
                'created_at' => $this->integer(),
                'updated_at' => $this->integer()
            ],
            $tableOptions
        );

        $this->createTable(
            '{{%production_product_element}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => $this->string(),
                'component_id' => $this->integer(),
                'price' => $this->decimal(11, 2),
                'model_name' => $this->string(),
                'model_id' => $this->integer(),
                'amount' => $this->integer(),
                'product_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );
        
        $this->addForeignKey(
            'elem_to_prod', '{{%production_product_element}}', 'product_id', '{{%production_product}}', 'id', 'CASCADE', 'CASCADE'
        );
        
        $this->addForeignKey(
            'elem_to_tpl', '{{%production_template_element}}', 'template_id', '{{%production_template}}', 'id', 'CASCADE', 'CASCADE'
        );
        
        $this->addForeignKey(
            'prod_to_cat', '{{%production_product}}', 'category_id', '{{%production_category}}', 'id', 'CASCADE', 'CASCADE'
        );
        
        $this->addForeignKey(
            'tpl_to_cat', '{{%production_template}}', 'category_id', '{{%production_category}}', 'id', 'CASCADE', 'CASCADE'
        );
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%production_product}}');
        $this->dropTable('{{%production_template}}');
        $this->dropTable('{{%production_category}}');
        $this->dropTable('{{%production_template_element}}');
        $this->dropTable('{{%production_product_element}}');
    }
}
