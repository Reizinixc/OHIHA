<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;

class UserTest extends TestCase {

  public function testCreateUser() {
    /** @var User $user */
    $user = FactoryMuff::create("User");

    $this->assertNotNull($user->id);
    $this->assertNotNull($user->username);
    $this->assertNotNull($user->password);
    $this->assertNotNull($user->email);
    $this->assertNotNull($user->alt_email);
    $this->assertRegExp('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $user->created_at->toDateTimeString());
    $this->assertRegExp('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $user->updated_at->toDateTimeString());
    $this->assertNull($user->deleted_at);
  }
}