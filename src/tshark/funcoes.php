<?php

function construirComandoTshark($interface, $quantidade, $tsharkPath) {
    return escapeshellcmd("$tsharkPath -i $interface -c $quantidade -T fields -e ip.src -e ip.dst -e _ws.col.Protocol -e frame.len -E separator=,");
}

function parsearSaidaTshark($saidaBruta) {
    $linhas = explode("\n", trim($saidaBruta));
    $pacotes = [];

    foreach ($linhas as $linha) {
        $dados = explode(",", $linha);
        if (count($dados) >= 4) {
            $pacotes[] = [
                'src_ip' => $dados[0],
                'dest_ip' => $dados[1],
                'protocolo' => $dados[2],
                'tamanho' => intval($dados[3])
            ];
        }
    }

    return $pacotes;
}
?>
