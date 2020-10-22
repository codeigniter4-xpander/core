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

    public static function hashPassword($password = '', $algo = null) {
        if (is_null($algo)) {
            switch (env('ci4xpander.dashboard.password_hash_algo', 'default')) {
                case 'argon2id':
                    $algo = PASSWORD_ARGON2ID;
                break;
                case 'argon2i':
                    $algo = PASSWORD_ARGON2I;
                break;
                case 'bcrypt':
                    $algo = PASSWORD_BCRYPT;
                break;
                default:
                    $algo = PASSWORD_DEFAULT;
                break;
            }
        }

        return password_hash($password, $algo);
    }

    public static function message($type = null, $value = null, bool $shared = true)
    {
        if ($shared) {
            return static::getSharedInstance('message', $type, $value);
        }

        return \CI4Xpander\Helpers\Message::create($type, $value);
    }
}