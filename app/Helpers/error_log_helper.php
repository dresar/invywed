<?php

/**
 * Error Log Helper
 * 
 * Helper functions untuk logging error di seluruh aplikasi
 */

if (!function_exists('log_error_debug')) {
    /**
     * Log error dengan format debug
     * 
     * @param string $location Lokasi error (file:line)
     * @param string $message Pesan error
     * @param array $data Data tambahan
     * @param string $hypothesisId ID hypothesis untuk debugging
     */
    function log_error_debug($location, $message, $data = [], $hypothesisId = 'A')
    {
        try {
            $logPath = ROOTPATH . '.cursor' . DIRECTORY_SEPARATOR . 'debug.log';
            $logDir = dirname($logPath);
            
            if (!is_dir($logDir)) {
                @mkdir($logDir, 0755, true);
            }
            
            $logData = json_encode([
                'location' => $location,
                'message' => $message,
                'data' => $data,
                'timestamp' => time(),
                'sessionId' => 'debug-session',
                'runId' => 'run1',
                'hypothesisId' => $hypothesisId
            ]);
            
            file_put_contents($logPath, $logData . "\n", FILE_APPEND);
        } catch (\Exception $e) {
            // Fallback jika logging gagal
            error_log('Failed to write debug log: ' . $e->getMessage());
        }
    }
}

if (!function_exists('log_error')) {
    /**
     * Log error ke CodeIgniter log dan debug log
     * 
     * @param string $message Pesan error
     * @param \Exception|\Throwable $exception Exception object
     * @param string $level Level log (error, critical, warning, etc)
     */
    function log_error($message, $exception = null, $level = 'error')
    {
        try {
            $location = '';
            $data = [];
            
            if ($exception instanceof \Throwable) {
                $location = $exception->getFile() . ':' . $exception->getLine();
                $data = [
                    'error' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'trace' => $exception->getTraceAsString()
                ];
            }
            
            // Log ke CodeIgniter
            log_message($level, $message . ($exception ? ': ' . $exception->getMessage() : ''));
            
            // Log ke debug log
            log_error_debug($location ?: 'unknown', $message, $data);
        } catch (\Exception $e) {
            // Fallback
            error_log('Failed to log error: ' . $e->getMessage());
        }
    }
}

