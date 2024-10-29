<?php

namespace App\Exceptions;

use Exception;

class PdfGenerationException extends Exception
{
    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => $this->getMessage()
            ], 500);
        }

        return back()->with('error', $this->getMessage());
    }
}
