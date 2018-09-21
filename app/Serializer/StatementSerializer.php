<?php

namespace CodeFin\Serializer;

use Illuminate\Contracts\Support\Jsonable;

class StatementSerializer implements Jsonable
{
    private $statements;
    private $statementData;

    public function __construct($statements, $statementData)
    {
        $this->statements = $statements;
        $this->statementData = $statementData;
    }


    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        $statements = $this->statements->jsonSerialize();

        return json_encode([
            'statements' => $statements,
            'statement_data' => $this->statementData
        ], $options);
    }

    public function getStatementData()
    {
        return $this->statementData;
    }

    public function getStatements()
    {
        return $this->statements;
    }
}