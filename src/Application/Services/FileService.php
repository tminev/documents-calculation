<?php

namespace Application\Services;

use Exception;
use Throwable;

/**
 * Class FileService
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class FileService
{
    /**
     * Get file content and convert to array
     *
     * @param string $path
     *
     * @return array
     *
     * @throws Exception
     */
    public function getFileContent(string $path): array
    {
        try {
            if (!file_exists($path)) {
                throw new Exception('File not found.');
            }

            $handle = fopen($path, "r");

            if (!$handle) {
                throw new Exception('File open failed.');
            }

            $lines = [];

            while (!feof($handle)) {
                $lines[] = trim(fgets($handle));
            }

            fclose($handle);
        } catch (Throwable $th) {
            $message = sprintf(
                'Problem with imported file: %s.',
                $th->getMessage()
            );

            throw new Exception($message);
        }

        return $lines;
    }
}
