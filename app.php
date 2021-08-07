<?php

/**
 * Developer : Incognito Coder
 * Release : 1.0.1 2021/07/04
 * Telegram : @IC_Mods
 */

function isCommandLineInterface()
{
    return (php_sapi_name() === 'cli');
}
function FullPath()
{
    $break = Explode('/', $_SERVER["SCRIPT_NAME"]);
    $pfile = $break[count($break) - 1];
    $spliter = explode($pfile, $_SERVER["SERVER_NAME"] . $_SERVER["SCRIPT_NAME"]);
    return $spliter[0];
}
function Generator()
{
    $password = readline('Now it\'s time to enter password: ');
    $port = readline('Finally enter port number: ');
    try {
        echo "\nProccessing ...\n\n";
        if (file_exists('profiles.json')) {
            $get = file_get_contents('profiles.json');
        } else {
            die("\033[31mProfiles.json not in path\033[0m\n");
        }
        $json = json_decode($get, true);
        $ips = [];
        $domains = [];
        $ssurl = [];
        foreach ($json as $server) {
            $host2ip = gethostbyname($server['server']);
            array_push($ips, $host2ip);
            array_push($domains, $server['server']);
            $encrypt = base64_encode($server['method'] . ":" . $password);
            array_push($ssurl, "ss://" . $encrypt . "@" . $host2ip . ":" . $port . "#" . rawurlencode($server['remarks'])  . "\n");
            echo $server['remarks'] . ' : ' . $server['server'] . ' >>> ' . $host2ip . PHP_EOL;
        }
        $edited = str_replace($domains, $ips, $get);
        $edited = str_replace('PASS', $password, $edited);
        $edited = str_replace('8585', $port, $edited);
        $new = readline("\033[33m\nSave file as ?:\033[0m ");
        if (!empty($new)) {
            file_put_contents($new, $edited);
            file_put_contents($new . '.txt', $ssurl);
            echo "\033[32mProccess Done.\033[0m";
        } else {
            echo 'No valid file name.';
            exit;
        }
    } catch (Exception $e) {
        die($e);
    }
}
function Update()
{
    $file = readline('Enter filename ends with .json: ');
    try {
        echo "\nProccessing ...\n\n";
        if (file_exists($file)) {
            $get = file_get_contents($file);
        } else {
            die("\033[31m$file not in path\033[0m\n");
        }
        $json = json_decode($get, true);
        $ips = [];
        $domains = [];
        $ssurl = [];
        foreach ($json as $server) {
            $host2ip = gethostbyname($server['server']);
            array_push($ips, $host2ip);
            array_push($domains, $server['server']);
            $encrypt = base64_encode($server['method'] . ":" . $server['password']);
            array_push($ssurl, "ss://" . $encrypt . "@" . $host2ip . ":" . $server['server_port'] . "#" . rawurlencode($server['remarks'])  . "\n");
            echo $server['remarks'] . ' : ' . $server['server'] . ' >>> ' . $host2ip . PHP_EOL;
        }
        $edited = str_replace($domains, $ips, $get);
        file_put_contents($file, $edited);
        file_put_contents($file . '.txt', $ssurl);
        echo "\033[32mProccess Done.\nFile Updated.\033[0m";
    } catch (Exception $e) {
        die($e);
    }
}

if (isCommandLineInterface()) {
    echo "========================================================\n\tWelcome To SurfShark SS Updater/Generator\n\t\tScripter : @Incognito_Coder\n========================================================\n";
    echo "\033[32m1 - Generate SS list with Credentials\n2 - Update SS list\n3 - About script\n4 - Exit\033[0m\n";
    $opt = readline("\033[36mSelect a option: \033[0m");
    switch ($opt) {
        case '1':
            Generator();
            break;
        case '2':
            Update();
            break;
        case '3':
            $about_string = "Version : 1.0.1 php\nDeveloper : Alireza Ah-Mand @Incognito_Coder\nHome : https://t.me/ic_mods | https://mr-incognito.ir\nBy using this php script u can create easily shadowsocks servers in a list of surfshark vpn servers.make sure you have valid password and port.";
            echo $about_string;
            break;
        case '4':
            exit;
            break;
        default:
            echo "\033[33mUndefined entry.\033[0m\n";
            break;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['method'] == 'create') {
        $password = $_POST['pass'];
        $port = $_POST['port'];
        $file_name = $_POST['name'];
        echo "Proccessing ...\n";
        if (file_exists('profiles.json')) {
            $get = file_get_contents('profiles.json');
        } else {
            die("Profiles.json not in path\n");
        }
        $json = json_decode($get, true);
        $ips = [];
        $domains = [];
        $ssurl = [];
        foreach ($json as $server) {
            $host2ip = gethostbyname($server['server']);
            array_push($ips, $host2ip);
            array_push($domains, $server['server']);
            $encrypt = base64_encode($server['method'] . ":" . $password);
            array_push($ssurl, "ss://" . $encrypt . "@" . $host2ip . ":" . $port . "#" . rawurlencode($server['remarks']) . "\n");
            echo $server['remarks'] . ' : ' . $server['server'] . ' >>> ' . $host2ip . PHP_EOL;
        }
        $edited = str_replace($domains, $ips, $get);
        $edited = str_replace('PASS', $password, $edited);
        $edited = str_replace('8585', $port, $edited);
        file_put_contents($file_name . '.json', $edited);
        file_put_contents($file_name . '.txt', $ssurl);
        echo "Proccess Done.";
        echo "\nJson : <a href=\"" . FullPath() . $file_name . ".json\">Download</a>";
        echo "\nURI : <a href=\"" . FullPath() . $file_name . ".txt\">Download</a>";
    } elseif ($_POST['method'] == 'update') {
    }
}
