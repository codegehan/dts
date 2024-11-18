<?php

class LZ77 {
    private $windowSize;
    private $lookAheadSize;
    private $minMatch;

    public function __construct($windowSize = 4096, $lookAheadSize = 16, $minMatch = 3) {
        $this->windowSize = $windowSize;
        $this->lookAheadSize = $lookAheadSize;
        $this->minMatch = $minMatch;
    }

    public function compress($data) {
        $compressed = [];
        $position = 0;
        $dataLength = strlen($data);

        while ($position < $dataLength) {
            $match = $this->findLongestMatch($data, $position);
            if ($match['length'] >= $this->minMatch) {
                $compressed[] = [
                    'distance' => $match['distance'],
                    'length' => $match['length'],
                    'next_char' => $match['next_char']
                ];
                $position += $match['length'] + 1;
            } else {
                $compressed[] = [
                    'distance' => 0,
                    'length' => 0,
                    'next_char' => $data[$position]
                ];
                $position += 1;
            }
        }
        return $compressed;
    }

    private function findLongestMatch($data, $currentPosition) {
        $endOfBuffer = min($currentPosition + $this->lookAheadSize, strlen($data));
        $bestMatchDistance = 0;
        $bestMatchLength = 0;

        $searchStart = max(0, $currentPosition - $this->windowSize);
        $searchBuffer = substr($data, $searchStart, $currentPosition - $searchStart);
        $lookAheadBuffer = substr($data, $currentPosition, $endOfBuffer - $currentPosition);

        $bufferLength = strlen($lookAheadBuffer);

        if ($bufferLength == 0) {
            return [
                'distance' => 0,
                'length' => 0,
                'next_char' => ''
            ];
        }

        for ($i = 0; $i < strlen($searchBuffer); $i++) {
            $length = 0;
            while ($length < $bufferLength && $searchBuffer[$i + $length] === $lookAheadBuffer[$length]) {
                $length++;
                if (($i + $length) >= strlen($searchBuffer)) {
                    break;
                }
            }

            if ($length > $bestMatchLength) {
                $bestMatchLength = $length;
                $bestMatchDistance = strlen($searchBuffer) - $i;
            }
        }
        $nextChar = ($currentPosition + $bestMatchLength) < strlen($data) ? $data[$currentPosition + $bestMatchLength] : '';

        return [
            'distance' => $bestMatchDistance,
            'length' => $bestMatchLength,
            'next_char' => $nextChar
        ];
    }

    public function decompress($compressed) {
        $decompressed = '';

        foreach ($compressed as $token) {
            if ($token['distance'] == 0 && $token['length'] == 0) {
                $decompressed .= $token['next_char'];
            } else {
                $start = strlen($decompressed) - $token['distance'];
                for ($i = 0; $i < $token['length']; $i++) {
                    $decompressed .= $decompressed[$start + $i];
                }
                if ($token['next_char'] !== '') {
                    $decompressed .= $token['next_char'];
                }
            }
        }
        return $decompressed;
    }
}

class HuffmanCoding {
    private $frequency;
    private $heap;
    private $codes;
    private $reverseCodes;

    public function __construct() {
        $this->frequency = [];
        $this->heap = new SplPriorityQueue();
        $this->heap->setExtractFlags(SplPriorityQueue::EXTR_DATA);
        $this->codes = [];
        $this->reverseCodes = [];
    }

    private function buildFrequencyTable($data) {
        foreach ($data as $token) {
            if ($token['distance'] == 0 && $token['length'] == 0) {
                $symbol = 'L:' . $token['next_char'];
            } else {
                $symbol = 'M:' . $token['distance'] . ':' . $token['length'] . ':' . $token['next_char'];
            }

            if (isset($this->frequency[$symbol])) {
                $this->frequency[$symbol]++;
            } else {
                $this->frequency[$symbol] = 1;
            }
        }
    }

    private function buildHuffmanTree() {
        foreach ($this->frequency as $symbol => $freq) {
            $this->heap->insert($symbol, $freq);
        }

        while ($this->heap->count() > 1) {
            $symbol1 = $this->heap->extract();
            $freq1 = $this->frequency[$symbol1];

            $symbol2 = $this->heap->extract();
            $freq2 = $this->frequency[$symbol2];

            $mergedSymbol = $symbol1 . '+' . $symbol2;
            $mergedFreq = $freq1 + $freq2;

            $this->heap->insert($mergedSymbol, $mergedFreq);
            $this->frequency[$mergedSymbol] = $mergedFreq;
        }

        if ($this->heap->isEmpty()) {
            throw new Exception('Huffman Tree is empty. No data to encode.');
        }

        $root = $this->heap->extract();
        $this->generateCodes($root, '');
    }

