<?php namespace CI4Xpander\Model;

class Tracker
{
    public $createdBy = 0;
    public $updatedBy = 0;
    public $deletedBy = 0;

    public function setCreatedBy($createdBy = 0)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function setUpdatedBy($updatedBy = 0)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function setDeletedBy($deletedBy = 0)
    {
        $this->deletedBy = $deletedBy;
        return $this;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    public function getDeletedBy()
    {
        return $this->deletedBy;
    }
}