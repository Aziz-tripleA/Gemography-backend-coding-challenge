<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;

class TrendingReposController extends Controller
{
    private $endpoint = 'https://api.github.com/search';

    protected $client;

    protected $languages = [];

    public function __construct()
    {
        $this->middleware('web');
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->endpoint,
        ]);
    }

    /**
     * get first 100 repos
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRepos()
    {
        // get last 30 day
        $date = Carbon::now()->subDays(30)->format('Y-m-d');

        $result = $this->client->request('GET', "/repositories?q=created:>$date&sort=stars&order=desc");

        $result = json_decode($result->getBody());

        foreach ($result as $item) {
            $this->get_languages($item);
        }

        // for api rate limit
       /* for ($i = 0 ; $i < 5 ; $i++){
            $this->get_languages($result[$i]);
        }*/

        return view('welcome',['result'=>$this->languages]);

    }

    /**
     * get the languages for every repo
     *
     * @param $node
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get_languages($node)
    {
        $languages = $this->client->request('GET',$node->languages_url);
        $languages = json_decode($languages->getBody());
        foreach ($languages as $language => $number) {
            $this->languages[$language][] = $node;
        }
    }
}
