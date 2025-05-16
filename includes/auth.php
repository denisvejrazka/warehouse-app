<?php
function require_role($role) {
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== $role) {
        die("Přístup odepřen.");
    }
}
