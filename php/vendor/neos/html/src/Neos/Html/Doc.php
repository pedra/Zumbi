<?php

/**
 * Layout HTML Container
 * @copyright           Bill Rocha - http://billrocha.tk
 * @license		http://billrocha/license
 * @author		Bill Rocha - prbr@ymail.com
 * @version		0.0.1
 * @package		Start\Html
 * @access 		public
 * @since		0.0.1
 */

namespace Neos\Html;

use o;

class Doc extends Render {

    private $views = Array();
    private $values = Array();
    private $file = '';
    private $content = '';

    //Inicializa e carrega o arquivo indicado
    function __construct($file = 'layout') {
        $this->file = o::html('path') . $file . o::html('ext');
        if (file_exists($this->file))
            $this->content = file_get_contents($this->file);
    }

    //Carrega uma partição HTML
    function load($file, $name = null) {
        if ($name === null)
            $name = $file;
        $this->views[$name] = new Doc($file);
        return $this->views[$name];
    }

    //Registra uma variável para o Layout
    function assign($var, $value = null) {
        return $this->setVar($var, $value);
    }

    function setVar($var, $value) {
        if (is_array($var)) {
            foreach ($var as $k => $v) {
                $this->values[$k] = $v;
            }
        } else
            $this->values[$var] = $value;
        return $this;
    }

    //checa se uma view existe
    function exists($name) {
        return (isset($this->views[$name])) ? 'true' : 'false';
    }

    //Pega o conteúdo de uma subView
    function getSubContent($name) {
        return (isset($this->views[$name]) ? $this->views[$name]->getContent() : '');
    }

    //Pega uma variável ou todas
    function getVar($var = null) {
        return ($var == null) ? $this->values : (isset($this->values[$var]) ? $this->values[$var] : false);
    }

    //Insere o conteúdo processado Html
    function setContent($content) {
        $this->content = $content;
        return $this;
    }

    //Pega o conteúdo processado Html
    function getContent() {
        return $this->content;
    }

    //checa se o arquivo existe e foi carregado (ver __construct)
    function getFile() {
        return $this->file;
    }

    function ifContent() {
        if ($this->content == '')
            return false;
        return true;
    }

    //Processa todo o HTML
    function render($php = true, $blade = true, $zTag = true) {
        //Renderiza todas os fragmentos HTML injetados
        foreach ($this->views as $view) {
            //se existir, processa o HTML.
            if ($view->ifContent())
                $view->render($php, $blade, $zTag);
        }
        //Renderizando o Layout
        $this->content = $this->produce($php, $blade, $zTag);
        //Retorna o HTML processado
        return $this->content;
    }

}
