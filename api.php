<?php
define('DB_HOST', 'db');
define('DB_NAME', 'test_smartloc');
define('DB_USER', 'smartloc');
define('DB_PASSWORD', 'smartloc');
function getDatabaseConnection(){
	return new PDO(
    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
    DB_USER,
    DB_PASSWORD,
		array(
      PDO::ATTR_PERSISTENT         => false,
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    )
  );
}
try{
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_GET['action']) && $_GET['action'] == '/update'){
        if(!isset($_POST['ticket']) || !isset($_POST['newStatus'])) {
            throw new Exception('ticket and new status must be provided');
        }

        $ticket = json_decode($_POST['ticket'], true);
        $ticketId = $ticket['id'];
        $ticket['status'] = $_POST['newStatus'];
        unset($ticket['id']);

        $ticketsStmt = getDatabaseConnection()->prepare('UPDATE tickets SET data = :data Where id = :id');
        $ticketsStmt->execute([
            'data' => json_encode($ticket),
            'id' => $ticketId
        ]);

    } elseif(isset($_GET['action']) && $_GET['action'] == '/new'){
        if(!isset($_POST['ticket'])) {
            throw new Exception('Une erreur technique est survenue');
        }
        // Ajout nouveau ticket : BACK
        $ticket = json_decode($_POST['ticket'], true);
        if(empty($ticket['content']) || empty($ticket['title'])) {
            throw new Exception('Vous devez préciser un titre et un contenu');
        }

        $ticket['status'] = 'todo';
        $ticket['created_date'] = (new DateTime)->format('Y-m-d H:i:s');

        $ticketsStmt = getDatabaseConnection()->prepare('INSERT INTO tickets(data) VALUES(:data)');
        $ticketsStmt->execute([
            'data' => json_encode($ticket),
        ]);
    }
  }
} catch(Exception $e){
  echo json_encode(["error" => $e->getMessage()]);
  return;
}
// Récupération de la liste des tickets en base

$tickets = [];
$ticketsStmt = getDatabaseConnection()->prepare('SELECT * FROM tickets');
$ticketsStmt->execute();
$ticketsResults = $ticketsStmt->fetchAll(PDO::FETCH_ASSOC);
foreach($ticketsResults as $ticket) {
    $tickets[] = array_merge(['id' => $ticket['id']], json_decode($ticket['data'], true));
}

echo json_encode($tickets);
?>