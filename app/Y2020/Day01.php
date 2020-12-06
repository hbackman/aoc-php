<?php
namespace App\Y2020;

class Day01
{
  public static function A($input)
  {
    $lines = explode(PHP_EOL, $input);

    while (count($lines) > 0) {
      $curLine = array_shift($lines);

      foreach ($lines as $cmpLine) {
        // Check if the current line multiplied by every
        // other line in the set equals 2020
        if ((int)$curLine + (int)$cmpLine == 2020) {
          return (int)$curLine * (int)$cmpLine;
        }
      }
    }
  }

  public static function B($input)
  {
    $lines = explode(PHP_EOL, $input);

    foreach ($lines as $lineA) {
      $lineA = (int) $lineA;

      foreach ($lines as $lineB) {
        $lineB = (int) $lineB;

        foreach ($lines as $lineC) {
          $lineC = (int) $lineC;

          if ($lineA + $lineB + $lineC == 2020) {
            return $lineA * $lineB * $lineC;
          }
        }
      }
    }
  }
}
