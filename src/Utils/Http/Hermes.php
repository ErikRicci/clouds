<?php

namespace Clouds\Utils\Http;

class Hermes
{
    private string $url;
    private string $raw_content;

    private function __construct(string $url, string $method)
    {
        $this->url = $url;
        $this->makeRequest($method);
    }

    public static function get(string $url)
    {
        return new self($url, 'get');
    }

    private function makeRequest(string $method): string
    {
        // Initialize a cURL session
        $ch = curl_init();

        // Set the URL to make the GET request to
        curl_setopt($ch, CURLOPT_URL, $this->url);

        // Set the option to return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the GET request and store the response
        $response = curl_exec($ch);

        // Check for any errors during the request
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            // You can handle the error here or throw an exception
            throw new \Exception("cURL Error: " . $error);
        }

        // Close the cURL session
        curl_close($ch);

        // Return the response as a raw string
        return $this->raw_content = $response;
    }

    public function getRaw(): string
    {
        return $this->raw_content;
    }

    public function toArray(): array
    {
        return json_decode(empty($this->raw_content) ? [] : $this->raw_content, true);
    }
}
