<?php
session_start();

// Notīrīt visas sesijas datus
session_unset();
// Izslēgt sesiju
session_destroy();

header("Location: ../../login.php");
exit();
?> 