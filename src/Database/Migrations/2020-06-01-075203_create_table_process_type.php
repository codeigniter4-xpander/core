<?php namespace Xpander\Database\Migrations;

class CreateTableProcessType extends \Xpander\Migration
{
	public function up()
	{
        $this->db->transStart();

        $this->forge->addField(array_merge(
            \Xpander\Helpers\Database\Table\Field::ID(),
            \Xpander\Helpers\Database\Table\Field::foreignID('status'),
            \Xpander\Helpers\Database\Table\Field::string('code', [
                'null' => false
            ]),
            \Xpander\Helpers\Database\Table\Field::string('name', [
                'null' => false
            ]),
            \Xpander\Helpers\Database\Table\Field::text('description'),
            \Xpander\Helpers\Database\Table\Field::trackable()
        ))->addUniqueKey('code')->addPrimaryKey('id')->createTable('process_type');

        $this->db->transComplete();
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->db->transStart();

        $this->forge->dropTable('process_type', true);

        $this->db->transComplete();
	}
}
