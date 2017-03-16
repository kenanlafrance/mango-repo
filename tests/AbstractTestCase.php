<?php

namespace LaraChimp\MangoRepo\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use LaraChimp\MangoRepo\MangoRepoServiceProvider;

abstract class AbstractTestCase extends TestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->createAppropriateTables();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->dropAllTables();
        parent::tearDown();
    }

    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app)
    {
        return [
            MangoRepoServiceProvider::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
    }

    /**
     * Create tables we need for our tests.
     *
     * @return void
     */
    protected function createAppropriateTables()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Remove tables after tests.
     *
     * @return void
     */
    protected function dropAllTables()
    {
        Schema::dropIfExists('users');
    }
}