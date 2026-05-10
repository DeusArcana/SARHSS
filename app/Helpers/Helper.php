
<?php

function getSomething()
{
    return true;
}

function decode($connection, $id)
{
    return Hashids::connection($connection)->decode($id)[0] ?? null;
}

function encode($connection, $id)
{
    return Hashids::connection($connection)->encode($id);
}
