<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegister()
    {

        $headers = array(
            "Accept" => "application/json",
          );
      
        $response = $this->json('POST', '/api/user', [
            'name' => 'Sally',
            'password' => 'hisasas',
            'email' => 'guande@gmail.com'
        ],
        $headers
        );

        $response->assertResponseStatus(200);

        // $this->assertJsonStringEqualsJsonString($this->response->getContent(), json_encode([ 'created' => true]));
        $responseArray = json_decode($this->response->getContent());
        $this->assertEquals(true, $responseArray->created);
        echo $this->response->getContent();
        // $response->response->assertJsonFragment( [ 'created' => true]);
        // $response->assertJsonFragment( [ 'created' => true]);
        // $this->assertEquals(200, $this->response->status());
        
        // $response->seeJson([ 'created' => true]);
        // $response->assertJson( json_encode([ 'created' => true]), $response);
        // $response->assertStatus(200);
        //     ->assertJson([
        //         'created' => true,
        //     ]);

    }
}
