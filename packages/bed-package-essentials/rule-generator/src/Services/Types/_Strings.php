<?php

namespace JamstackVietnam\RuleGenerator\Services\Types;


trait _Strings
{
    protected function length()
    {
        if ($len = $this->col->getLength())
            $this->rules['max'] = $len;
    }

}



