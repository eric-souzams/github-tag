<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Repositories\SearchHistoryRepository;
use App\Services\GithubService;

class SearchController extends Controller
{
    private $repository;

    public function __construct(SearchHistoryRepository $repository)
    {
        $this->repository = $repository;   
    }

    public function index()
    {
        $history = $this->repository->getLastHistories();

        return view('home', [
            'histories' => $history
        ]);
    }

    public function getSearchUsername(SearchRequest $request)
    {
        $payload = $request->validated();
        $username = $payload['username'];

        $userData = $this->requestData($username);
        $userRepositories = $this->requestRepositories($username);

        if (isset($userData->message)) {
            return redirect()->route('home');
        }

        $this->repository->handle($userData);

        return view('home', [
            'user' => $userData,
            'repositories' => $userRepositories
        ]);
    }

    private function requestData(string $username)
    {
        return app(GithubService::class)->requestUserData($username);
    }

    private function requestRepositories(string $username)
    {
        return app(GithubService::class)->requestUserRepositories($username);
    }
}
