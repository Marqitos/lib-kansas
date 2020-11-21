<?php
/**
 * Comprueba el funcionamiento de ArgumentException
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 7 >= 7.3
 */
namespace test\System;

use Throwable;
use PHPUnit\Framework\TestCase;
use System\ArgumentException;
use System\HResults;

require_once 'System/ArgumentException.php';
require_once 'System/HResults.php';

/**
 * Comprueba el funcionamiento de ArgumentException
 * 
 * @see System\ArgumentException
 */
class ArgumentExceptionTest extends TestCase {

    private static $paramName   = 'param';
    private static $message     = 'Se ha especificado un argumento no válido';

    /**
     * Crea la excepción con los minimos parametros posibles
     */
    public function testCreateMin() {
        $aException = new ArgumentException(self::$paramName);
        $this->assertEquals(self::$paramName,           $aException->getParamName());
        $this->assertEquals(HResults::COR_E_ARGUMENT,   $aException->getCode());
        $this->assertNotNull($aException->getMessage());
        $this->assertTrue($aException instanceof Throwable);
    }

    /**
     * Crea la excepción con los parametros habituales
     */
    public function testCreate() {
        $aException = new ArgumentException(self::$paramName, self::$message);
        $this->assertEquals(self::$paramName,           $aException->getParamName());
        $this->assertEquals(self::$message,             $aException->getMessage());
        $this->assertEquals(HResults::COR_E_ARGUMENT,   $aException->getCode());
        $this->assertTrue($aException instanceof Throwable);
    }

    /**
     * Lanza la excepción
     */
    public function testThrowException() {
        $this->expectException(ArgumentException::class);
        $this->expectExceptionCode(HResults::COR_E_ARGUMENT);
        throw new ArgumentException(self::$paramName, self::$message);
    }

}