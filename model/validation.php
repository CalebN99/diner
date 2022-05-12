<?php

//Validate user input from the diner app

// Food must have 2 characters min

function validFood($food) {
    return strlen(trim($food)) >= 2;
}
