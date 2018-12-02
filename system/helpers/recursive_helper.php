<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('remove_directory'))
{
function remove_directory($directory, $empty=FALSE)
{
    if(substr($directory,-1) == '/') {
        $directory = substr($directory,0,-1);
    }

    if(!file_exists($directory) || !is_dir($directory)) {
        return FALSE;
    } elseif(!is_readable($directory)) {

    return FALSE;

    } else {

        $handle = opendir($directory);
        while (FALSE !== ($item = readdir($handle)))
        {
            if($item != '.' && $item != '..') {
                $path = $directory.'/'.$item;
                if(is_dir($path)) {
                    remove_directory($path);
                }else{
                    unlink($path);
                }
            }
        }
        closedir($handle);
        if($empty == FALSE)
        {
            if(!rmdir($directory))
            {
                return FALSE;
            }
        }
    return TRUE;
    }
}
}

/* End of file recursive_helper.php */
/* Location: /application/helpers/recursive_helper.php */ 