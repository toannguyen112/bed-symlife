<?php

namespace JamstackVietnam\RuleGenerator\Services\Types;


class BooleanType
{
    use _Common;

    public $col;
    public $rules = [];

    public function __invoke($col)
    {
        $this->setCol($col);

        $this->nullable();
        $this->boolean();

        return $this->rules;
    }

    protected function boolean()
    {
        $this->rules['boolean'] = null;
    }

}
