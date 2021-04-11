<?php
/**
 * Comprueba el funcionamiento de las funciones de System\String
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 7 >= 7.3
 */
namespace test\System;

use PHPUnit\Framework\TestCase;
use function System\String\isNullOrEmpty as StringIsNullOrEmpty;
use function System\String\slugify as StringSlugify;
use function System\String\startWith as StringStartWith;

/**
 * Comprueba el funcionamiento de las funciones de System\String
 */
class StringTest extends TestCase {

    /**
     * Comprueba el funcionamiento de la función startWith
     */
    public function testStartWith(){
        require_once 'System/String/startWith.php';

        $string1 = "Prueba";
        $string2 = "PruebaMasGrande";
        $string3 = "OtraPrueba";
        $string4 = "pruebamasgrande";

        // Comprobación entre la misma cadena
        $this->assertTrue(StringStartWith($string2, $string2));

        // Comprobación entre cadenas que empiezan igual
        $this->assertTrue(StringStartWith($string2, $string1));
        $this->assertTrue(StringStartWith($string2, $string1, true));

        // Comprobación entre cadenas que empiezan igual, pero con diferencias entre minusculas y mayusculas
        $this->assertFalse(StringStartWith($string4, $string1));
        $this->assertTrue(StringStartWith($string4, $string1, true));
        $this->assertFalse(StringStartWith($string4, $string2));
        $this->assertTrue(StringStartWith($string4, $string2, true));

        // Comprobación entre cadenas que empiezan diferente
        $this->assertFalse(StringStartWith($string1, $string2));
        $this->assertFalse(StringStartWith($string1, $string2, true));
        $this->assertFalse(StringStartWith($string2, $string3));
        $this->assertFalse(StringStartWith($string2, $string3, true));
    }

    public function testSlugify() {
        require_once 'System/String/slugify.php';

        $string1 = "Título con espacios";
        $string2 = "titulo-con-espacios";
        
        $this->assertEquals(StringSlugify($string1), $string2);

    }

    public function testIsNullOrEmpty() {
        require_once 'System/String/isNullOrEmpty.php';

        $emptyString    = '';
        $spacesString   = '  ';
        $nonEmptyString = 'foo';
        $nonString      = 5;

        $this->assertTrue(StringIsNullOrEmpty(null));
        $this->assertTrue(StringIsNullOrEmpty($emptyString));
        $this->assertTrue(StringIsNullOrEmpty($spacesString));
        $this->assertFalse(StringIsNullOrEmpty($nonEmptyString));
        $this->assertFalse(StringIsNullOrEmpty($nonString));
    }

}