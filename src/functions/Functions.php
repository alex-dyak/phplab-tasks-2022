<?php
/**
 * Create the next tests in tests folder for next methods:
 * sayHello(), sayHelloArgument(), sayHelloArgumentWrapper(), countArguments(), countArgumentsWrapper().
 * Test should be placed in folder tests.
 * The name should start with capital letter and end with the word Test.
 * (Example: SayHelloTest.php)
 * See details below.
 *
 * Note: In Test don't forget to implement setUp() function for creating Function Class object and write it to the variable
 * to use this object in the test.
 * (For example: variable - $functions)
 *
 * Note: Don't forget to write PHPDoc's, Type hint's and DataProvider's for test.
 *
 * Note: For writing tests try to use PHPUnit Manual:
 * https://phpunit.readthedocs.io/en/9.5/index.html
 */

namespace functions;

class Functions
{
    /**
     * Create a PhpUnit test (SayHelloTest) which will check that function below returns a correct result
     * i.e. returns 'Hello'
     *
     * @return string
     */
    public function sayHello(): string
    {
        return 'Hello';
    }

    /**
     * Create a PhpUnit test (SayHelloArgumentTest) which will check that function below returns a correct result
     * Check how it works with: number, string, bool value
     *
     * @param $arg
     * @return string
     */
    public function sayHelloArgument($arg): string
    {
        return "Hello $arg";
    }

    /**
     * What can be put instead of placeholder
     * so that function throws an InvalidArgumentException if $arg is not: number, string or bool
     *
     * Create a PhpUnit test (SayHelloArgumentWrapperTest) which will check this behavior
     * !!! you need to test only exceptional case, since the behavior of sayHelloArgument was already tested in the task above
     *
     * @param $arg
     * @return string
     * @throws \InvalidArgumentException
     */
    public function sayHelloArgumentWrapper($arg): string
    {
        // put your code here

        return $this->sayHelloArgument($arg);
    }

    /**
     * Create a PhpUnit test (CountArgumentsTest) which will check that function below returns correct result
     * Check how it works with: no arguments, one string argument, a couple of string arguments
     *
     * @return array
     */
    public function countArguments(): array
    {
        return [
            'argument_count' => func_num_args(),
            'argument_values' => func_get_args(),
        ];
    }

    /**
     * Fulfill a function countArgumentsWrapper so that it will call the original function (countArguments)
     * but check if all arguments are strings and throws an InvalidArgumentException otherwise
     *
     * Create a PhpUnit test (CountArgumentsWrapperTest) which will check this behavior
     * !!! you need to test only exceptional case, since the behavior of countArguments was already tested in the task above
     *
     * You will need to use "Argument unpacking via ..." to pass the parameters to wrapped function:
     * @see https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.splat
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function countArgumentsWrapper(): array
    {
        // put your code here
    }
}