<?php

include_once dirname(__FILE__) . '/' . '../renderers/renderer.php';
include_once dirname(__FILE__) . '/' . 'custom.php';
include_once dirname(__FILE__) . '/' . '../common.php';
include_once dirname(__FILE__) . '/' . '../superglobal_wrapper.php';

class TextEdit extends CustomEditor {
    private $value;
    private $size = null;
    private $maxLength = null;
    private $allowHtmlCharacters = true;
    private $passwordMode;
    /** @var string */
    private $placeholder = null;
    /** @var string */
    private $prefix = null;
    /** @var string */
    private $suffix = null;

    public function __construct($name, $size = null, $maxLength = null, $customAttributes = null) {
        parent::__construct($name, $customAttributes);
        $this->size = $size;
        $this->maxLength = $maxLength;
        $this->passwordMode = false;
    }

    public function SetSize($value) {
        $this->size = $value;
    }

    public function GetSize() {
        return $this->size;
    }

    public function SetMaxLength($value) {
        $this->maxLength = $value;
    }

    public function GetMaxLength() {
        return $this->maxLength;
    }

    public function GetValue() {
        return $this->value;
    }

    public function SetValue($value) {
        $this->value = $value;
    }

    public function GetDataEditorClassName() {
        return 'TextEdit';
    }

    public function GetPasswordMode() {
        return $this->passwordMode;
    }

    public function SetPasswordMode($value) {
        $this->passwordMode = $value;
    }

    public function GetHTMLValue() {
        return str_replace('"', '&quot;', $this->value);
    }

    public function GetAllowHtmlCharacters() {
        return $this->allowHtmlCharacters;
    }

    public function SetAllowHtmlCharacters($value) {
        $this->allowHtmlCharacters = $value;
    }

    public function getPlaceholder() {
        return $this->placeholder;
    }

    public function setPlaceholder($value) {
        $this->placeholder = $value;
        return $this;
    }

    public function getPrefix() {
        return $this->prefix;
    }

    public function setPrefix($value) {
        $this->prefix = $value;
        return $this;
    }

    public function getSuffix() {
        return $this->suffix;
    }

    public function setSuffix($value) {
        $this->suffix = $value;
        return $this;
    }

    public function extractValueFromArray(ArrayWrapper $arrayWrapper, &$valueChanged) {
        if ($arrayWrapper->IsValueSet($this->GetName())) {
            $valueChanged = true;
            $value = $arrayWrapper->GetValue($this->GetName());
            if (!$this->allowHtmlCharacters)
                $value = htmlspecialchars($value, ENT_QUOTES);
            return $value;
        } else {
            $valueChanged = false;
            return null;
        }
    }

    public function Accept(EditorsRenderer $Renderer) {
        $Renderer->RenderTextEdit($this);
    }
}
