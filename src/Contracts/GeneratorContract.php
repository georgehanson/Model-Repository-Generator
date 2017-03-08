<?php

namespace GeorgeHanson\ModelRepositoryGenerator\Contracts;


interface GeneratorContract
{
    /**
     * Get the namespace for where to store the new class
     *
     * @return string
     */
    public function getClassNamespace();
}