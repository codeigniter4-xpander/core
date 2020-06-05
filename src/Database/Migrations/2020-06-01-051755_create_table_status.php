<?php namespace Xpander\Database\Migrations;

class CreateTableStatus extends \Xpander\Migration
{
	public function up()
	{
        $this->db->transStart();

        $this->forge->addField(array_merge(
            \Xpander\Helpers\Database\Table\Field::ID(),
            \Xpander\Helpers\Database\Table\Field::string('code', [
                'null' => false
            ]),
            \Xpander\Helpers\Database\Table\Field::string('name', [
                'null' => false
            ]),
            \Xpander\Helpers\Database\Table\Field::text('description'),
            \Xpander\Helpers\Database\Table\Field::trackable()
        ))->addPrimaryKey('id')->addUniqueKey('code')->createTable('status');

        $this->db->transComplete();
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->db->transStart();

        $this->forge->dropTable('status', true);

        $this->db->transComplete();
	}
}
