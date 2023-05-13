<?php

namespace Clouds\HTML\Components\Card;

class PercentageRateCard
{
    public static function render(
        string $title,
        float $percentage,
        float $old_value,
        float $new_value,
        bool $inverse = false,
        string $color = 'green',
        string $icon = 'radio_button_unchecked'
    ): string {
        $percentage_span = self::buildPercentageSpan($percentage, $inverse);
        $value = self::buildValueDiv($old_value, $new_value);

        return <<<HTML
        <div class="dashboard-group flex-column gap-medium w-100 p-lg" style="justify-content: space-between">
            <div style="display: flex; width: 100%; justify-content: space-between">
                <div class="icon icon-$color">
                    <span class="material-symbols-rounded">$icon</span>
                </div>
            </div>
            <div class="flex-column gap-small">
                $value
                <div class="flex" style="justify-content: space-between; align-items: center">
                    <span style="color: var(--lighter-grey); font-weight: bold">$title</span>
                    $percentage_span
                </div>
            </div>
        </div>
        HTML;
    }

    private static function buildPercentageSpan(float $percentage, bool $inverse): string
    {
        $percentage = $inverse
            ? $percentage * -1
            : $percentage;

        if ($percentage > 0) {
            return <<<HTML
            <span class="p-xs br-sm" style="background-color: rgba(0,100,0,0.25); font-size: 0.75rem ; font-weight: bold; color: mediumseagreen">
                +$percentage%
            </span>
            HTML;
        } else {
            return <<<HTML
            <span class="p-xs br-sm" style="background-color: rgba(100,0,0,0.25); font-size: 0.75rem ; font-weight: bold; color: indianred">
                $percentage%
            </span>
            HTML;
        }
    }

    private static function buildValueDiv($old_value, $new_value)
    {
        return <<<HTML
        <div style="font-size: var(--big-font)">
            <b>$new_value</b><span style="font-size: var(--small-font); color: var(--lighter-grey)"> ($old_value)</span>
        </div>
        HTML;

    }
}