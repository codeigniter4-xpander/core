<?php namespace CI4Xpander\Config;

class Services extends \CodeIgniter\Config\Services
{
    public static function viewScript(bool $shared = true)
    {
        if ($shared) {
            return static::getSharedInstance('viewScript');
        }

        return new \CI4Xpander\View\Component\Script();
    }

    public static function modelTracker(bool $shared = true)
    {
        if ($shared) {
            return static::getSharedInstance('modelTracker');
        }

        return new \CI4Xpander\Model\Tracker();
    }
}