<?php

use App\Models\Setting;

if (!function_exists('getSetting')) {
    /**
     * Fetch the setting with the given ID (default is ID 1).
     *
     * @return \App\Models\Setting|null
     */
    function getSetting()
    {
        return Setting::where('id', 1)->first();
    }
}
