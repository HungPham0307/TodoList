<?php


use PHPUnit\Framework\TestCase;

require './app/config/config.php';

final class WorkTest extends TestCase
{
    public $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = new \GuzzleHttp\Client([
            'http_errors' => false,
            'debug' => false,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function testCreateWorkSuccess()
    {
        $option['form_params'] = [
            'title' => 'UnitTest',
            'start' => '2021-10-23',
            'end' => '2021-10-24',
            'status' => 1,
            'user_id' => 1,
        ];

        $this->client->post(APP_URL . '/work/create', $option);

        $this->assertTrue(true);
    }

    public function testCreateWorkErrorsWithDateInvalid()
    {
        $option['form_params'] = [
            'title' => 'UnitTest',
            'start' => 'aaaa21-10-23',
            'end' => '2021-10-24',
            'status' => 1,
            'user_id' => 1,
        ];

        $this->client->post(APP_URL . '/work/create', $option);

        $this->assertTrue(false);
    }

    public function testEditWorkErrorWithNoId()
    {
        $option['form_params'] = [
            'titles' => 'UnitTest',
            'start' => 'aaaa21-10-23',
            'end' => '2021-10-24',
            'status' => 1,
            'user_id' => 1,
        ];

        $this->client->post(APP_URL . '/work/update', $option);

        $this->assertTrue(false);
    }

    public function testDeleteWorkErrorWithIdInvalid()
    {
        $option['form_params'] = [
            'id' => '12321321312312312312'
        ];

        $this->client->post(APP_URL . '/work/delete', $option);

        $this->assertTrue(false);
    }
}
