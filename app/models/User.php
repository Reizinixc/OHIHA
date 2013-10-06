<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\UserInterface;

/**
 * An Eloquent Model: 'User'
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $alt_email
 * @property string $password
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class User extends Eloquent implements UserInterface, RemindableInterface {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = ['password'];

  /**
   * @inheritdoc
   */
  protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

  /**
   * @inheritdoc
   */
  protected $softDelete = true;

  /**
   * Validation rules
   *
   * @var Array
   */
  public static $rules = [
    'id'        => ['numeric', 'min:1'],
    'username'  => ['required', 'between:4,16', 'alpha_num', "unique:users,username"],
    'password'  => ['required', 'confirmed'],
    'email'     => ['required', 'email', 'unique:users,email', 'unique:users,alt_email'],
    'alt_email' => ['email', 'unique:users,email', 'unique:users,alt_email'],
  ];

  /**
   * Array for Object Factory
   *
   * @var array
   */
  public static $factory = [
    'username'  => 'string',
    'password'  => 'password',
    'email'     => 'email',
    'alt_email' => 'email',
  ];

  /**
   * Get the unique identifier for the user.
   *
   * @return mixed
   */
  public function getAuthIdentifier() {
    return $this->getKey();
  }

  /**
   * Get the password for the user.
   *
   * @return string
   */
  public function getAuthPassword() {
    return $this->password;
  }

  /**
   * Get the e-mail address where password reminders are sent.
   *
   * @return string
   */
  public function getReminderEmail() {
    return $this->email;
  }

}