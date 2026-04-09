<?php
/**
 * MySQLi Compatibility Layer
 * Provides backward compatibility for deprecated mysql_* functions
 * Allows PHP 8.2+ compatibility
 */

// Global MySQLi connection object
global $db_link;

/**
 * Establishes a database connection using MySQLi
 */
function mysql_connect($server, $username, $password) {
    global $db_link;
    
    $db_link = new mysqli($server, $username, $password);
    
    if ($db_link->connect_error) {
        die('Connection failed: ' . $db_link->connect_error);
    }
    return $db_link;
}

/**
 * Selects a database
 */
function mysql_select_db($database_name, $link = null) {
    global $db_link;
    
    if ($link === null) {
        $link = $db_link;
    }
    
    if (!$link->select_db($database_name)) {
        die('Can\'t use ' . $database_name . ': ' . $link->error);
    }
    
    return true;
}
/**
 * Executes a query
 */
function mysql_query($query, $link = null) {
    global $db_link;
    
    if ($link === null) {
        $link = $db_link;
    }
    
    $result = $link->query($query);
    
    if (!$result) {
        // Return false on query error (like the old mysql_query)
        return false;
    }
    
    return $result;
}

/**
 * Fetches a row as an array
 */
function mysql_fetch_array($result, $result_type = MYSQLI_BOTH) {
    if (!$result) {
        return false;
    }
    
    return $result->fetch_array($result_type);
}

/**
 * Fetches a row as an associative array
 */
function mysql_fetch_assoc($result) {
    if (!$result) {
        return false;
    }
    
    return $result->fetch_assoc();
}

/**
 * Fetches a row as a numeric array
 */
function mysql_fetch_row($result) {
    if (!$result) {
        return false;
    }
    
    return $result->fetch_row();
}

/**
 * Gets the number of rows in a result
 */
function mysql_num_rows($result) {
    if (!$result) {
        return false;
    }
    
    return $result->num_rows;
}

/**
 * Gets the number of affected rows in previous operation
 */
function mysql_affected_rows($link = null) {
    global $db_link;
    
    if ($link === null) {
        $link = $db_link;
    }
    
    return $link->affected_rows;
}

/**
 * Escapes a string for use in an SQL statement
 */
function mysql_real_escape_string($unescaped_string, $link = null) {
    global $db_link;
    
    if ($link === null) {
        $link = $db_link;
    }
    
    return $link->real_escape_string($unescaped_string);
}

/**
 * Returns the last error message
 */
function mysql_error($link = null) {
    global $db_link;
    
    if ($link === null) {
        $link = $db_link;
    }
    
    return $link->error;
}

/**
 * Returns the last error number
 */
function mysql_errno($link = null) {
    global $db_link;
    
    if ($link === null) {
        $link = $db_link;
    }
    
    return $link->errno;
}

/**
 * Gets the ID generated from the previous INSERT operation
 */
function mysql_insert_id($link = null) {
    global $db_link;
    
    if ($link === null) {
        $link = $db_link;
    }
    
    return $link->insert_id;
}

/**
 * Closes a database connection
 */
function mysql_close($link = null) {
    global $db_link;
    
    if ($link === null) {
        $link = $db_link;
    }
    
    if ($link) {
        return $link->close();
    }
    
    return false;
}

/**
 * Set character set
 */
function mysql_set_charset($charset_name, $link = null) {
    global $db_link;
    
    if ($link === null) {
        $link = $db_link;
    }
    
    return $link->set_charset($charset_name);
}

/**
 * Gets a result field/value from a result set
 * Returns a single value from a result set at the specified row and field position
 */
function mysql_result($result, $row = 0, $field = 0) {
    if (!$result) {
        return false;
    }
    
    // Move to specified row
    if (!$result->data_seek($row)) {
        return false;
    }
    
    // Fetch the row
    $fetch = $result->fetch_row();
    
    if (!$fetch) {
        return false;
    }
    
    // If field is numeric, return by index
    if (is_numeric($field)) {
        return isset($fetch[$field]) ? $fetch[$field] : false;
    }
    
    // If field is a string (column name), need to get field info
    // This requires fetching as associative array
    $result->data_seek($row);
    $fetch_assoc = $result->fetch_assoc();
    
    if (!$fetch_assoc) {
        return false;
    }
    
    return isset($fetch_assoc[$field]) ? $fetch_assoc[$field] : false;
}

?>
