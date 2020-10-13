<?php

namespace CI4Xpander\Helpers\Database\Table;

class Field
{
    public function __construct()
    {}

    public static function ID($default = [
        'name' => 'id',
        'type' => 'INT',
        'unsigned' => true
    ])
    {
        return [
            $default['name'] ?? 'id' => [
                'type' => $default['type'] ?? 'INT',
                'unsigned' => $default['unsigned'] ?? true,
                'auto_increment' => true,
                'null' => false
            ]
        ];
    }

    public static function string($name = '', $default = [
        'type' => 'VARCHAR',
        'length' => 255,
        'null' => true
    ])
    {
        return [
            $name => [
                'type' => $default['type'] ?? 'VARCHAR',
                'constraint' => $default['length'] ?? 255,
                'null' => $default['null'] ?? true
            ]
        ];
    }

    public static function timestamp($name = '', $default = [
        'type' => 'TIMESTAMP',
        'null' => true
    ])
    {
        return [
            $name => [
                'type' => $default['type'] ?? 'TIMESTAMP',
                'null' => $default['null'] ?? true
            ]
        ];
    }

    public static function date($name = '', $default = [
        'type' => 'DATE',
        'null' => true
    ])
    {
        return [
            $name => [
                'type' => $default['type'] ?? 'DATE',
                'null' => $default['null'] ?? true
            ]
        ];
    }

    public static function time($name = '', $default = [
        'type' => 'TIME',
        'null' => true
    ])
    {
        return [
            $name => [
                'type' => $default['type'] ?? 'TIME',
                'null' => $default['null'] ?? true
            ]
        ];
    }

    public static function foreignID($name = '', $default = [
        'type' => 'INT',
        'unsigned' => true,
        'null' => false,
        'default' => 0,
    ])
    {
        return [
            $name . '_id' => [
                'type' => $default['type'] ?? 'INT',
                'unsigned' => $default['unsigned'] ?? true,
                'null' => $default['null'] ?? false,
                'default' => $default['default'] ?? 0,
            ]
        ];
    }

    public static function parentID($name = 'parent', $default = [
        'type' => 'INT',
        'unsigned' => true,
        'null' => false,
        'default' => 0,
    ])
    {
        return [
            $name . '_id' => [
                'type' => $default['type'] ?? 'INT',
                'unsigned' => $default['unsigned'] ?? true,
                'null' => $default['null'] ?? false,
                'default' => $default['default'] ?? 0,
            ]
        ];
    }

    public static function integer($name = '', $default = [
        'type' => 'INT',
        'unsigned' => false,
        'null' => false,
        'default' => 0
    ])
    {
        return [
            $name => [
                'type' => $default['type'] ?? 'INT',
                'unsigned' => $default['unsigned'] ?? false,
                'null' => $default['null'] ?? false,
                'default' => $default['default'] ?? 0
            ]
        ];
    }

    public static function orderingInteger($name = 'sequence_position', $default = [
        'type' => 'SMALLINT',
        'unsigned' => true,
        'null' => false,
        'default' => 99,
    ])
    {
        return [
            $name => [
                'type' => $default['type'] ?? 'SMALLINT',
                'unsigned' => $default['unsigned'] ?? true,
                'null' => $default['null'] ?? false,
                'default' => $default['default'] ?? 99,
            ]
        ];
    }

    public static function text($name = '', $default = [
        'type' => 'TEXT',
        'null' => true
    ])
    {
        return [
            $name => [
                'type' => $default['type'] ?? 'TEXT',
                'null' => $default['null'] ?? true
            ]
        ];
    }

    public static function float($name = '', $default = [
        'type' => 'FLOAT',
        'null' => false,
        'default' => 0,
        'unsigned' => false
    ])
    {
        return [
            $name => [
                'type' => $default['type'] ?? 'FLOAT',
                'null' => $default['null'] ?? false,
                'default' => $default['default'] ?? 0,
                'unsigned' => $default['unsigned'] ?? false
            ]
        ];
    }

    public static function real($name = '', $default = [
        'type' => 'REAL',
        'null' => false,
        'default' => 0,
        'unsigned' => false
    ])
    {
        return [
            $name => [
                'type' => $default['type'] ?? 'REAL',
                'null' => $default['null'] ?? false,
                'default' => $default['default'] ?? 0,
                'unsigned' => $default['unsigned'] ?? false
            ]
        ];
    }

    public static function trackable()
    {
        return [
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'created_by' => [
                'type' => 'INT',
                'null' => false,
                'default' => 0,
                'unsigned' => true
            ],
            'updated_by' => [
                'type' => 'INT',
                'null' => false,
                'default' => 0,
                'unsigned' => true
            ],
            'deleted_by' => [
                'type' => 'INT',
                'null' => false,
                'default' => 0,
                'unsigned' => true
            ]
        ];
    }

    public static function boolean($name = '', $default = [
        'null' => false,
        'default' => false
    ])
    {
        return [
            $name => [
                'type' => 'BOOLEAN',
                'null' => $default['null'] ?? false,
                'default' => $default['default'] ?? false
            ]
        ];
    }

    public static function json($name = '', $default = [
        'null' => true,
        'default' => null
    ])
    {
        return [
            $name => [
                'type' => 'JSON',
                'null' => $default['null'] ?? true,
                'default' => $default['default'] ?? null
            ]
        ];
    }

    public static function numeric($name = '', $default = [
        'null' => true,
        'default' => 0,
        'unsigned' => false
    ]) {
        return [
            $name => [
                'type' => 'NUMERIC',
                'null' => $default['null'] ?? true,
                'default' => $default['default'] ?? 0,
                'unsigned' => $default['unsigned'] ?? false
            ]
        ];
    }
}
