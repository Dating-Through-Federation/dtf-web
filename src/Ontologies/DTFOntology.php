<?php

namespace App\Ontologies;

use ActivityPhp\Type\OntologyBase;

abstract class DTFOntology extends OntologyBase
{
    /**
     * A definition of dialect to overload Activity Streams
     * vocabulary.
     *
     * @var array
     */
    protected static $definitions = [
        'Group' => ['dtf'],
    ];
}
