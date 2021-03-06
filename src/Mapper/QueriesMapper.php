<?php

declare(strict_types=1);

/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

namespace Ytake\KsqlClient\Mapper;

use Ytake\KsqlClient\Entity\EntityInterface;
use Ytake\KsqlClient\Entity\EntityQueryId;
use Ytake\KsqlClient\Entity\Queries;
use Ytake\KsqlClient\Entity\RunningQuery;
use Ytake\KsqlClient\Query\QueryId;

/**
 * Class QueriesMapper
 */
final class QueriesMapper implements ResultInterface
{
    /**
     * @param array $rows
     */
    public function __construct(
        private array $rows
    ) {
    }

    /**
     * @return EntityInterface
     */
    public function result(): EntityInterface
    {
        $queries = [];
        foreach ($this->rows['queries'] as $row) {
            $queries[] = new RunningQuery(
                $row['queryString'],
                $row['sinks'],
                new EntityQueryId(
                    new QueryId($row['id'])
                )
            );
        }
        return new Queries($this->rows['statementText'], $queries);
    }
}
