<?php
namespace App\Y2020;

class Day04
{
  public static function A($input)
  {
    $input = explode(PHP_EOL.PHP_EOL, $input);
    $found = 0;

    foreach ($input as $passport) {
      $found += intval(self::hasExpectedFields($passport));
    }

    return $found;
  }

  public static function B($input)
  {
    $input = explode(PHP_EOL.PHP_EOL, $input);
    $found = 0;

    foreach ($input as $passport) {
      preg_match_all('/(\w{3}):([^\s]+)/', $passport, $matches);

      if ( ! self::hasExpectedFields($passport) ) {
        continue;
      }

      for ($i = 0; $i < count($matches[0]); $i++) {
        if ( ! self::isFieldValid($matches[1][$i], $matches[2][$i]) ) {
          continue 2;
        }
      }

      $found++;
    }

    return $found;
  }

  private static function isFieldValid($field, $value)
  {
    echo $field . ':' . $value . PHP_EOL;
    switch ($field) {
      case 'byr': return $value >= 1920 && $value <= 2002;
      case 'iyr': return $value >= 2010 && $value <= 2020;
      case 'eyr': return $value >= 2020 && $value <= 2030;
      case 'hgt': {
        preg_match('/(\d+)(cm|in)/', $value, $matches);

        if ($matches[2] == 'cm') {
          return $matches[1] >= 150 && $matches[1] <= 193;
        }
        if ($matches[2] == 'in') {
          return $matches[1] >= 59 && $matches[1] <= 76;
        }

        return false;
      }
      case 'hcl': return preg_match('/^(#[0-9a-f]{6})$/', $value);
      case 'pid': return preg_match('/^[0-9]{9}$/', $value);
      case 'ecl': return in_array($value, [ 'amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth' ]);
    }
    return true;
  }

  private static function hasExpectedFields($string)
  {
    $expectedFields = [
      'byr', 'iyr', 'eyr',
      'hgt', 'hcl', 'ecl',
      'pid', // 'cid',
    ];

    foreach ($expectedFields as $field) {
      if ( strpos($string, $field) === false ) {
        return false;
      }
    }
    return true;
  }
}