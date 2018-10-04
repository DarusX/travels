<?php
function color()
{
    switch (rand(1, 4)) {
        case 1:
            return "#ff9155";
            break;
        case 2:
            return "#ffaa64";
            break;
        case 3:
            return "#464655";
            break;
        case 4:
            return "#ffc878";
            break;
    }
}