<?php
namespace App\Y2020;

class Day07
{
  private static function getDictionary(array $input)
  {
    $dict = [];

    foreach ($input as $rule) {
      preg_match    ('/(.*) bags contain/', $rule,    $bagContainer);
      preg_match_all('/(\d+) (\w+ \w+) bag/', $rule,  $bagContents);

      $dict[$bagContainer[1]] = [];

      for ($i = 0; $i < count($bagContents[0]); $i++) {
        $dict[$bagContainer[1]][$bagContents[2][$i]] = (int)$bagContents[1][$i];
      }
    }

    return $dict;
  }

  public static function A($input)
  {
    $input = explode(PHP_EOL, $input);

    $dict = self::getDictionary($input);
    $bags = [];

    $search = function ($bag) use ( &$search, &$bags, $dict ) {
      foreach ($dict as $container => $contents) {
        if (in_array($bag, array_keys($contents))) {
          $bags[] = $container;
          $search($container);
        }
      }
    };

    $search('shiny gold');

    $bags = array_unique($bags);
    $bags = count($bags);

    return $bags;
  }

  public static function B($input)
  {
    $input = explode(PHP_EOL, $input);
    $dict  = self::getDictionary($input);

    $search = function ($bag) use ( &$search, $dict ) {
      foreach ($dict[$bag] as $b => $c) {
        $count = $count ?? 0;
        $count += $c * $search($b);
      }
      return ($count ?? 0) + 1;
    };

    return $search('shiny gold') - 1;
  }
}