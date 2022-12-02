<?php

function form_multiplo($attrs)
{
    $attrs = shortcode_atts(array(
        'show_title' => 1
    ), $attrs);

    $shortcode = get_theme_mod('form_multiple');

    ob_start(); // Start HTML buffering

    $input_name = 'departamentos';

    $options = array(
        'Vendas',
        'Recursos Humanos',
        'Pós venda',
        'Fornecedores',
        'Marketing'
    )

?>

    <section class="form-multiplo form-simples">
        <div class="container default-femai">
            <div class="row w-100 m-0">
                <div class="col-12 col-lg-4">
                    <ul class="departamento-options nav flex-column pb-4 pb-lg-0" role="tablist" aria-orientation="vertical">
                        <?php 
                        for($i = 0; $i < count($options); $i++) {
                            $option = $options[$i];

                            $target = strtolower(str_replace(' ', '-', $option));
                            $id = 'nav-' . strtolower(str_replace(' ', '-', $option));

                            if($i == 0) {
                                ?>
                                <li class="nav-item">
                                    <button class="nav-link active" id="<?php echo $id; ?>" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#<?php echo $target; ?>" 
                                    aria-controls="#<?php echo $target; ?>" aria-selected="true"
                                    type="button" role="tab">
                                        <?php echo $option; ?>
                                    </button>
                                </li>
                                <?php
                            }
                            else {
                                ?>
                                <li class="nav-item">
                                    <button class="nav-link" id="<?php echo $id; ?>" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#<?php echo $target; ?>" 
                                    aria-controls="<?php echo $target; ?>" aria-selected="false"
                                    type="button" role="tab">
                                        <?php echo $option; ?>
                                    </button>
                                </li>
                                <?php
                            }
                        } ?>
                    </ul>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="form-inner m-auto">
                        <div class="tab-content">
                            <?php 
                            for($i = 0; $i < count($options); $i++) {
                                $option = $options[$i];

                                $target = 'nav-' . strtolower(str_replace(' ', '-', $option));
                                $id = strtolower(str_replace(' ', '-', $option));

                                if($i == 0) {
                                    ?>
                                    <div class="title tab-pane fade show active" id="<?php echo $id; ?>" role="tabpanel" 
                                    aria-labelledby="<?php echo $target; ?>">
                                        <h2><?php echo $option; ?></h2>
                                    </div>
                                    <?php
                                }
                                else {
                                    ?>
                                    <div class="title tab-pane fade" id="<?php echo $id; ?>" role="tabpanel" 
                                    aria-labelledby="<?php echo $target; ?>">
                                        <h2><?php echo $option; ?></h2>
                                    </div>
                                    <?php
                                }
                            } ?>
                        </div>
                        <div class="form text-end d-flex">
                            <?php
                            echo do_shortcode($shortcode);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        var inputWrap = document.getElementById('departamento');
        inputWrap.innerHTML = '';
        
        var newInput = '<input type="hidden" name="departamento"/>';
        inputWrap.innerHTML = newInput;
    </script>

<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}