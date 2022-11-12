<?php

function form_tilt($attrs)
{
    $attrs = shortcode_atts(array(
        'clip' => 'top',
        'title' => 'Entre em contato',
        'background' => 'gradient',
    ), $attrs);

    $clip = $attrs['clip'];
    $title = $attrs['title'];
    $background = $attrs['background'];

    ob_start(); // Start HTML buffering

?>

    <section class="short-form-tilt <?php echo "clip-$clip background-$background"; ?>">
        <div class="content">
            <div class="container">
                <h2 class="title text-center">
                    <?php echo $title; ?>
                </h2>
                <div class="d-flex">
                    <div class="form mx-auto">
                        <form action="">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="nome" placeholder="Nome Sobrenome">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="seuemail@exemplo.com.br">
                            </div>
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone:</label>
                                <input type="text" class="form-control" id="telefone" placeholder="(00) 9 9999 9999">
                            </div>
                            <div class="mb-3">
                                <label for="mensagem" class="form-label">Mensagem:</label>
                                <textarea class="form-control" id="mensagem" rows="3" placeholder="Mensagem"></textarea>
                            </div>
                            <div class="pt-2 d-flex">
                                <button class="submit btn-icon ms-auto">
                                    enviar <span class="bi-chevron-right"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
