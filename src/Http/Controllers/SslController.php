<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\SslCertificate\SslCertificate;

class SslController
{
    public function __invoke(Request $request)
    {
        try {
            $certificate = SslCertificate::createForHostName($request->domain);

            return response()->json([
                'issuer' => $certificate->getIssuer(),
                'is_valid' => $certificate->isValid(),
                'expiration_date' => $certificate->expirationDate()->diffForHumans(),
                'expiration_date_in_days' => $certificate->expirationDate()->diffInDays(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 404);
        }
    }
}
