<?php
//include_once 'psl-config.php';

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    //$secure = SECURE;

    // This stops JavaScript being able to access the session id.
    $httponly = true;

    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }

    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    //session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], 'SECURE', $httponly);

    // Sets the session name to the one set above.
    session_name($session_name);

    session_start();            // Start the PHP session
    session_regenerate_id();    // regenerated the session, delete the old one.
}

function login($email, $password, $conn) {
    // Using prepared statements means that SQL injection is not possible.
    if ($statement = $conn->prepare("SELECT id, password, salt
				  FROM users
                                  WHERE email = ? LIMIT 1")) {
        $statement->bind_param('s', $email);  // Bind "$email" to parameter.
        $statement->execute();    // Execute the prepared query.
        $statement->store_result();

        // get variables from result.
        $statement->bind_result($user_id, $db_password, $salt);
        $statement->fetch();

        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($statement->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts
            if (checkbrute($user_id, $conn) == true) {
                // Account is locked
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];

                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;

                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);

                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    if (!$conn->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')")) {
                        header("Location: ../error.php?err=Database error: login_attempts");
                        exit();
                    }

                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    } else {
        // Could not create a prepared statement
        header("Location: ../error.php?err=Database error: cannot prepare statement");
        exit();
    }
}

function checkbrute($user_id, $conn) {
    // Get timestamp of current time
    $now = time();

    // All login attempts are counted from the past 2 hours.
    $valid_attempts = $now - (2 * 60 * 60);

    if ($statement = $conn->prepare("SELECT time
                                  FROM login_attempts
                                  WHERE user_id = ? AND time > '$valid_attempts'")) {
        $statement->bind_param('i', $user_id);

        // Execute the prepared query.
        $statement->execute();
        $statement->store_result();

        // If there have been more than 5 failed logins
        if ($statement->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    } else {
        // Could not create a prepared statement
        header("Location: ../error.php?err=Database error: cannot prepare statement");
        exit();
    }
}

function login_check($conn) {
    // Check if all session variables are set
    if (isset($_SESSION['user_id'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];

        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($statement = $conn->prepare("SELECT password
				      FROM users
				      WHERE userID = ? LIMIT 1")) {
            // Bind "$user_id" to parameter.
            $statement->bind_param('i', $user_id);
            $statement->execute();   // Execute the prepared query.
            $statement->store_result();

            if ($statement->num_rows == 1) {
                // If the user exists get variables from result.
                $statement->bind_result($password);
                $statement->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if ($login_check == $login_string) {
                    // Logged In!!!!
                    return true;
                } else {
                    // Not logged in
                    return false;
                }
            } else {
                // Not logged in
                return false;
            }
        } else {
            // Could not prepare statement
            header("Location: ../error.php?err=Database error: cannot prepare statement");
            exit();
        }
    } else {
        // Not logged in
        return false;
    }
}

function esc_url($url) {

    if ('' == $url) {
        return $url;
    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;

    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }

    $url = str_replace(';//', '://', $url);

    $url = htmlentities($url);

    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
