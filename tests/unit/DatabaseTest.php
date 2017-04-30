<?php

use PHPUnit\Framework\TestCase;

use gpgl\core\Database;

class DatabaseTest extends TestCase
{
    protected $filename = __DIR__.'/../data/.gpgldb';
    protected $database;
    protected $key = 'jeff@example.com';
    protected $password = 'password';

    protected function setUp()
    {
        $this->filename = getenv('GPGL_DB');
        $this->database = file_get_contents($this->filename);
    }

    protected function tearDown()
    {
        file_put_contents($this->filename, $this->database);
    }

    public function test_creates_database()
    {
        $db = new Database($this->filename, $this->key, $this->password);

        $this->assertInstanceOf(Database::class, $db);
    }

    public function test_gets_index()
    {
        $expected = [
            'first',
            'second',
        ];

        $db = new Database($this->filename, $this->key, $this->password);
        $actual = $db->index();

        $this->assertEquals($expected, $actual);
    }

    public function test_gets_index_from_filename_env()
    {
        $expected = [
            'first',
            'second',
        ];

        $db = new Database($filename = null, $this->key, $this->password);
        $actual = $db->index();

        $this->assertEquals($expected, $actual);
    }

    public function test_gets_value()
    {
        $expected = [
            "username" => "jeff",
            "password" => "pass",
        ];

        $db = new Database($this->filename, $this->key, $this->password);
        $actual = $db->get('first');

        $this->assertEquals($expected, $actual);
    }

    public function test_sets_value()
    {
        $expected = [
            "username" => "jose",
            "password" => "word",
        ];

        $db = new Database($this->filename, $this->key, $this->password);
        $empty = $db->get('test_sets_key');
        $this->assertEmpty($empty);

        $this->assertTrue($db->set('test_sets_key', $expected));
        $actual = $db->get('test_sets_key');

        $this->assertEquals($expected, $actual);
    }

    public function test_saves_database_to_file()
    {
        $expected = [
            "username" => "jose",
            "password" => "word",
        ];

        $orig = new Database($this->filename, $this->key, $this->password);
        $empty = $orig->get('test_saves_db');
        $this->assertEmpty($empty);
        $orig->set('test_saves_db', $expected);

        $this->assertTrue($orig->export());
        $new = new Database($this->filename, $this->key, $this->password);
        $actual = $new->get('test_saves_db');

        $this->assertEquals($expected, $actual);
    }
}
