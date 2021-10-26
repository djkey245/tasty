<?php


namespace App\Helpers;


class FindTastyHelper
{
    public $searchStr = 'tasty-case.com';
    public function findTasty($string): bool
    {
        return preg_match('/'.$this->searchStr.'/', $string) === 1;
    }
}
