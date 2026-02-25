<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class QuoteService
{
    public function randomQuote(): array
    {
        return Cache::remember('login_quote', now()->addMinutes(30), function () {

            try {
                $res = Http::timeout(3)
                    ->retry(2, 200)
                    ->get('https://zenquotes.io/api/random');

                $isOk = method_exists($res, 'ok') ? $res->ok() : $res->successful();

                if (!$isOk) {
                    return ['text' => 'Welcome back.', 'author' => ''];
                }

                $json = $res->json();

                $first = is_array($json) ? ($json[0] ?? []) : [];

                $text = $first['q'] ?? null;
                $author = $first['a'] ?? '';

                if (!$text) {
                    return ['text' => 'Welcome back.', 'author' => ''];
                }

                return [
                    'text' => $text,
                    'author' => $author,
                ];
            } catch (\Throwable $e) {
                return ['text' => 'Welcome back.', 'author' => ''];
            }
        });
    }
}
