<?php

namespace CI4Xpander;

class Model extends \CodeIgniter\Model
{
    protected $primaryKey = 'id';
    protected $useSoftDelete = true;
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    protected $historyModel = null;

    public function __construct(\CodeIgniter\Database\ConnectionInterface &$db = null, \CodeIgniter\Validation\ValidationInterface $validation = null)
    {
        $this->allowedFields = array_merge($this->allowedFields, [
            'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'
        ]);

        parent::__construct($db, $validation);

        $this->_init();
    }

    protected function _init()
    {
        $this->beforeInsert[] = '_generateInsertTrackable';
        $this->beforeUpdate[] = '_generateUpdateTrackable';
        $this->beforeDelete[] = '_generateDeleteTrackable';

        if (!is_null($this->historyModel)) {
            $this->afterInsert[] = '_insertRiwayat';
            $this->afterUpdate[] = '_insertRiwayat';
        }
    }

    public function getTable()
    {
        return $this->table;
    }

    protected function _insertRiwayat($params)
    {
        if (!is_null($this->historyModel)) {
            if (is_array($params['id'])) {
                foreach ($params['id'] as $id) {
                    if ($id > 0) {
                        $item = $this->find($id)->toRawArray();
                        unset($item['id']);
        
                        $this->historyModel::create()->insert(array_merge($item, [
                            'master_id' => $id
                        ]));
                    }
                }
            } else {
                if ($params['id'] > 0) {
                    $item = $this->find($params['id'])->toRawArray();
                    unset($item['id']);
    
                    $this->historyModel::create()->insert(array_merge($item, [
                        'master_id' => $params['id']
                    ]));
                }
            }
        }
    }

    protected function _generateInsertTrackable($params)
    {
        $tracker = \Config\Services::modelTracker();
        $params['data']['created_by'] = $params['data']['created_by'] ?? $tracker->getCreatedBy();
        $params['data']['updated_by'] = $params['data']['updated_by'] ?? $tracker->getUpdatedBy();
        return $params;
    }
    
    protected function _generateUpdateTrackable($params)
    {
        $tracker = \Config\Services::modelTracker();
        $params['data']['updated_by'] = $params['data']['updated_by'] ?? $tracker->getUpdatedBy();
        return $params;
    }

    protected function _generateDeleteTrackable($params)
    {
        $tracker = \Config\Services::modelTracker();
        $params['data']['deleted_by'] = $params['data']['deleted_by'] ?? $tracker->getDeletedBy();
        return $params;
    }

    use ModelFactoryTrait;
}
