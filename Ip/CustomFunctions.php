<?php
function maskNumber($number, $decimals = 0, $prefix = '', $suffix = '')
{
    return $prefix.number_format($number, $decimals, ',', '.').$suffix;
}

function fromNow(\Carbon\Carbon $date)
{
    $now = \Carbon\Carbon::create();

    return $date->diffForHumans();
}

function ipAdminThemeUrl($path)
{
    return ipConfig()->baseUrl().'ThemeAdmin/'.ipConfig()->get('adminTheme').$path;
}

/**
 * Gets the file path of the current theme folder
 *
 * @param string $path A path or a pathname relative to Theme/ directory.
 *
 * @return mixed|string Absolute path or pathname.
 */
function ipAdminThemeFile($path)
{
    return ipFile( 'ThemeAdmin/' . ipConfig()->get('adminTheme') . '/' . $path );
}