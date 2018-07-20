<?php

function create($class, $howMany = null, $attibutes = [])
{
    return factory($class, $howMany)->create($attibutes);
}


function make($class, $howMany = null, $attibutes = [])
{
    return factory($class, $howMany)->make($attibutes);
}
