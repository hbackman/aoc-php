<?php
namespace App\Y2020;

class Day14
{
  public static function A($input)
  {
    $input = explode(PHP_EOL, $input);

    $getBinaryString = function ($dec) {
      return str_pad(base_convert($dec, 10, 2), 36, '0', STR_PAD_LEFT);
    };

    $msk = '';
    $lst = $getBinaryString(0);
    $mem = [];

    foreach ($input as $instruction) {
      preg_match('/(mask|mem)+(\[\d+\])?\s\=\s+(.*)/', $instruction, $matches);

      // If we're applying a mask, then set the mask
      // and just continue with the next instruction.
      if ($matches[1] == 'mask') {
        $msk = $matches[3];
      }

      if ($matches[1] == 'mem') {
        $str = $getBinaryString($matches[3]);
        $pos = trim($matches[2], '[]');

        $mem[$pos] = $lst;

        for ($i = 0; $i < strlen($str); $i++) {
          $msk[$i] == 'X'
            ? $mem[$pos][$i] = $str[$i]
            : $mem[$pos][$i] = $msk[$i];
        }
      }
    }

    $sumFn = function ($carry, $value) {
      return $carry + base_convert($value, 2, 10);
    };

    return array_reduce($mem, $sumFn, 0);
  }

  public static function B($input)
  {
  }
}