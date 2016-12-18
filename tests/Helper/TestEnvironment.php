<?php
/**
 * @package   ImpressPages
 */

namespace PhpUnit\Helper;

class TestEnvironment
{
    public static function setupOnce()
    {
        static $hasRun = false;

        if ($hasRun) {
            return false;
        }

        $hasRun = true;

        // create test database structure
        \Ip\Internal\Install\TestService::setupTestDatabase(TEST_DB_NAME, 'ip_');
    }

    public static function setup()
    {
        static::filesSetup();
        static::setupCode();
    }

    public static function setupCode($configBasename = 'default.php')
    {
        global $application;
        $application = new \Ip\Application(TEST_FIXTURE_DIR . 'config/' . $configBasename);

        if (!defined('IUL_TESTMODE')) {
            define('IUL_TESTMODE', 1);
        }

        //because of PHPUnit magic, we have to repeat it on every test
//
        require_once TEST_CODEBASE_DIR . 'vendor/impresspages/core/Ip/Functions.php';
        $config = require(TEST_FIXTURE_DIR . 'config/' . $configBasename);
        $config = new \Ip\Config($config);
        \Ip\ServiceLocator::setConfig($config);
        $application->prepareEnvironment();

        static::setupOnce();

        $_GET = array();
        $_POST = array();
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['SERVER_PORT'] = 80;
        $_SERVER['SERVER_NAME'] = 'localhost';

        \Ip\ServiceLocator::addRequest(new \Ip\Request());

        \Ip\ServiceLocator::dispatcher()->_bindApplicationEvents();

        ipContent()->_setCurrentLanguage(ipContent()->getLanguageByCode('en'));
    }

    public static function filesSetup()
    {
        self::cleanupFiles();

        $fileSystemHelper = new \PhpUnit\Helper\FileSystem();
        $fileSystemHelper->cpDir(TEST_FIXTURE_DIR.'InstallationDirs', TEST_TMP_DIR);

    }

    public static function cleanupFiles()
    {
        $fs = new \PhpUnit\Helper\FileSystem();
//        $fs->chmod(TEST_TMP_DIR, 0755);
        $fs->cleanDir(TEST_TMP_DIR);
        $fs->chmod(TEST_TMP_DIR . '.gitignore', 0664);
        $fs->chmod(TEST_TMP_DIR . 'readme.txt', 0664);
    }
}
