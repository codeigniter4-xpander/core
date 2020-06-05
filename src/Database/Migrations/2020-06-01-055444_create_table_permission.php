<?php namespace Xpander\Database\Migrations;

class CreateTablePermission extends \Xpander\Migration
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
        ))->addUniqueKey('code')->addPrimaryKey('id')->createTable('permission');

        $this->db->transComplete();
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->db->transStart();

        $this->forge->dropTable('permission', true);

        $this->db->transComplete();
	}
}
