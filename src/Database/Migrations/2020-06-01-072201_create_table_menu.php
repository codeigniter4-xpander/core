<?php namespace Xpander\Database\Migrations;

class CreateTableMenu extends \Xpander\Migration
{
	public function up()
	{
        $this->db->transStart();

        $this->forge->addField(array_merge(
            \Xpander\Helpers\Database\Table\Field::ID(),
            \Xpander\Helpers\Database\Table\Field::parentID(),
            \Xpander\Helpers\Database\Table\Field::foreignID('status'),
            \Xpander\Helpers\Database\Table\Field::foreignID('type'),
            \Xpander\Helpers\Database\Table\Field::string('code', [
                'null' => false
            ]),
            \Xpander\Helpers\Database\Table\Field::string('name', [
                'null' => false
            ]),
            \Xpander\Helpers\Database\Table\Field::text('description'),
            \Xpander\Helpers\Database\Table\Field::string('url'),
            \Xpander\Helpers\Database\Table\Field::string('icon'),
            \Xpander\Helpers\Database\Table\Field::orderingInteger('level'),
            \Xpander\Helpers\Database\Table\Field::orderingInteger(),
            \Xpander\Helpers\Database\Table\Field::trackable()
        ))->addUniqueKey('code')->addPrimaryKey('id')->createTable('menu');

        $this->db->transComplete();
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->db->transStart();

        $this->forge->dropTable('menu', true);

        $this->db->transComplete();
	}
}
