
<?php
/*
Plugin Name: Wirefish Captura
Description: Plugin para capturar pacotes com TShark e armazenar no banco.
*/

function wirefish_captura() {
    global $wpdb;

    // Interface de rede e duração (ex: eth0, 10 segundos)
    $interface = 'en0';  // ou ajuste conforme seu adaptador
    $duracao = 10;

    $cmd = escapeshellcmd("tshark -i $interface -a duration:$duracao -T fields -e ip.src -e ip.dst -e _ws.col.Protocol -e frame.len -E separator=, -E quote=d -E header=n | grep -v '^\"\"'");
    $output = shell_exec($cmd);

    if (!$output) {
        return "Erro ao capturar pacotes.";
    }

    $linhas = explode("\n", trim($output));

    foreach ($linhas as $linha) {
        $dados = str_getcsv($linha);
        if (count($dados) === 4) {
            [$src, $dst, $proto, $len] = $dados;

            $wpdb->insert('PACOTES', [
                'src_ip'   => $src,
                'dest_ip'  => $dst,
                'protocolo'=> $proto,
                'tamanho'  => intval($len),
            ]);
        }
    }

    return "Captura finalizada. " . count($linhas) . " pacotes registrados.";
}

// Para executar manualmente via URL
add_action('admin_post_wirefish_run', 'wirefish_captura');

// Adiciona item no painel do WP (opcional)
add_action('admin_menu', function () {
    add_menu_page('Wirefish Captura', 'Captura TShark', 'manage_options', 'wirefish-captura', function () {
        echo '<h1>Capturar Pacotes com TShark</h1>';
        echo '<a href="' . admin_url('admin-post.php?action=wirefish_run') . '" class="button button-primary">Executar Captura</a>';
    });
});
