<?php

/**
 * Checks whether user was trying to bruteforce the login.
 * Bruteforce is defined as 6 or more login attempts in last 2 hours from $now.
 * Default for $now is current time.
 * 
 * @param int $user_id ID of user in the DB
 * @param mysqli $connection Result of calling `new mysqli`
 * @param timestamp $now Base timestamp to count two hours from
 * @return bool Whether the $user_id tried to bruteforce login or not.
 */
function wasTryingToBruteForce($user_id, $connection, $now)
{
    if (!$now)
        $now = time();

    $two_hours_ago = $now - (2 * 60 * 60);
    $since = date('Y-m-d H:i:s', $two_hours_ago); // Checking records of login attempts for last 2 hours

    $stmt = $connection->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > ?");

    if ($stmt) { 
        $stmt->bind_param('is', $user_id, $since); 
        // Execute the prepared query.
        $stmt->execute();
        $stmt->store_result();
        // If there has been more than 5 failed logins
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}


    