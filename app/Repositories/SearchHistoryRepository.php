<?php

namespace App\Repositories;

use App\Models\SearchHistory;

class SearchHistoryRepository {
    public function handle($data): void
    {
        $payload = [
            'username' => $data->login,
            'email' => $data->email,
            'avatar_url' => $data->avatar_url,
            'profile_url' => $data->html_url,
            'total_repos' => $data->public_repos
        ];

        $this->saveSearch($payload);
    }

    public function getLastHistories()
    {
        return SearchHistory::select('username', 'avatar_url')->distinct('username')->limit(13)->get();
    }

    private function saveSearch(array $payload): void
    {
        SearchHistory::create($payload);
    }
}