    private function generateCodes($node, $code) {
        if (strpos($node, '+') === false) {
            $this->codes[$node] = $code;
            $this->reverseCodes[$code] = $node;
            return;
        }

        list($left, $right) = explode('+', $node, 2);
        $this->generateCodes($left, $code . '0');
        $this->generateCodes($right, $code . '1');
    }

    public function encode($data) {
        $this->buildFrequencyTable($data);
        $this->buildHuffmanTree();

        $encodedData = '';
        foreach ($data as $token) {
            if ($token['distance'] == 0 && $token['length'] == 0) {
                $symbol = 'L:' . $token['next_char'];
            } else {
                $symbol = 'M:' . $token['distance'] . ':' . $token['length'] . ':' . $token['next_char'];
            }
            $encodedData .= $this->codes[$symbol];
        }

        $padding = 8 - (strlen($encodedData) % 8);
        if ($padding != 8) {
            $encodedData .= str_repeat('0', $padding);
        } else {
            $padding = 0;
        }

        $byteArray = '';
        for ($i = 0; $i < strlen($encodedData); $i += 8) {
            $byte = substr($encodedData, $i, 8);
            $byteArray .= chr(bindec($byte));
        }

        $header = chr($padding);
        return $header . $byteArray;
    }

    public function decode($encodedData) {
        $padding = ord($encodedData[0]);
        $byteArray = substr($encodedData, 1);

        $binaryString = '';
        for ($i = 0; $i < strlen($byteArray); $i++) {
            $binaryString .= str_pad(decbin(ord($byteArray[$i])), 8, '0', STR_PAD_LEFT);
        }

        if ($padding > 0) {
            $binaryString = substr($binaryString, 0, -$padding);
        }

        $decodedTokens = [];
        $currentCode = '';
        foreach (str_split($binaryString) as $bit) {
            $currentCode .= $bit;
            if (isset($this->reverseCodes[$currentCode])) {
                $symbol = $this->reverseCodes[$currentCode];
                if (strpos($symbol, 'L:') === 0) {
                    $char = substr($symbol, 2);
                    $decodedTokens[] = [
                        'distance' => 0,
                        'length' => 0,
                        'next_char' => $char
                    ];
                } else if (strpos($symbol, 'M:') === 0) {
                    list(, $distance, $length, $char) = explode(':', $symbol);
                    $decodedTokens[] = [
                        'distance' => (int)$distance,
                        'length' => (int)$length,
                        'next_char' => $char
                    ];
                }
                $currentCode = '';
            }
        }
        return $decodedTokens;
    }
}

class CompressIQ {
    private $lz77;
    private $huffman;

    public function __construct() {
        $this->lz77 = new LZ77();
        $this->huffman = new HuffmanCoding();
    }

    public function compress($inputPath, $outputPath) {
        if (!file_exists($inputPath)) {
            return ['success' => false, 'error' => 'Input file not found'];
        }

        try {
            $pdfContent = file_get_contents($inputPath);
            if ($pdfContent === false) {
                throw new Exception('Failed to read input file');
            }

            $lz77Compressed = $this->lz77->compress($pdfContent);
            $huffmanCompressed = $this->huffman->encode($lz77Compressed);
            $signature = 'CPDF1';
            $finalContent = $signature . $huffmanCompressed;

            $outputDir = dirname($outputPath);
            if (!is_dir($outputDir)) {
                if (!mkdir($outputDir, 0755, true)) {
                    throw new Exception('Failed to create output directory');
                }
            }

            if (file_put_contents($outputPath, $finalContent) === false) {
                throw new Exception('Failed to write output file');
            }

            $originalSize = strlen($pdfContent);
            $compressedSize = strlen($finalContent);
            $compressionRatio = round((1 - ($compressedSize / $originalSize)) * 100, 2);

            return [
                'success' => true,
                'original_size' => $originalSize,
                'compressed_size' => $compressedSize,
                'compression_ratio' => $compressionRatio
            ];

        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function decompress($inputPath, $outputPath) {
        if (!file_exists($inputPath)) {
            return ['success' => false, 'error' => 'Compressed file not found'];
        }

        try {
            $content = file_get_contents($inputPath);
            if ($content === false) {
                throw new Exception('Failed to read compressed file');
            }

            $signature = substr($content, 0, 5);
            if ($signature !== 'CPDF1') {
                return ['success' => false, 'error' => 'Invalid file format'];
            }

            $huffmanCompressed = substr($content, 5);
            $lz77Compressed = $this->huffman->decode($huffmanCompressed);
            $decompressedData = $this->lz77->decompress($lz77Compressed);

            if (file_put_contents($outputPath, $decompressedData) === false) {
                throw new Exception('Failed to write decompressed file');
            }

            return [
                'success' => true,
                'message' => 'Decompression successful',
                'output_path' => $outputPath
            ];

        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
?>