<?php

namespace App\Traits;

trait NotificaTrait
{
    public function notifica(string $message, string $style)
    {
        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', $style);
    }
}
