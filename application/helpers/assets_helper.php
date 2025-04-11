<?php
if (!function_exists('asset_url')) {
    /**
     * Generate a URL for assets (CSS, JS, Images, etc.)
     *
     * @param string $path Path to the asset file
     * @return string Full URL to the asset
     */
    function asset_url($path = '')
    {
        return base_url('assets/' . ltrim($path, '/'));
    }
}
