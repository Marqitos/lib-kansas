<?php declare(strict_types = 1);
/**
 * Comprueba el funcionamiento de la clase System\Guid
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 7 >= 7.3
 */
namespace test\System;

use PHPUnit\Framework\TestCase;
use System\Guid;
use System\ArgumentOutOfRangeException;

use function str_repeat;
use function chr;
use function strlen;

require_once 'System/Guid.php';

class GuidTest extends TestCase {

    /**
     * Comprueba la funcionalidad de Guid::getEmpty()
     * 
     * @covers System\Guid::getEmpty
     * @covers System\Guid::getHex
     * @covers System\Guid::getIsEmpty
     * @covers System\Guid::getRaw
     * @covers System\Guid::isEmpty
     */
    public function testEmptyGuid(){
        $emptyGuid = Guid::getEmpty();

        // Prueba la funcion ->isEmpty()
        $this->assertTrue($emptyGuid->getIsEmpty());
        $this->assertTrue(Guid::isEmpty($emptyGuid));
        $this->assertTrue(Guid::isEmpty(null));

        // Compara su valor binario
        $this->assertEquals(str_repeat(chr(0), 16), $emptyGuid->getRaw());

        // Compara su valor hexadecimal
        $this->assertEquals(str_repeat('0', 32), $emptyGuid->getHex());
        
        // Compara 2 instancias con el mismo valor
        $this->assertEquals(Guid::getEmpty(), $emptyGuid);
    }

    /**
     * Comprueba los metodos de la clase Guid
     * 
     * @covers System\Guid::__construct
     * @covers System\Guid::__toString
     * @covers System\Guid::getHex
     * @covers System\Guid::getIsEmpty
     * @covers System\Guid::getRaw
     * @covers System\Guid::isEmpty
     * @covers System\Guid::newGuid
     * @covers System\Guid::tryParse
     */
    public function testGuid() {

        $guidInstance = Guid::newGuid();
        // Comprueba que tiene un valor correcto
        $this->assertFalse($guidInstance->getIsEmpty());
        $this->assertFalse(Guid::isEmpty($guidInstance));

        $guidCopy;
        Guid::tryParse($guidInstance, $guidCopy);
        // Comprueba la propiedad de copiarse mediante tryParse
        $this->assertEquals($guidInstance, $guidCopy);

        $guidAnotherCopy = new Guid($guidInstance);
        // Comprueba la propiedad de copiarse mediante el constructor
        $this->assertEquals($guidInstance, $guidAnotherCopy);

        $anotherGuid = Guid::newGuid();
        // Comprueba que se crean UUIDs diferentes para cada instancia
        $this->assertNotEquals($guidInstance, $anotherGuid);

        // Comprueba la longitud de salida de getRaw()
        $this->assertEquals(16, strlen($guidInstance->getRaw()));

        // Comprueba la longitud de salida de getHex()
        $this->assertEquals(32, strlen($guidInstance->getHex()));

        $guidString = 'F25D5A6C-A242-4CCB-A980-8DACC680F206';
        $guidHex = 'F25D5A6CA2424CCBA9808DACC680F206';
        $guidFromString = new Guid($guidString);
        $guidFromHex = new Guid($guidHex);
        // Comprueba el valor de Guid como string
        $this->assertEquals($guidString, (string)$guidFromString);
        $this->assertEquals($guidString, (string)$guidFromHex);
    }

    /**
     * Comprobamos que no se puede crear un Guid con un parametro q no sea un string o Guid
     * 
     * @covers System\Guid::__construct
     */
    public function testContructorException1() {
        require_once 'System/ArgumentOutOfRangeException.php';

        $this->expectException(ArgumentOutOfRangeException::class);
        new Guid(58);
    }

    /**
     * Comprobamos que el string debe ser una cadena hexadecimal
     * 
     * @covers System\Guid::__construct
     */
    public function testContructorException2() {
        require_once 'System/ArgumentOutOfRangeException.php';

        $guidString = 'f25d5a6c-a242-4ccb-a980-8dacc680f20jl';

        $this->expectException(ArgumentOutOfRangeException::class);
        new Guid($guidString);
    }

    /**
     * Comprobamos que el string debe tener la longitud correcta
     * 
     * @covers System\Guid::__construct
     */
    public function testContructorException3() {
        require_once 'System/ArgumentOutOfRangeException.php';

        $guidString = 'f25d5a6c-a242-4ccb-a980-8dacc680f206f';

        $this->expectException(ArgumentOutOfRangeException::class);
        new Guid($guidString);
    }

    /**
     * Comprobamos que el string debe tener la longitud correcta
     * 
     * @covers System\Guid::__construct
     */
    public function testContructorException4() {
        require_once 'System/ArgumentOutOfRangeException.php';

        $guidString = 'f25d5a6c-a242-4ccb-a980-8dacc680f20';

        $this->expectException(ArgumentOutOfRangeException::class);
        new Guid($guidString);
    }

}