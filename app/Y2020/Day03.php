<?php
namespace App\Y2020;

class Day03
{
  private static function calcSlope($dposx, $dposy, $map)
  {
    $lines  = explode(PHP_EOL, $map);
    $found  = 0;
    $posx   = 0;

    for ($i = 0; $i < count($lines); $i += $dposy) {
      $found += intval($lines[$i][$posx % strlen($lines[$i])] == '#');
      $posx += $dposx;
    }

    return $found;
  }

  public static function A($input)
  {
    return self::calcSlope(3, 1, $input);
  }

  public static function B($input)
  {
    return (
      self::calcSlope(1, 1, $input) *
      self::calcSlope(3, 1, $input) *
      self::calcSlope(5, 1, $input) *
      self::calcSlope(7, 1, $input) *
      self::calcSlope(1, 2, $input)
    );
  }
}