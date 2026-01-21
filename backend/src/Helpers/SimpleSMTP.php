<?php
namespace App\Helpers;

class SimpleSMTP
{
    private $host;
    private $port;
    private $username;
    private $password;
    private $timeout = 30;
    private $debug = false;

    public function __construct($host, $port, $username, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    public function send($to, $subject, $body, $fromName = 'Sistema Transformacion Digital')
    {
        $socket = null;
        $isSSL = false;

        if ($this->port == 465) {
            $socket = fsockopen('ssl://' . $this->host, 465, $errno, $errstr, $this->timeout);
            $isSSL = true;
        } else {
            $socket = fsockopen('tcp://' . $this->host, $this->port, $errno, $errstr, $this->timeout);
        }

        if (!$socket) {
            error_log("SMTP Error: $errno - $errstr");
            return false;
        }

        $this->read($socket); // banner

        // HELO/EHLO
        $this->cmd($socket, 'EHLO ' . gethostname());

        // STARTTLS only if NOT SSL and port is 587 (or generally 25/587)
        if (!$isSSL && $this->port == 587) {
            $this->cmd($socket, 'STARTTLS');
            $crypto = stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            if (!$crypto) {
                error_log("SMTP Error: Failed to enable crypto");
                return false;
            }
            $this->cmd($socket, 'EHLO ' . gethostname());
        }

        // AUTH
        $this->cmd($socket, 'AUTH LOGIN');
        $this->cmd($socket, base64_encode($this->username));
        $this->cmd($socket, base64_encode($this->password));

        // MAIL FROM/RCPT TO
        $this->cmd($socket, "MAIL FROM: <{$this->username}>");
        $this->cmd($socket, "RCPT TO: <$to>");

        // DATA
        $this->cmd($socket, 'DATA');

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "To: $to\r\n";
        $headers .= "From: $fromName <{$this->username}>\r\n";
        $headers .= "Subject: $subject\r\n";

        fwrite($socket, "$headers\r\n$body\r\n.\r\n");
        $this->read($socket);

        // QUIT
        $this->cmd($socket, 'QUIT');
        fclose($socket);

        return true;
    }

    private function cmd($socket, $cmd)
    {
        fwrite($socket, $cmd . "\r\n");
        return $this->read($socket);
    }

    private function read($socket)
    {
        $response = '';
        while ($str = fgets($socket, 515)) {
            $response .= $str;
            if (substr($str, 3, 1) == ' ')
                break;
        }
        if ($this->debug)
            error_log("SMTP: $response");
        return $response;
    }
}
