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

namespace Ytake\KsqlClient\Entity;

use function sprintf;
use function spl_object_hash;

/**
 * Class FieldInfo
 */
final class FieldInfo implements EntityInterface
{
    /**
     * @param string $name
     * @param SchemaInfo|null $schemaInfo
     */
    public function __construct(
        private string $name,
        private ?SchemaInfo $schemaInfo
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return SchemaInfo|null
     */
    public function getSchema(): ?SchemaInfo
    {
        return $this->schemaInfo;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "FieldInfo{name='%s',schema=%s}",
            $this->name,
            !is_null($this->schemaInfo) ? spl_object_hash($this->schemaInfo) : ''
        );
    }
}
