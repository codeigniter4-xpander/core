<?php namespace Xpander\Database\Migrations;

class CreateTableMenuPermission extends \Xpander\Migration
{
	public function up()
	{
        $this->db->transStart();

        $this->forge->addField(array_merge(
            \Xpander\Helpers\Database\Table\Field::ID(),
            \Xpander\Helpers\Database\Table\Field::foreignID('status'),
            \Xpander\Helpers\Database\Table\Field::foreignID('menu'),
            \Xpander\Helpers\Database\Table\Field::foreignID('permission'),
            \Xpander\Helpers\Database\Table\Field::boolean('C'),
            \Xpander\Helpers\Database\Table\Field::boolean('R'),
            \Xpander\Helpers\Database\Table\Field::boolean('U'),
            \Xpander\Helpers\Database\Table\Field::boolean('D'),
            \Xpander\Helpers\Database\Table\Field::trackable()
        ))->addUniqueKey([
            'menu_id', 'permission_id'
        ])->addPrimaryKey('id')->createTable('menu_permission');

        $this->db->transComplete();
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->db->transStart();

        $this->forge->dropTable('menu_permission', true);

        $this->db->transComplete();
	}
}
