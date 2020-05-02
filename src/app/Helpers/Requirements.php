<?php 
namespace DGvai\Larataller\Helpers;

class Requirements 
{
    public $phpVersion;
    public $phpExts;
    public $apacheMods;

    public function checkPHPversion($version)
    {
        $currentVersion = $this->getPhpVersionInfo();
        $supported = false;

        if (version_compare($currentVersion['version'], $version) >= 0) 
        {
            $supported = true;
        }

        $status = [
            'full' => $currentVersion['full'],
            'current' => $currentVersion['version'],
            'minimum' => $version,
            'supported' => $supported,
        ];

        return $status;
    }

    public function checkPHPExts(array $extensions)
    {
        $results = [];
        
        foreach($extensions as $ext)
        {
            array_push($results,['ext' => $ext, 'installed' => extension_loaded($ext)]);
        }

        return $results;
    }

    public function checkApacheMod(array $mods)
    {
        $results = [];

        if (function_exists('apache_get_modules')) 
        {
            foreach($mods as $mod)
            {
                array_push($results,['mod' => $mod, 'enabled' => in_array($mod, apache_get_modules())]);
            }
        }
        else
        {
            $results['error'] = true;
        }

        return $results;
    }

    public function validateSupport($phpVersion, $phpExts, $apacheMods)
    { 
        if(!$phpVersion['supported'])
        {
            return false;
        }

        foreach($phpExts as $ext)
        {
            if(!$ext['installed'])
            {
                return false;
            }
        }

        foreach($apacheMods as $mod)
        {
            if(!$mod['enabled'])
            {
                return false;
            }
        }

        return true;
    }

    public function checkSymLink()
    {
        if(config('larataller.symlink'))
        {
            return function_exists('symlink');
        }
    }

    private function getPhpVersionInfo()
    {
        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];

        return [
            'full' => $currentVersionFull,
            'version' => $currentVersion,
        ];
    }
}