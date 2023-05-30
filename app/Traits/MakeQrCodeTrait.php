<?php

namespace App\Traits;


use SimpleSoftwareIO\QrCode\Facades\QrCode;

trait MakeQrCodeTrait
{
  public function generateQrCode($user_name)
  {
    QrCode::format('png')
    ->size(399)
    ->margin(1)
    ->color(40,40,40)
    ->generate(env('APP_URL') . '/' . $user_name,'./img/qrcodes/'.$user_name.'.png');
  }
}
