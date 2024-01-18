<?php

namespace Tests\Unit;
use App\Http\Controllers\AuthController;

use App\Models\User;
use App\Services\AuthService;
use App\Services\MessageService;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;


class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $pathPayload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(MessageService::class, Mockery::mock(MessageService::class));
        $this->app->instance(ReviewService::class, Mockery::mock(ReviewService::class));
        $this->app->instance(AuthService::class, Mockery::mock(AuthService::class));
        $this->pathPayload = $this->app->basePath('tests/Unit/Payloads/');
    }
    public function testAuthCreateSuccess()
    {
        $authServiceMock = Mockery::mock(AuthService::class);
        $authServiceMock->shouldReceive('create')->withAnyArgs()->andReturn(true);

        $requestData = file_get_contents( $this->pathPayload . 'auth_user.json');
        $requestDataArray = json_decode($requestData, true);

        $request = new Request($requestDataArray);
        $requestMock = Mockery::mock(Request::class);
        $requestMock->shouldReceive('all')->andReturn($requestData);

        $messageServiceMock = Mockery::mock(MessageService::class);
        $reviewServiceMock = Mockery::mock(ReviewService::class);

        $authController = new AuthController($authServiceMock, $messageServiceMock, $reviewServiceMock);
        $response = $authController->authcreate($request);

        $this->assertTrue($response->isRedirect());
        $this->assertEquals(route('userProfile', ['name' => 'Paulo']), $response->headers->get('Location'));
    }

    public function testAuthenticatingUser()
    {
        $userMock = Mockery::mock(User::class);
        $userMock->shouldReceive('create')->withAnyArgs()->andReturn($userMock);

        $this->actingAs($userMock);

        $authData = file_get_contents($this->pathPayload . 'auth_user.json');
        $authDataArray = json_decode($authData, true);

        $response = $this->post('/login', $authDataArray);
        $messageServiceMock = Mockery::mock(MessageService::class);
        $messageServiceMock->shouldReceive('messageLogininvalidUser');
        $response->assertStatus(500);

    }
}