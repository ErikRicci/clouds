<?php

namespace Clouds\HTML\Components\Header;

class Header
{
    public static function render()
    {
        return <<<HTML
        <div class="header">
            <div class="active">HOME</div>
            <div>MANAGE</div>
        </div>
        HTML;
    }
}