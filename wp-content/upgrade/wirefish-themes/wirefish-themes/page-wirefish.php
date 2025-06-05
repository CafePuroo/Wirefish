
<?php
/**
 * Template Name: Wirefish Dashboard
 */

get_header();
?>

<div class="container">
    <h2>Pacotes Capturados</h2>

    <?php
    global $wpdb;
    $pacotes = $wpdb->get_results("SELECT * FROM PACOTES ORDER BY id DESC LIMIT 50");

    if ($pacotes):
    ?>
        <table style="width:100%; border-collapse: collapse;" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Protocolo</th>
                    <th>Tamanho</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pacotes as $p): ?>
                <tr>
                    <td><?php echo esc_html($p->id); ?></td>
                    <td><?php echo esc_html($p->src_ip); ?></td>
                    <td><?php echo esc_html($p->dest_ip); ?></td>
                    <td><?php echo esc_html($p->protocolo); ?></td>
                    <td><?php echo esc_html($p->tamanho); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum pacote encontrado.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
