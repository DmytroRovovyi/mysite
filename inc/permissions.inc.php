<?php
function check_access($login, $machine_name) {
    global $pdo;

    $query = $pdo->prepare(
        'SELECT COUNT(*) FROM users u 
        INNER JOIN user_roles ur ON ur.ud = u.id
        INNER JOIN roles r ON r.id = ur.gd
        INNER JOIN user_permissions up ON up.rid = r.id
        INNER JOIN permissions p ON p.id = up.pid
        WHERE u.login = ? AND p.machine_name = ?
        LIMIT 1'
    );
    $query->bindParam(1, $login);
    $query->bindParam(2, $machine_name);
    $query->execute();

    return (bool) $query->fetchColumn(0);
}