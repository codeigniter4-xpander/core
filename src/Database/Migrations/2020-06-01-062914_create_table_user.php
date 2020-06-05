<?php namespace Xpander\Database\Migrations;

class CreateTableUser extends \Xpander\Migration
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
            \Xpander\Helpers\Database\Table\Field::string('email', [
                'null' => false
            ]),
            \Xpander\Helpers\Database\Table\Field::string('name', [
                'null' => false
            ]),
            \Xpander\Helpers\Database\Table\Field::string('password', [
                'null' => false
            ]),
            \Xpander\Helpers\Database\Table\Field::trackable()
        ))->addUniqueKey('code')->addUniqueKey('email')->addPrimaryKey('id')->createTable('user');

        $this->db->transComplete();
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->db->transStart();

        $this->forge->dropTable('user', true);

        $this->db->transComplete();
	}
}
