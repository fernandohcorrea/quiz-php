<?php
/**
 * MODELO
 *
 * return array(
 *      array( 
 *          'question' => 'Avalie e identifique no código abaixo todos os padrões de projeto:',
 *          'file_code_sample' => __DIR__.DIRECTORY_SEPARATOR.'CodeSample.php',
 *          'multiple_choices' => array(
 *              0 => 'AAAaa',
 *              1 => 'AAAaa',
 *              2 => 'AAAaa',
 *              4 => 'AAAaa',
 *              5 => 'AAAaa'
 *          ),
 *          'answer' => array(2)
 *      ),
 * );
 */

return array(
    
    array(
        'question' => 'Operators: Choose a correct precedence order of operators below?',
        'file_code_sample' => __DIR__.DIRECTORY_SEPARATOR.'operators.php',
        'multiple_choices' => array(
               0 => '&&, and, or, ||, xor',
               1 => '&&, and, xor, or, ||',
               2 => '&&, ||, and, xor, or',
               3 => '||, or, &&, and, xor',
               4 => 'or, ||, xor, and, &&',
        ),
        'answer' => array(2)
    ),
    
    array(
        'question' => 'Operators bit :What is the output of the code below?',
        'file_code_sample' => __DIR__.DIRECTORY_SEPARATOR.'operators_bit.php',
        'multiple_choices' => array(
               0 => 'a',
               1 => 'b',
               2 => 'c',
               3 => 'd',
               4 => 'e',
        ),
        'answer' => array(2)
    ),
    
    array(
        'question' => 'Select all predefined variables below:(choose 4)',
        'multiple_choices' => array(
               0 => '$GLOBALS',
               1 => '__CLASS__',
               2 => '$_SERVER',
               3 => '__DIR__',
               4 => '$_POST',
               5 => '__FILE__',
               6 => '$_ENV',
        ),
        'answer' => array(0,2,4,6)
    ),
    
    array(
        'question' => 'Operators bit :What is the output of the code below?',
        'file_code_sample' => __DIR__.DIRECTORY_SEPARATOR.'control_function.php',
        'multiple_choices' => array(
               0 => 'AB',
               1 => 'A1B2C3',
               2 => 'ABC1ABC',
               3 => 'AB1AB2AB3',
               4 => 'AB123AB123',
        ),
        'answer' => array(3)
    ),
    
    array(
        'question' => 'Which are languages constructors of below alternatives are valid?',
        'multiple_choices' => array(
               0 => 'exit',
               1 => 'empty',
               2 => 'list',
               3 => 'die',
               4 => 'isset',
        ),
        'answer' => array(0,1,2,3,4)
    ),
    
    array(
        'question' => 'What is the output of the following?',
        'file_code_sample' => __DIR__.DIRECTORY_SEPARATOR.'ond_do_each.php',
        'multiple_choices' => array(
               0 => '///0',
               1 => 'parse error',
               2 => '/////',
               3 => '////',
               4 => '///',
        ),
        'answer' => array(1)
    ),
);