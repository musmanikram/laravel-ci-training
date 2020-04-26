<?php

namespace Tests\Feature;

use App\Tweet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
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
}
