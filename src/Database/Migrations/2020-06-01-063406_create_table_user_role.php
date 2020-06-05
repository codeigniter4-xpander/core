<?php namespace Xpander\Database\Migrations;

class CreateTableUserRole extends \Xpander\Migration
{
	public function up()
	{
        $this->db->transStart();

        $this->forge->addField(array_merge(
            \Xpander\Helpers\Database\Table\Field::ID(),
            \Xpander\Helpers\Database\Table\Field::foreignID('status'),
            \Xpander\Helpers\Database\Table\Field::foreignID('user'),
            \Xpander\Helpers\Database\Table\Field::foreignID('role'),
            \Xpander\Helpers\Database\Table\Field::trackable()
        ))->addUniqueKey([
            'user_id', 'role_id'
        ])->addPrimaryKey('id')->createTable('user_role');

        $this->db->transComplete();
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->db->transStart();

        $this->forge->dropTable('user_role', true);

        $this->db->transComplete();
	}
}
