<?php

namespace App\Service;

use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MicroService
{
    public function __construct(protected HttpClientInterface $client)
    {
    }

    public function convertUrlToPdf(string $url, string $pdfTitle): string
    {
        try {
            $response = $this->client->request(
                'POST',
                'http://localhost/microservice/gotenberg',
                [
                    'body' => [
                        'url' => $url,
                    ]
                ]
            );
        } catch (Exception $exception) {
            throw new Exception($exception);
        }


        if ($response->getStatusCode() !== 200) {
            throw new Exception('Failed to generate PDF from URL.');
        }

        $pdfContent = $response->getContent();

        $pdfFilePath = 'uploads/' . $pdfTitle . '_' . uniqid() . '.pdf';
        file_put_contents($pdfFilePath, $pdfContent);

        return $pdfFilePath;
    }
}
