<?php

function check_if_dublette($to_do_list, $title)
{
    $dublette = '';
    
    for ($i = 0; $i < count($to_do_list); $i++)
    {
        if ($title == $to_do_list[$i]["title"])
        {
            $dublette = true;
        }
        else
        {
            $dublette = false;
        }
    }
    
    return $dublette;
}

?>