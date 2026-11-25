<?php

namespace App\Services;

use App\Models\ChatLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    /** @var array<int, array{q: string, a: string}> */
    protected array $faq = [
        [
            'q' => 'how long cleanup time duration trauma scene',
            'a' => 'Most residential trauma cleanups finish in 4–12 hours depending on square footage, porous materials, and odor control. Larger multi-room or commercial scenes may span 1–2 days. SteriPath gives a scope window after the initial walkthrough.',
        ],
        [
            'q' => 'cost price estimate quote insurance',
            'a' => 'Dallas–Fort Worth residential biohazard jobs often range from roughly $1,200–$6,500 depending on contamination extent, materials removed, and waste disposal. Many homeowners policies cover trauma cleanup — we document scopes for insurers. Call (214) 555-0188 for emergency intake.',
        ],
        [
            'q' => 'bloodborne pathogen blood opim disinfection atp',
            'a' => 'We remediate blood and other potentially infectious materials with EPA-registered hospital-grade disinfectants, remove non-restorable porous items, and can verify with ATP sampling when required by property managers or insurers.',
        ],
        [
            'q' => 'ppe containment osha safety family',
            'a' => 'SteriPath techs arrive in full PPE, establish containment, and keep family members out of hot zones. We follow OSHA bloodborne pathogen expectations and discreet unmarked vehicle protocols when requested.',
        ],
        [
            'q' => 'hoarding vehicle sharps medical waste',
            'a' => 'We handle hoarding biohazards, vehicle interiors, and sharps packaging with licensed medical waste partners. Regulated waste is manifested — never tossed in household trash.',
        ],
        [
            'q' => 'columbus dublin westerville ohio service area',
            'a' => 'We serve Columbus, Dublin, Westerville, and greater Dallas–Fort Worth. Emergency dispatch is available 24/7 for trauma and infectious events.',
        ],
        [
            'q' => 'schedule appointment emergency dispatch contact',
            'a' => 'Call or text (214) 555-0188, use the contact form, or WhatsApp us. For active trauma or unattended death scenes we prioritize same-day dispatch when crews are available.',
        ],
        [
            'q' => 'odor smell death decomposition',
            'a' => 'Odor usually means residual organic material in porous surfaces or HVAC pathways. SteriPath removes the source materials first, then applies enzymatic and oxidizing treatments — masking sprays alone do not solve biohazard odor.',
        ],
    ];

    public function chat(string $message, ?string $sessionId = null): array
    {
        $reply = null;
        $source = 'demo';

        if ($key = config('services.openai.key')) {
            try {
                $reply = $this->callOpenAi($message, $key);
                $source = 'openai';
            } catch (\Throwable) {
                $reply = null;
            }
        }

        if (! $reply && ($gemini = config('services.gemini.key'))) {
            try {
                $reply = $this->callGemini($message, $gemini);
                $source = 'gemini';
            } catch (\Throwable) {
                $reply = null;
            }
        }

        if (! $reply) {
            $reply = $this->demoReply($message);
            $source = 'demo';
        }

        ChatLog::query()->create([
            'session_id' => $sessionId,
            'message' => $message,
            'reply' => $reply,
            'source' => $source,
        ]);

        return ['reply' => $reply, 'source' => $source];
    }

    public function generate(string $type, string $prompt): string
    {
        $message = match ($type) {
            'blog' => "Write a concise SEO blog post outline and intro for a biohazard cleanup company about: {$prompt}",
            'description' => "Write a compelling service description for biohazard remediation: {$prompt}",
            'automation' => "Suggest 5 practical AI automations for a biohazard cleanup SME ERP related to: {$prompt}",
            'troubleshoot' => "Troubleshoot this biohazard operations issue with clear steps: {$prompt}",
            default => $prompt,
        };

        $result = $this->chat($message);

        return $result['reply'];
    }

    protected function demoReply(string $message): string
    {
        $hay = Str::lower($message);
        $best = null;
        $bestScore = 0;

        foreach ($this->faq as $item) {
            $score = 0;
            foreach (explode(' ', $item['q']) as $word) {
                if ($word !== '' && str_contains($hay, $word)) {
                    $score++;
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $item['a'];
            }
        }

        if ($best && $bestScore > 0) {
            return $best;
        }

        return 'Thanks for reaching SteriPath Biohazard Cleanup. We provide trauma scene, bloodborne pathogen, and infectious disease cleanup across Dallas–Fort Worth. Ask about pricing, PPE protocols, dispatch, or call (214) 555-0188 for emergencies.';
    }

    protected function callOpenAi(string $message, string $key): string
    {
        $response = Http::withToken($key)
            ->timeout(30)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('services.openai.model', 'gpt-4o-mini'),
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are the SteriPath Biohazard Cleanup assistant for a Dallas, TX biohazard cleanup company. Be concise, compassionate, and practical. Focus on trauma cleanup, bloodborne pathogens, disinfection, and safe dispatch. Never invent illegal or unsafe claims.',
                    ],
                    ['role' => 'user', 'content' => $message],
                ],
                'temperature' => 0.4,
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'choices.0.message.content', 'Unable to generate a response.');
    }

    protected function callGemini(string $message, string $key): string
    {
        $model = config('services.gemini.model', 'gemini-1.5-flash');
        $response = Http::timeout(30)
            ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "You are SteriPath Biohazard Cleanup assistant (Dallas–Fort Worth biohazard cleanup). Answer briefly:\n{$message}"],
                        ],
                    ],
                ],
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'candidates.0.content.parts.0.text', 'Unable to generate a response.');
    }
}
