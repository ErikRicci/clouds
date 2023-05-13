<?php

namespace Clouds\HTML\Components\Card;

class Card
{
    public static function render(
        string $title,
        float $value,
        string $color = 'green',
        string $icon = 'radio_button_unchecked'
    ): string {
        $value = self::buildValueDiv($value);

        return <<<HTML
        <div class="dashboard-group flex-column gap-medium w-100 p-lg" style="justify-content: space-between">
            <div style="display: flex; width: 100%; justify-content: space-between">
                <div class="icon icon-$color">
                    <span class="material-symbols-rounded">$icon</span>
                </div>
            </div>
            <div class="flex-column gap-small">
                $value
                <span style="color: var(--lighter-grey); font-weight: bold">$title</span>
            </div>
        </div>
        HTML;
    }

    private static function buildValueDiv($value)
    {
        return <<<HTML
        <div style="font-size: var(--big-font)">
            <b>$value</b>
        </div>
        HTML;

    }
}