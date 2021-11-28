<?php

use Alfred\Workflows\Workflow;

require 'vendor/autoload.php';

$workflow = new Workflow;

$AllknownHosts = file_get_contents('/Users/phil/.ssh/known_hosts');
$knownHosts = explode("\n", $AllknownHosts);

foreach ($knownHosts as $host) {
    $hostParts = explode(' ', $host);


    $matches = substr_count($hostParts[0], ':');

    if ($matches > 1) {
        continue;
    }
    $cmd = str_replace(':', ' -p ', $hostParts[0]);
    $cmd = str_replace(['[', ']'], '', $cmd);

    if ($cmd) {
        $hosts[uniqid($cmd)] = [
            'uniqid' => uniqid($cmd),
            'subtitle' => 'ssh to ' . $cmd,
            'cmd' => $cmd
        ];
    }
}

$json = \json_decode(file_get_contents('/Users/phil/Dropbox/Apps/Shuttle/.shuttle.json'));
foreach ($json->hosts as $group) {
    foreach ($group as $entry) {
        foreach ($entry as $one) {

            $line = str_replace(['root@', 'ssh -t', 'ssh',], ['', '', ''], $one->cmd);
            $line = trim($line);
            if (substr_count($line, ':') > 1) {
                continue;
            }
            if (substr_count($line, '-t') >= 1) {
                continue;
            }

            $hosts[uniqid($line)] = [
                'uniqid' => uniqid($one->cmd),
                'subtitle' => $one->name,
                'cmd' => $line
            ];
        }
    }
}

ksort($hosts);

foreach ($hosts as $host) {

    $urlParts = explode(' ', $host['cmd']);
    $icon = 'icon.png';
    $workflow->result()
        ->uid($host['uniqid'])
        ->title($host['subtitle'] ?: $host['cmd'])
        ->subtitle($host['subtitle'])
        ->arg($host['cmd'])
        ->quicklookurl('https://' . \count($urlParts) ? $urlParts[0] : $host)
        ->icon($icon)
        ->type('default')
        ->valid(true)
        ->autocomplete($host);
}

echo $workflow->output();
