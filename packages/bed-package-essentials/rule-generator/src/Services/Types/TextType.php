<?php

namespace JamstackVietnam\RuleGenerator\Services\Types;


class TextType
{
    use _Common;
    use _Strings;

    public $col;
    public $rules = [];

    public function __invoke($col)
    {
        $this->setCol($col);

        $this->nullable();
        $this->length();

        return $this->rules;
    }

}
