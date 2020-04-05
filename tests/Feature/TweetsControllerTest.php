<?php

namespace Tests\Feature;

use App\Tweet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TweetsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        //$this->withoutExceptionHandling();

        $this->user = factory(User::class)->create();
        Auth::loginUsingId($this->user->id);
    }

    public function testTweetPostShouldSuccessfullyInsertRecordIntoDatabase()
    {
        $tweetBody = 'Test tweet!';

        $this->post('/tweets', [
            'body' => $tweetBody
        ]);

        $tweets = Tweet::where('user_id', $this->user->id)->latest()->limit(1)->get();

        $this->assertEquals(1, Tweet::all()->count());
        $this->assertEquals($tweetBody, $tweets[0] ->body);
    }

    /**
     * @dataProvider tweetsDataForErrors
     * @param string $tweet
     * @param string $errorMessage
     */
    public function testTweetPostShouldReturnRequiredError(string $tweet, string $errorMessage)
    {
        $response = $this->post('/tweets', [
            'body' => $tweet
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'body' => $errorMessage
        ]);

        $response->assertSessionHasErrors('body');
    }

    public function tweetsDataForErrors(): array
    {
        return [
            [
                'tweet' => '',
                'errorMessage' => 'The body field is required.'
            ],
            [
                'tweet' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus urna ut ante rhoncus convallis. Donec congue justo nec risus maximus egestas. Cras vulputate dictum nisi, vel venenatis ante. Nam at vulputate leo. Nunc ante velit, mollis et arcu quis, tempus ultricies leo. Donec non aliquet leo',
                'errorMessage' => 'The body may not be greater than 255 characters.'
            ]
        ];
    }
}
