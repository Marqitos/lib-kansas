<?php
/**
 * Comprueba el funcionamiento de ArgumentNullException
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
use System\ArgumentNullException;
use System\HResults;

require_once 'System/ArgumentNullException.php';
require_once 'System/HResults.php';

/**
 * Comprueba el funcionamiento de ArgumentNullException
 * 
 * @see System\ArgumentNullException
 */
class ArgumentNullExceptionTest extends TestCase {

    private static $paramName   = 'param';
    private static $message     = 'El argumento no puede ser null';
    private static $value       = true;

    /**
     * Crea la excepción con los minimos parametros posibles
     * 
     * @covers System\ArgumentNullException::__construct
     * @covers System\ArgumentException::getParamName
     */
    public function testCreateMin() {
        $aException = new ArgumentNullException(self::$paramName);
        $this->assertEquals(self::$paramName,           $aException->getParamName());
        $this->assertEquals(HResults::E_POINTER,        $aException->getCode());
        $this->assertNotNull($aException->getMessage());
        $this->assertTrue($aException instanceof Throwable);
    }

    /**
     * Crea la excepción con los parametros habituales
     * 
     * @covers System\ArgumentNullException::__construct
     * @covers System\ArgumentException::getParamName
     */
    public function testCreate() {
        $aException = new ArgumentNullException(self::$paramName, self::$message);
        $this->assertEquals(self::$paramName,           $aException->getParamName());
        $this->assertEquals(self::$message,             $aException->getMessage());
        $this->assertEquals(HResults::E_POINTER,        $aException->getCode());
        $this->assertTrue($aException instanceof Throwable);
    }

    /**
     * Lanza la excepción
     * 
     * @covers System\ArgumentNullException::__construct
     */
    public function testThrowException() {
        $this->expectException(ArgumentNullException::class);
        $this->expectExceptionCode(HResults::E_POINTER);
        throw new ArgumentNullException(self::$paramName, self::$message);
    }

    /**
     * Comprobamos el valor de una variable
     * 
     * @covers System\ArgumentNullException::__construct
     * @covers System\ArgumentNullException::validate
     */
    public function testValidateNull() {
        $this->expectException(ArgumentNullException::class);
        $this->expectExceptionCode(HResults::E_POINTER);
        ArgumentNullException::validate(self::$paramName, null);
        
    }

    /**
     * Comprobamos el valor de una variable
     * 
     * @covers System\ArgumentNullException::validate
     */
    public function testValidateNotNull() {
        ArgumentNullException::validate(self::$paramName, self::$value);
        $this->assertTrue(true);
    }


}