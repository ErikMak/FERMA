<?
use Workerman\Worker;
use PHPSocketIO\SocketIO;
require_once __DIR__ . '/vendor/autoload.php';
$users = [];

$ws_worker = new Worker("websocket://0.0.0.0:8000");
$ws_worker->onWorkerStart = function() use (&$users)
{
    $inner_tcp_worker = new Worker("tcp://127.0.0.1:1234");
    $inner_tcp_worker->onMessage = function($connection, $data) use (&$users) {
        $data = (json_decode($data));
        echo '['.date("H:i:s").'] == Торговая площадка == '.$data->id.' ID отправил лот номер '.$data->lot_id."\n";
        foreach ($users as $c) {
            $c->send(true);
        }
    };
    $inner_tcp_worker->listen();
};

$ws_worker->onConnect = function($connection) use (&$users)
{
    $connection->onWebSocketConnect = function($connection) use (&$users)
    {
        $users[$_GET['user']] = $connection;
        echo '['.date("H:i:s").'] == Торговая площадка == '.$_GET['user']." ID подключился.\n";
    };
};
$ws_worker->onMessage = function($connection, $data) use (&$users)
{
    echo $data."\n";
};

$ws_worker->onClose = function($connection) use(&$users)
{
    $user = array_search($connection, $users);
    echo '['.date("H:i:s").'] == Торговая площадка == '.$user." ID отключен.\n";
    unset($users[$user]);
};

// Run worker
Worker::runAll();