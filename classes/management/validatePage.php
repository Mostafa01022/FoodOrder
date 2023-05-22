<?php

function validatePage(int $page , int $pageCounts) : bool
{
    return ($page>=1 and $page<= $pageCounts);
}
