<?php

$hide = $_GET['hide'] ? $_GET['hide'] : false;

$images = [
    'image-a' => 'http://placehold.it/128x128',
    'image-b' => 'http://placehold.it/128x128',
    'image-c' => 'http://placehold.it/128x128',
    'image-d' => 'http://placehold.it/128x128',
    'image-e' => 'http://placehold.it/128x128',
];


?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.2.3/css/bulma.min.css" integrity="sha256-F7gqKszCwmz8vhiti+AICU8dLfIEpxzPVihhhGfbbKg=" crossorigin="anonymous" />

    
<div class="section">

    <div class="container">

        <form method="post" action="save.php">

            <div class="columns">
                <?php
                    foreach ($images as $key => $value) {
                        ?>
                            <div class="column">
                                <figure class="image is-128x128 is-selectable">
                                  <img src="<?php echo $value; ?>" data-checkbox="<?php echo $key; ?>">
                                  <input type="checkbox" name="images[<?php echo $key; ?>]" value="checked"/>
                                </figure>
                            </div>
                        <?php
                    }
                ?>
            </div>
        
            <p class="control">
                <input type="submit" class="button is-primary" value="Salvar"/>
                <input type="reset" class="button is-link" value="Cancelar"/>
            </p>
        
        </form>

    </div>

</div>
    
<?php
    if ($hide) {
        ?>
        <style type="text/css">
            .is-selectable input {
                display: none;
            }
            .is-selectable img {
                border: 2px solid transparent;
                border-radius: 2px;
                cursor: pointer;
            }
            .is-selectable img.selected {
                border-color: #827777;
            }
        </style>
        <script type="text/javascript">
            (function() {
                
                const images = document.querySelectorAll('.is-selectable img');

                if (images.forEach) {
                    images.forEach(function(image) {
                        attach(image);
                    });
                }

                function attach(image) {

                    image.addEventListener('click', function() {

                        var checked = false;

                        if (this.className.indexOf('selected') === -1) {
                            this.className = this.className + ' ' + 'selected';
                            checked = true;
                        } else {
                            this.className = this.className.replace(' selected', '');
                        }
                        const id = image.getAttribute('data-checkbox');
                        const inputs = document.querySelectorAll('[name="images[' + id + ']"]');

                        inputs.forEach(function(input) {
                            input.checked = checked;
                        });
                    });
                }
            })();
        </script>
        <?php
    }
?>