<?php
namespace App\Y2020;

class Day02
{
  public static function A($input)
  {
    $lines = explode(PHP_EOL, $input);
    $found = 0;

    foreach ($lines as $line) {
      preg_match_all('/((\d\d|\d)|[a-z]?:|[a-zA-Z]+)/', $line, $matches);
      $count = substr_count($matches[0][3], rtrim($matches[0][2], ':'));
      $found += intval(
        $count >= (int)$matches[0][0] &&
        $count <= (int)$matches[0][1]
      );
    }

    return $found;
  }

  public static function B($input)
  {
    $lines = explode(PHP_EOL, $input);
    $found = 0;

    foreach ($lines as $line) {
      preg_match_all('/((\d\d|\d)|[a-z]?:|[a-zA-Z]+)/', $line, $matches);
      $A = $matches[0][3][(int)$matches[0][0]-1] === rtrim($matches[0][2], ':');
      $B = $matches[0][3][(int)$matches[0][1]-1] === rtrim($matches[0][2], ':');
      $found += intval($A xor $B);
    }

    return $found;
  }
}
