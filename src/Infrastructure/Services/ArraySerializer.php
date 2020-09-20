<?php

namespace Infrastructure\Services;

use League\Fractal\Serializer\ArraySerializer as FractalArraySerializer;

/**
 * Class ArraySerializer
 *
 * @author Grigor Milchev <grigor@devision.bg>
 */
class ArraySerializer extends FractalArraySerializer
{
    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data): array
    {
        return $data;
    }

    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function item($resourceKey, array $data): array
    {
        return $data;
    }

    /**
     * Serialize null resource.
     *
     * @return array
     */
    public function null(): array
    {
        return [];
    }
}
