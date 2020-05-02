<?php 
namespace DGvai\Larataller\Helpers;

class Environment
{
    public static function save(array $data)
    {
        if (count($data) > 0) 
        {
            $env = file_get_contents(base_path().'/.env');
            $env = preg_split('/(\r\n|\n|\r)/', $env);

            foreach((array) $data as $key => $value) 
            {
                foreach($env as $env_key => $env_value) 
                {
                    $entry = explode("=", $env_value, 2);

                    if ($entry[0] == $key) 
                    {
                        $env[$env_key] = $key."=\"".$value."\"";
                    } else 
                    {
                        $env[$env_key] = $env_value;
                    }
                }
            }

            $env = implode("\n", $env);
            file_put_contents(base_path().'/.env', $env);
            return true;
        } 
        else 
        {
            return false;
        }
    }

    public static function append($key,$value)
    {
        $env = file_get_contents(base_path().'/.env');
        $env = preg_split('/(\r\n|\n|\r)/', $env);
        $appended = false;

        foreach($env as $env_key => $env_value) 
        {
            $entry = explode("=", $env_value, 2);

            if ($entry[0] == $key) 
            {
                $appended = true;
                $env[$env_key] = $key."=\"".$value."\"";
            } 
            else 
            {
                $env[$env_key] = $env_value;
            }
        }

        if(!$appended)
        {
            array_push($env,$key."=\"".$value."\"");
        }

        $env = implode("\n", $env);
        file_put_contents(base_path().'/.env', $env);
        return true;
    }

    public static function pull($key)
    {
        $env = file_get_contents(base_path().'/.env');
        $env = preg_split('/(\r\n|\n|\r)/', $env);

        foreach($env as $env_key => $env_value)
        {
            $entry = explode("=", $env_value, 2);
            if ($entry[0] == $key) 
            {
                return trim($entry[1],'\"');
            }
        }
    }
}