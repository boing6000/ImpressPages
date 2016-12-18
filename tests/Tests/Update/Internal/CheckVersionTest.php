<?php
/**
 * @package   ImpressPages
 *
 *
 */

namespace Tests\Update\Internal;

class CheckVersionTest extends \PhpUnit\GeneralTestCase
{
    /**
     * @large
     */
    public function testVersionConstant()
    {
        $code = file_get_contents(TEST_CODEBASE_DIR.'public/Ip/Application.php');

        $position =  strpos($code, '\''.CURRENT_VERSION.'\'');
        $this->assertNotEquals($position, FALSE, 'public/Ip/Application.php has no version string.');

        $code = file_get_contents(TEST_CODEBASE_DIR . 'Ip/Internal/Update/Model.php');
        $position =  strpos($code, 'return '.CURRENT_DBVERSION.';');
        $this->assertNotEquals($position, FALSE, 'Ip/Internal/Update/Model.php has no dbVersion string.');

    }

}
