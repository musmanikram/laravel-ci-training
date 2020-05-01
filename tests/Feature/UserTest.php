<?php

namespace Tests\Feature;

use App\Tweet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        //$this->withoutExceptionHandling();

        $this->user = factory(User::class)->create();
    }

    public function testUserHasManyTweets()
    {
        /* @var Tweet */
        $tweets = factory(Tweet::class, 2)->create([
            'user_id' => $this->user->id
        ]);

        $this->assertCount(2, $this->user->tweets);
        $this->assertEquals($tweets[0]->body, $this->user->tweets[0]->body);
        $this->assertEquals($tweets[1]->body, $this->user->tweets[1]->body);
    }

    public function testUserCanFollowOtherUsers()
    {
        /* @var User */
        $friend = factory(User::class)->create();
        $this->user->follow($friend);

        $this->assertCount(1, $this->user->follows);
        $this->assertEquals($friend->id, $this->user->follows[0]->id);
        $this->assertEquals($friend->name, $this->user->follows[0]->name);
    }

    public function testTimelineReturnsOwnTweets()
    {
        $tweet = factory(Tweet::class)->create([
            'user_id' => $this->user->id
        ]);

        $this->assertCount(1, $this->user->timeline());
        $this->assertEquals($tweet->id, $this->user->timeline()[0]->id);
        $this->assertEquals($tweet->body, $this->user->timeline()[0]->body);
    }

    public function testTimelineReturnsFriendsTweets()
    {
        /* @var User */
        $friend = factory(User::class)->create();
        $this->user->follow($friend);

        $tweet = factory(Tweet::class)->create([
            'user_id' => $friend->id
        ]);

        $this->assertCount(1, $this->user->timeline());
        $this->assertEquals($tweet->id, $this->user->timeline()[0]->id);
        $this->assertEquals($tweet->body, $this->user->timeline()[0]->body);
        $this->assertEquals($tweet->user_id, $friend->id);
    }

    public function testTimelineReturnsOwnAndFriendsTweets()
    {
        /* @var User */
        $friend = factory(User::class)->create();
        $this->user->follow($friend);

        $friendTweet = factory(Tweet::class)->create([
            'user_id' => $friend->id,
            'created_at' => date('Y-m-d H:i:s', (time() - 60 * 15))
        ]);

        $ownTweet = factory(Tweet::class)->create([
            'user_id' => $this->user->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $this->assertCount(2, $this->user->timeline());
        $this->assertEquals($ownTweet->id, $this->user->timeline()[0]->id);
        $this->assertEquals($friendTweet->id, $this->user->timeline()[1]->id);
        $this->assertEquals($ownTweet->body, $this->user->timeline()[0]->body);
        $this->assertEquals($friendTweet->body, $this->user->timeline()[1]->body);
    }

    public function testUserCanUpdateProfileSuccessfully()
    {
        Storage::fake('public');

        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($this->user)
            ->json('patch', $this->user->path(), [
            'username' => 'newusername',
            'avatar' => $avatar,
            'name' => 'new name',
            'email' => 'newemail@example.com',
            'password' => '123456789',
            'password_confirmation' => '123456789',
        ]);

        Storage::disk('public')->assertExists('avatars/' . $avatar->hashName());
        Storage::disk('public')->delete('avatars/' . $avatar->hashName());
        $response->assertSessionHasNoErrors();
    }

    /**
     * @dataProvider profileDataForErrors
     * @param array $userInfo
     * @param string $error
     */
    public function testUserGetErrorsWhileUpdatingProfile(array $userInfo, string $error, string $errorFieldName)
    {
        Storage::fake('public');

        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($this->user)
            ->patch($this->user->path(), [
                'username' => $userInfo['username'],
                'avatar' => $avatar,
                'name' => $userInfo['name'],
                'email' => $userInfo['email'],
                'password' => $userInfo['password'],
                'password_confirmation' => $userInfo['password_confirmation']
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors($errorFieldName);
        $response->assertSessionHasErrors([
            $errorFieldName => $error
        ]);
    }

    public function profileDataForErrors(): array
    {
        //TODO: Test for email, password and avatar
        return [
            [
                'userInfo' => [
                    'username' => '',
                    'name' => 'new name',
                    'email' => 'newemail@example.com',
                    'password' => '123456789',
                    'password_confirmation' => '123456789'
                ],
                'error' => 'The username field is required.',
                'errorFieldName' => 'username'
            ],
            [
                'userInfo' => [
                    'username' => 'newusername',
                    'name' => '',
                    'email' => 'newemail@example.com',
                    'password' => '123456789',
                    'password_confirmation' => '123456789'
                ],
                'error' => 'The name field is required.',
                'errorFieldName' => 'name'
            ]
        ];
    }
}
