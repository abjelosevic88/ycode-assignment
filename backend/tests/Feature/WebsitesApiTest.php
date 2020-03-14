<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Website;
use Mockery;

class WebsitesApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check success response.
     *
     * @return void
     */
    public function testSuccessResponseFromGetAllWebsites()
    {
        factory(Website::class, 10)->create();

        $response = $this->get('/api/websites?limit=5&offset=0');

        $response->assertStatus(200);
        $response->assertJson([ 'message' => 'Websites successfully found.' ]);
        $response->assertJsonCount(5, 'data.websites');
    }

    /**
     * Check not found response.
     *
     * @return void
     */
    public function testNotFoundResponseFromGetAllWebsites()
    {
        $response = $this->get('/api/websites?limit=5&offset=0');

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Websites not found.',
            'data' => [
                'total' => 0,
                'websites' => []
            ]
        ]);
    }

    /**
     * Check if website was created successfuly with valid data.
     *
     * @return void
     */
    public function testSuccessfulyCreationOfTheWebsite()
    {
        $response = $this->post('/api/websites', [
            'name' => 'Testing Name',
            'url' => 'http://test.com'
        ]);

        $response->assertStatus(200);

        $website = Website::whereName('Testing Name')->whereUrl('http://test.com')->first();
        $this->assertNotNull($website);

        $response->assertJson([
            'message' => 'Website successfully created.',
            'data' => $website->toArray()
        ]);
    }

    /**
     * Check if website return an error string if params are invalid or missing.
     *
     * @return void
     */
    public function testMissingParamsCreationOfTheWebsite()
    {
        // Name missing
        $response = $this->post('/api/websites', [
            'url' => 'http://test.com'
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'errors' => [
                'name' => [
                    'The name field is required.'
                ]
            ]
        ]);

        // URL missing
        $response = $this->post('/api/websites', [
            'name' => 'Testing name.'
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'errors' => [
                'url' => [
                    'The url field is required.'
                ]
            ]
        ]);

        // URL format error
        $response = $this->post('/api/websites', [
            'name' => 'Testing name.',
            'url' => 'bad-url'
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'errors' => [
                'url' => [
                    'The url format is invalid.'
                ]
            ]
        ]);

        // URL already exists in the dabatase
        factory(Website::class)->create([
            'url' => 'http://test.test'
        ]);
        $response = $this->post('/api/websites', [
            'name' => 'Testing name.',
            'url' => 'http://test.test'
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'errors' => [
                'url' => [
                    'The url has already been taken.'
                ]
            ]
        ]);
    }

    /**
     * Check if website search returns not found on zero results.
     *
     * @return void
     */
    public function testIsSearchReturnsNonFoundOnZeroResults()
    {
        $response = $this->get('/api/websites/search?query=test');

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Websites not found.',
            'data' => []
        ]);
    }

    /**
     * Check if website search returns correct number of results.
     *
     * @return void
     */
    public function testIsSearchReturnsCorrectNumberOfResults()
    {
        factory(Website::class, 10)->create([ 'name' => 'testing' ]);
        factory(Website::class, 7)->create([ 'name' => 'not' ]);

        $response = $this->get('/api/websites/search?query=test');
        $response->assertStatus(200);
        $response->assertJson([ 'message' => 'Websites successfully found.' ]);
        $response->assertJsonCount(10, 'data.websites');

        $response = $this->get('/api/websites/search?query=not');
        $response->assertStatus(200);
        $response->assertJson([ 'message' => 'Websites successfully found.' ]);
        $response->assertJsonCount(7, 'data.websites');
    }
}
