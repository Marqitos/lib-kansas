<?php
/**
 * Comprueba el funcionamiento de ArgumentOutOfRangeException
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
use System\ArgumentOutOfRangeException;
use System\HResults;

require_once 'System/ArgumentOutOfRangeException.php';
require_once 'System/HResults.php';

/**
 * Comprueba el funcionamiento de ArgumentOutOfRangeException
 * 
 * @see System\ArgumentOutOfRangeException
 */
class ArgumentOutOfRangeExceptionTest extends TestCase {

    private static $paramName       = 'param';
    private static $message         = 'Se ha especificado un argumento fuera de rango';
    private static $messageString   = 'Se esperaba una cadena de texto';
    private static $messageInteger  = 'Se esperaba un entero';
    private static $valueInteger    = 55;
    private static $valueString     = 'fooBar';

    /**
     * Crea la excepción con los minimos parametros posibles
     * 
     * @covers System\ArgumentOutOfRangeException::__construct
     * @covers System\ArgumentException::getParamName
     */
    public function testCreateMin() {
        $aException = new ArgumentOutOfRangeException(self::$paramName);
        $this->assertEquals(self::$paramName,                   $aException->getParamName());
        $this->assertEquals(HResults::COR_E_ARGUMENTOUTOFRANGE, $aException->getCode());
        $this->assertNotNull($aException->getMessage());
        $this->assertTrue($aException instanceof Throwable);
    }

    /**
     * Crea la excepción con los parametros basicos
     * 
     * @covers System\ArgumentOutOfRangeException::__construct
     * @covers System\ArgumentException::getParamName
     */
    public function testCreate() {
        $aException = new ArgumentOutOfRangeException(self::$paramName, self::$message);
        $this->assertEquals(self::$paramName,                   $aException->getParamName());
        $this->assertEquals(self::$message,                     $aException->getMessage());
        $this->assertEquals(HResults::COR_E_ARGUMENTOUTOFRANGE, $aException->getCode());
        $this->assertTrue($aException instanceof Throwable);
    }

    /**
     * Crea la excepción con los parametros habituales
     * 
     * @covers System\ArgumentOutOfRangeException::__construct
     * @covers System\ArgumentOutOfRangeException::getActualValue
     * @covers System\ArgumentOutOfRangeException::getTypeValue
     * @covers System\ArgumentException::getParamName
     */
    public function testCreateInteger() {
        $aException = new ArgumentOutOfRangeException(self::$paramName, self::$messageString, self::$valueInteger);
        $this->assertEquals(self::$paramName,                   $aException->getParamName());
        $this->assertEquals(self::$messageString,               $aException->getMessage());
        $this->assertEquals(self::$valueInteger,                $aException->getActualValue());
        $this->assertEquals('integer',                          $aException->getTypeValue());
        $this->assertEquals(HResults::COR_E_ARGUMENTOUTOFRANGE, $aException->getCode());
        $this->assertTrue($aException instanceof Throwable);
    }

    /**
     * Crea la excepción con los parametros habituales
     * 
     * @covers System\ArgumentOutOfRangeException::__construct
     * @covers System\ArgumentOutOfRangeException::getActualValue
     * @covers System\ArgumentOutOfRangeException::getTypeValue
     * @covers System\ArgumentException::getParamName
     */
    public function testCreateString() {
        $aException = new ArgumentOutOfRangeException(self::$paramName, self::$messageInteger, self::$valueString);
        $this->assertEquals(self::$paramName,                   $aException->getParamName());
        $this->assertEquals(self::$messageInteger,              $aException->getMessage());
        $this->assertEquals(self::$valueString,                 $aException->getActualValue());
        $this->assertEquals('string',                           $aException->getTypeValue());
        $this->assertEquals(HResults::COR_E_ARGUMENTOUTOFRANGE, $aException->getCode());
        $this->assertTrue($aException instanceof Throwable);
    }

    /**
     * Lanza la excepción
     * 
     * @covers System\ArgumentOutOfRangeException::__construct
     */
    public function testThrowException() {
        $this->expectException(ArgumentOutOfRangeException::class);
        $this->expectExceptionCode(HResults::COR_E_ARGUMENTOUTOFRANGE);
        throw new ArgumentOutOfRangeException(self::$paramName, self::$message);
    }

}