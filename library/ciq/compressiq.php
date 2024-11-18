<?php
class CompressIQ {
    public function compress($inputPath, $outputPath) {
        if (!file_exists($inputPath)) {
            return ['success' => false, 'error' => 'Input file not found'];
        }
        try {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $inputPath);
            finfo_close($finfo);
            
            if ($mimeType !== 'application/pdf') {
                throw new Exception('Input file is not a PDF');
            }
            $pdfContent = @file_get_contents($inputPath, false, null);
            if ($pdfContent === false) {
                throw new Exception('Failed to read input file');
            }
            $compressedData = gzcompress($pdfContent, 9);
            $signature = 'CPDF2'; // Custom signature
            $finalContent = $signature . $compressedData;
            // Ensure the output directory exists
            $outputDir = dirname($outputPath);
            if (!is_dir($outputDir)) {
                if (!mkdir($outputDir, 0755, true)) {
                    throw new Exception('Failed to create output directory');
                }
            }
            if (@file_put_contents($outputPath, $finalContent) === false) {
                throw new Exception('Failed to write output file');
            }            
            return [
                'success' => true,
                'original_size' => strlen($pdfContent),
                'compressed_size' => strlen($finalContent),
                'compression_ratio' => round((1 - strlen($finalContent) / strlen($pdfContent)) * 100, 2)
            ];

        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
    public function decompress($inputPath, $outputPath = null) {
        if (!file_exists($inputPath)) {
            return ['success' => false, 'error' => 'Compressed file not found'];
        }

        try {
            $content = @file_get_contents($inputPath, false, null);
            if ($content === false) {
                throw new Exception('Failed to read compressed file');
            }

            // Check signature
            $signature = substr($content, 0, 5);
            if ($signature !== 'CPDF2') {
                return ['success' => false, 'error' => 'Invalid file format'];
            }

            // Remove signature and decompress
            $compressedData = substr($content, 5);
            $decompressedData = gzuncompress($compressedData);
            if ($decompressedData === false) {
                throw new Exception('Failed to decompress data');
            }

            // Return success with decompressed data
            return [
                'success' => true,
                'data' => $decompressedData,
                'size' => strlen($decompressedData)
            ];

        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}

// Usage example:

// $compressor = new CompressIQ();
// $inputPath = __DIR__ . '/10mbPDF.pdf';
// $outputPath = __DIR__ . '/compressed/10mbPDF.cpdf';

// Compress PDF
// $result = $compressor->compress($inputPath, $outputPath);
// if ($result['success']) {
//     $originalSize = round($result['original_size']/1024, 2);    
//     $compressedSize = round($result['compressed_size']/1024, 2);
//     $saveStorage = round($originalSize - $compressedSize, 2);

//     echo "Compression successful!<br>";
//     echo "Original size: " .  $originalSize . " KB<br>";
//     echo "Compressed size: " . $compressedSize  . " KB<br>";
//     echo "Save storage: " . $saveStorage . " KB<br>";
//     echo "Compression ratio: " . $result['compression_ratio'] . "%<br>";
// } else {
//     echo "Compression failed: " . $result['error'] . "<br>";
// }

// Example of Decompression (optional)
// $decompressResult = $compressor->decompress($outputPath);
// if ($decompressResult['success']) {
//     $decompressedData = $decompressResult['data'];
//     header("Content-Type: application/pdf");
//     header("Content-Disposition: inline; filename='decompressed_view.pdf'");
//     header("Content-Length: " . strlen($decompressedData));
//     echo $decompressedData;
// } else {
//     echo "Decompression failed: " . $decompressResult['error'] . "<br>";
// }
