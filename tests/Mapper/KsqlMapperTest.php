<?php

declare(strict_types=1);

namespace Tests\Mapper;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Ytake\KsqlClient\Entity\KsqlCollection;
use Ytake\KsqlClient\Entity\RunningQuery;
use Ytake\KsqlClient\Entity\SourceDescriptionEntity;
use Ytake\KsqlClient\Mapper\KsqlMapper;

final class KsqlMapperTest extends TestCase
{
    public function testShouldReturnDescriptionEntity(): void
    {
        $mapper = new KsqlMapper(new Response(200, [], $this->json()));
        /** @var KsqlCollection $result */
        $result = $mapper->result();
        $row = $result->getKsql()[0];
        /** @var SourceDescriptionEntity $row */
        $this->assertInstanceOf(SourceDescriptionEntity::class, $row);
        $this->assertNotEmpty($row->getStatementText());
        $this->assertEmpty($row->getSourceDescription()->getErrorStats());
        $this->assertSame('USERID', $row->getSourceDescription()->getKey());
        $this->assertSame('USERS', $row->getSourceDescription()->getName());
        $this->assertContainsOnlyInstancesOf(
            RunningQuery::class,
            $row->getSourceDescription()->getReadQueries()
        );
        $this->assertSame(0, $row->getSourceDescription()->getPartitions());
        $this->assertSame(0, $row->getSourceDescription()->getReplication());
    }

    protected function json(): string
    {
        return '[
  {
    "@type": "sourceDescription",
    "statementText": "DESCRIBE users;",
    "sourceDescription": {
      "name": "USERS",
      "readQueries": [],
      "writeQueries": [],
      "fields": [
        {
          "name": "ROWTIME",
          "schema": {
            "type": "BIGINT",
            "fields": null,
            "memberSchema": null
          }
        },
        {
          "name": "ROWKEY",
          "schema": {
            "type": "STRING",
            "fields": null,
            "memberSchema": null
          }
        },
        {
          "name": "REGISTERTIME",
          "schema": {
            "type": "BIGINT",
            "fields": null,
            "memberSchema": null
          }
        },
        {
          "name": "GENDER",
          "schema": {
            "type": "STRING",
            "fields": null,
            "memberSchema": null
          }
        },
        {
          "name": "REGIONID",
          "schema": {
            "type": "STRING",
            "fields": null,
            "memberSchema": null
          }
        },
        {
          "name": "USERID",
          "schema": {
            "type": "STRING",
            "fields": null,
            "memberSchema": null
          }
        },
        {
          "name": "INTERESTS",
          "schema": {
            "type": "ARRAY",
            "fields": null,
            "memberSchema": {
              "type": "STRING",
              "fields": null,
              "memberSchema": null
            }
          }
        },
        {
          "name": "CONTACTINFO",
          "schema": {
            "type": "MAP",
            "fields": null,
            "memberSchema": {
              "type": "STRING",
              "fields": null,
              "memberSchema": null
            }
          }
        }
      ],
      "type": "TABLE",
      "key": "USERID",
      "timestamp": "",
      "statistics": "",
      "errorStats": "",
      "extended": false,
      "format": "JSON",
      "topic": "users",
      "partitions": 0,
      "replication": 0
    }
  }
]';
    }
}
