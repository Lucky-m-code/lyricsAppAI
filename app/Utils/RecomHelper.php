<?php

namespace App\Utiils;
use App\Models\User;
use Laracombee;

class RecomHelper {
  // Hold the class instance.
  private static $instance = null;

  // The constructor is private
  // to prevent initiation with outer code.
  private function __construct()
  {
    // The expensive process (e.g.,db connection) goes here.
  }

  // The object is created from within the class itself
  // only if the class has no instance.
  public static function getInstance()
  {
    if (self::$instance == null)
    {
      self::$instance = new RecomHelper();
    }

    return self::$instance;
  }

  public function addUser($user){

    $addUser = Laracombee::addUser($user);

    Laracombee::send($addUser)->then(function () {
        // Success.
    })->otherWise(function ($error) {
        // Handle Exeption.
    })->wait();
  }
  public function addItem($item){
    $addUser = Laracombee::addItem($item);

    Laracombee::send($addUser)->then(function () {
        // Success.
    })->otherWise(function ($error) {
        // Handle Exeption.
    })->wait();
  }
  public function addUserView($uesr_id,$id){
    Laracombee::addDetailView($uesr_id, $id);
  }
  public function getRecomForUser($user){
    $user = User::findOrFail(60);
    $lyrics = array();
    // Prepare the request for recombee server, we need 10 recommended items for a given user.
    $recommendations = Laracombee::recommendTo($user, 10)->wait();
    return $recommendations;
  }
}

