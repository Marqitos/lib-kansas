<?php declare(strict_types = 1);
/**
 * Comprueba el funcionamiento del objeto System\Version
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 7 >= 7.3
 */
namespace test\System;

use PHPUnit\Framework\TestCase;
use System\Version;

/**
 * Comprueba el funcionamiento del objeto System\Version
 */
class VersionTest extends TestCase {

    /**
     * Comprobamos el funcionamiento de la clase System\Version
     * 
     * @covers System\Version::__construct
     * @covers System\Version::__toString
     *
     * @return void
     */
    public function testVersion() {
        require_once 'System/Version.php';
        $versionInstance = new Version(5);
        $versionOtherInstance = new Version(6, 1);
        $phpVersion = new Version(PHP_VERSION);

        $this->assertEquals('5.0', $versionInstance->__toString());
        $this->assertEquals(new Version(5), $versionInstance);
        $this->assertEquals(new Version('5'), $versionInstance);
        $this->assertEquals('6.1', $versionOtherInstance->__toString());
        $this->assertEquals(new Version(6, 1), $versionOtherInstance);
        $this->assertEquals(new Version('6.1'), $versionOtherInstance);
        $this->assertNotEquals($versionInstance, $versionOtherInstance);
    }

    // TODO: Comprobar el funcionamiento de los métodos de la clase System\Version

}