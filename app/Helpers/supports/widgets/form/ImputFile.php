<?php

namespace App\Helpers\supports\widgets\form;

use App\Helpers\supports\widgets\form\Field;
use App\Helpers\supports\widgets\base\Element;
use App\Helpers\supports\widgets\form\interfaces\FormElementInterface;


/**
 * Representa um componente de upload de arquivo
 * @author Pablo Dall'Oglio
 */
class ImputFile extends Field implements FormElementInterface
{
    /**
     * Exibe o widget na tela
     */
    public function show()
    {
        // atribui as propriedades da TAG
        $divcontainerimg = new Element('div');
        $divcontainerimg->class = 'col-xl-2 col-md-2 col-sm-12';

        $divcontainerfile = new Element('div');
        $divcontainerfile->class = 'col-xl-10 col-md-10 col-sm-12';

        $img                    = new Element('img');
        $img->class             = $this->name;
        $img->src               = $this->value ? FILEMANAGER['UPLOAD_DIR'] . $this->value : URL_BASE . "assets/adm/img/images/default.jpg";
        $img->width             = '100%';

        $div_inputgroup         = new Element('div');
        $div_inputgroup->class  = 'input-group';

        $aria_describedby       = 'aria-describedby';
        $value_ariadescribedby  = 'button-addon2' . rand();

        $tag_input                      = new Element('input');
        $tag_input->id                  = $this->name;
        $tag_input->class               = 'form-control field';
        $tag_input->name                = $this->name;    // nome da TAG
        $tag_input->value               = $this->value ? $this->value : '';  // valor da TAG
        $tag_input->type                = 'text';         // tipo de input
        $tag_input->$aria_describedby   = $value_ariadescribedby; 
        $tag_input->readonly           = "1";
        //$tag_input->style = "width:{$this->size}"; // tamanho em pixels

        #botão que carrega o iframe ref ao filemager

        $tag_button         = new Element('a');
        $tag_button->class  = 'btn btn-outline-success filemaneger iframe-btn';
        $tag_button->href   = FILEMANAGER['DIALOG'] . 'field_id=' . $this->name;
        $tag_button->id     = $value_ariadescribedby;

        $icon               = new Element('span');
        $icon->class        = 'fas fa-file-upload';

        $tag_button->add($icon);

        $div_inputgroup->add($tag_input);
        $div_inputgroup->add($tag_button);

        // se o campo não é editável
        if (!parent::getEditable()) {
            // desabilita a TAG input
            //$tag_input->readonly    = "1";
            $tag_button->readonly   = "1";
        }

        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag_input->$property = $value;
            }
        }

        $divcontainerimg->add($img);
        $divcontainerfile->add($div_inputgroup);
        $divcontainer = new Element('div');
        $divcontainer->class = 'row v-center';

        $divcontainer->add($divcontainerimg);
        $divcontainer->add($divcontainerfile);

        // exibe a tag
        $divcontainer->show();
    }
}
