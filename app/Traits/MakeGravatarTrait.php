<?php

namespace App\Traits;

trait MakeGravatarTrait
{
  public function makeGravatar()
  {
    $modes=[ 'blank', 'identicon', 'monsterid', 'mp', 'retro', 'robohash', 'wavatar',];
    
    return $modes[array_rand($modes)];

  }
}
